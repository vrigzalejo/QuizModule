<?php namespace QuizModule\Repositories\Validations\Quiz;

use QuizModule\Validators\AbstractValidator;

class QuizCreateValidation extends AbstractValidator {
	/**
	 * Validation rules
	 */
	protected $rules = [
		'add_quiz_name' 		=> 'required|unique:subjquizzes,name',
		'add_quiz_subject' 		=> 'required|integer',			
	];
}