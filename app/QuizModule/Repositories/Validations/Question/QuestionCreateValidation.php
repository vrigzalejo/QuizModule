<?php namespace QuizModule\Repositories\Validations\Question;

use QuizModule\Validators\AbstractValidator;

class QuestionCreateValidation extends AbstractValidator {
	/**
	 * Validation rules
	 */
	protected $input = ["is_img"];
	protected $withOrWithOutImg;

	public function __construct() {
		$this->withOrWithOutImg = ($this->input || $this->input != NULL ? ['regex:~[0-9a-zA-Z\+/=]{20,}~'] : 'required|alpha_spaces'); 
	}

	protected $rules = [
		'type_id'		=> 'required|integer',
		'subject_id'	=> 'required|integer',
		'question'		=> 'required',
		'opt_one'		=> $withOrWithOutImg,
		'opt_two'		=> $withOrWithOutImg,
		'opt_three'		=> $withOrWithOutImg,
		'opt_four'		=> $withOrWithOutImg,
		'answer'		=> $withOrWithOutImg,
	];
}