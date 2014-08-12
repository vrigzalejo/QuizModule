<?php namespace QuizModule\Repositories\Validations\Subject;

use QuizModule\Validators\AbstractValidator;

class SubjectUpdateValidation extends AbstractValidator {
	/**
	 * Validation rules
	 */
	protected $rules = [
		'subj_code' 		=> 'required',
		'subj_description' 	=> 'required',			
	];
}