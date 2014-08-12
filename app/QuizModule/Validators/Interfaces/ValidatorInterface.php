<?php namespace QuizModule\Validators\Interfaces;

interface ValidatorInterface {
	/**
	 * @param  $input
	 * @return \QuizModule\Validators\Interfaces\ValidatorInterface $this 
	 */
	public function with($input = []);
	/**
	 * @return boolean
	 */
	public function passes();
	/**
	 * @return array
	 */
	public function errors();
}