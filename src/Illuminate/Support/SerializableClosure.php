<?php namespace Illuminate\Support;

use SuperClosure\SerializableClosure as SuperClosure;

/**
 * Extends SuperClosure for backwards compatibility.
 */
class SerializableClosure extends SuperClosure {

	/**
	 * The code for the closure
	 *
	 * @var string
	 */
	protected $unserialized;

	/**
	 * The variables that were "used" or imported from the parent scope
	 *
	 * @var array
	 */
	protected $variables;

	/**
	 * Returns the code of the closure being serialized
	 *
	 * @return string
	 */
	public function getCode()
	{
		$this->determineCodeAndVariables();

		return $this->unserialized['code'];
	}

	/**
	 * Returns the "used" variables of the closure being serialized
	 *
	 * @return array
	 */
	public function getVariables()
	{
		$this->determineCodeAndVariables();

		return $this->unserialized['context'];
	}

	/**
	 * Uses the serialize method directly to lazily fetch the code and variables if needed
	 */
	protected function determineCodeAndVariables()
	{
		if ( ! $this->unserialized)
		{
			$this->unserialized = unserialize($this->serialize());
		}
	}

}
