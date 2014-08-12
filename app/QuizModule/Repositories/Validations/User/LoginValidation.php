<?php namespace QuizModule\Repositories\Validations\User;

use QuizModule\Validators\AbstractValidator;

class LoginValidation extends AbstractValidator {
	/**
	 * Validation rules
	 */
	protected $rules = [
		'studentno'		 => 'required|exists:users,studentno',
		'login_password' => 'required'
	];
}