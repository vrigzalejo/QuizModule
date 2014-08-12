<?php namespace QuizModule\Validators;

use Illuminate\Validation\Factory;
use QuizModule\Validators\Interfaces\ValidatorInterface;

abstract class AbstractValidator implements ValidatorInterface {

	protected $validator;
	protected $data = [];
	protected $errors = [];
	protected $rules = [];

	public function __construct(Factory $validator) {
		$this->validator = $validator;
	}

	/**
	 * Set data to validate it
	 * @return \Quiz\Validators\Abstracts\AbstractValidator
	 */
	public function with($data = []) {
		$this->data = $data;
		return $this;
	}

	public function passes() {
		$validator = $this->validator->make($this->data, $this->rules);
		if($validator->fails()) {
			$this->errors = $validator->messages();
			return false;
		}
		return true;
	}

	public function errors() {
		return $this->errors;
	}


}