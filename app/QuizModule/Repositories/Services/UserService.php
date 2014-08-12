<?php namespace QuizModule\Repositories\Services;

use QuizModule\Validators\Interfaces\ValidatorInterface;
use QuizModule\Repositories\Interfaces\UserInterface;

class UserService {
	protected $data;
	/**
	 * Validator
	 * @var QuizModule\Validators\Interfaces\ValidatorInterface
	 */
	protected $validator;
	protected $user;

	public function __construct(ValidatorInterface $validator, UserInterface $user) {
		$this->validator = $validator;
		$this->user = $user;
	}

	public function valid($input = []) {
		return $this->validator->with($input)->passes();
	}


}