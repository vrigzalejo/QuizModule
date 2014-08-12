<?php namespace QuizModule\Repositories\Validations\Subjquiz;

use QuizModule\Validators\AbstractValidator;

class SubjquizValidation extends AbstractValidator {
	/**
	 * Validation rules
	 */
	protected $rules = [
		'subjquiz_name' 		=> 'required',
		'subjquiz_subject' 		=> 'required',			
	];
}