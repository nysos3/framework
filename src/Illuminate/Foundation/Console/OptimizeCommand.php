<?php namespace Illuminate\Foundation\Console;

use ClassPreloader\Exceptions\VisitorExceptionInterface;
use ClassPreloader\Factory;
use Illuminate\Console\Command;
use Illuminate\Foundation\Composer;
use Illuminate\View\Engines\CompilerEngine;
use Symfony\Component\Console\Input\InputOption;

class OptimizeCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'optimize';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = "Optimize the framework for better performance";

	/**
	 * The composer instance.
	 *
	 * @var \Illuminate\Foundation\Composer
	 */
	protected $composer;

	/**
	 * Create a new optimize command instance.
	 *
	 * @param  \Illuminate\Foundation\Composer  $composer
	 * @return void
	 */
	public function __construct(Composer $composer)
	{
		parent::__construct();

		$this->composer = $composer;
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$this->info('Generating optimized class loader');

		if ($this->option('psr'))
		{
			$this->composer->dumpAutoloads();
		}
		else
		{
			$this->composer->dumpOptimized();
		}

		if ($this->option('force') || ! $this->laravel['config']['app.debug'])
		{
			$this->info('Compiling common classes');

			$this->compileClasses();

			$this->info('Compiling views');

			$this->compileViews();
		}
		else
		{
			$this->call('clear-compiled');
		}
	}

	/**
	 * Generate the compiled class file.
	 *
	 * @return void
	 */
    protected function compileClasses()
    {
        $outputPath = $this->laravel['path.base'].'/bootstrap/compiled.php';

        $preloader = (new Factory)->create(['skip' => true]);
        $handle = $preloader->prepareOutput($outputPath);
        foreach ($this->getClassFiles() as $file) {
            try {
                fwrite($handle, $preloader->getCode($file, false)."\n");
            } catch (VisitorExceptionInterface $e) {
                //
            }
        }
        fclose($handle);
    }

    /**
     * Get the classes that should be combined and compiled.
     *
     * @return array
     */
    protected function getClassFiles()
    {
        $app = $this->laravel;

        $core = require __DIR__.'/Optimize/config.php';

        $files = array_merge($core, $this->laravel['config']['compile']);

        return array_filter($files, function ($item) {return $item;});
    }

	/**
	 * Compile all view files.
	 *
	 * @return void
	 */
	protected function compileViews()
	{
		foreach ($this->laravel['view']->getFinder()->getPaths() as $path)
		{
			foreach ($this->laravel['files']->allFiles($path) as $file)
			{
				try
				{
					$engine = $this->laravel['view']->getEngineFromPath($file);
				}
				catch (\InvalidArgumentException $e)
				{
					continue;
				}

				if ($engine instanceof CompilerEngine)
				{
					$engine->getCompiler()->compile($file);
				}
			}
		}
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('force', null, InputOption::VALUE_NONE, 'Force the compiled class file to be written.'),

			array('psr', null, InputOption::VALUE_NONE, 'Do not optimize Composer dump-autoload.'),
		);
	}

}
