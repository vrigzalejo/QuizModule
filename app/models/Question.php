<?php namespace App\Models;
use Option;

class Question extends \Basemodel {

	public function type() {
		return $this->belongsTo('Type');
	}

	public function subject() {
		return $this->belongsTo('Subject');
	}

	public function user() {
		return $this->belongsTo('User');
	}

	public function option() {
		return $this->hasMany('Option');
	}

	public function item() {
		return $this->hasMany('Item');
	}

	public static function questionAll() {
		return static::select(
			'types.id','types.value',
			'subjects.id','subjects.subj_code','subjects.subj_description',
			'questions.id',
			'questions.question',
			'questions.created_at as questions_created',
			'questions.updated_at as questions_updated',
			'options.id as option_id',
			'options.question_id',
			'options.opt_one',
			'options.opt_two',
			'options.opt_three',
			'options.opt_four',
			'options.answer',
			'options.is_img',
			'options.created_at',
			'options.updated_at'
			// 'options.deleted_at'
			)
			->leftJoin('options','questions.id','=','options.question_id')
			->leftJoin('types','questions.type_id','=','types.id')
			->leftJoin('subjects','questions.subject_id','=','subjects.id')
			->get();
	}

	public static function questionsBySubject($id) {
		return static::select(
			'types.id','types.value',
			'subjects.id','subjects.subj_code','subjects.subj_description',
			'questions.id',
			'questions.question',
			'questions.created_at as questions_created',
			'questions.updated_at as questions_updated',
			'options.id as option_id',
			'options.question_id',
			'options.opt_one',
			'options.opt_two',
			'options.opt_three',
			'options.opt_four',
			'options.answer',
			'options.is_img',
			'options.created_at',
			'options.updated_at'
			// 'options.deleted_at'
			)
			->join('options','questions.id','=','options.question_id')
			->join('types','questions.type_id','=','types.id')
			->join('subjects','questions.subject_id','=','subjects.id')
			->where('questions.subject_id', '=', $id)
			->get();
	}	

	public static function createQuestion($credentials = []) {
		$question = new Question;
		$question->user_id 		= $credentials["user_id"];
		$question->type_id 		= $credentials["type_id"];
		$question->subject_id 	= $credentials["subject_id"];
		$question->question 	= $credentials["question"];
		$question->save();

		$option = new Option;
		$option->question_id = $question->id;
		$option->opt_one = $credentials["opt_one"];
		$option->opt_two = $credentials["opt_two"];
		$option->opt_three = $credentials["opt_three"];
		$option->opt_four = $credentials["opt_four"];
		$option->answer = $credentials["answer"];
		$option->is_img = $credentials["is_img"];
		$option->save();
	}

	public static function deleteQuestion($id) {
		$question = static::find($id);
		$question->delete();
	}

	public static function updateQuestion($credentials = []) {
		$question = static::find($credentials["id"]);
		$question->user_id 		= $credentials["user_id"];
		$question->type_id 		= $credentials["type_id"];
		$question->subject_id 	= $credentials["subject_id"];
		$question->question 	= $credentials["question"];
		$question->save();

		$option = Option::find($credentials["option_id"]);
		$option->question_id = $question->id;
		$option->opt_one = $credentials["opt_one"];
		$option->opt_two = $credentials["opt_two"];
		$option->opt_three = $credentials["opt_three"];
		$option->opt_four = $credentials["opt_four"];
		$option->answer = $credentials["answer"];
		$option->save();
	}

	public static function boot() {
		parent::boot();

		static::deleting(function($question) {
			foreach($question->option as $option) {
				$option->delete();
			}
		});

		static::deleting(function($question) {
			foreach($question->item as $item) {
				$item->delete();
			}
		});
	}
		
}