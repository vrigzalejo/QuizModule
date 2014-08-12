<?php namespace QuizModule\Repositories\Validations\Subject;

use QuizModule\Validators\AbstractValidator;

class SubjectCreateValidation extends AbstractValidator {
	/**
	 * Validation rules
	 */
	protected $rules = [
		'add_subj_code' 		=> 'required|unique:subjects,subj_code',
		'add_subj_description' 	=> 'required|unique:subjects,subj_description',			
	];
}