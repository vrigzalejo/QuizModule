<?php namespace QuizModule\Repositories\Validations\Quiz;

use QuizModule\Validators\AbstractValidator;

class QuizUpdateValidation extends AbstractValidator {
	/**
	 * Validation rules
	 */
	protected $rules = [
		'subjquiz_name' 		=> 'required',
		'subjquiz_subject' 		=> 'required',			
	];
}