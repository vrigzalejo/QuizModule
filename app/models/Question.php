<?php namespace App\Models;

class Question extends \Basemodel {

	public function type() {
		return $this->belongsTo('Type');
	}

	public function subject() {
		return $this->belongsTo('Subject');
	}

	public function option() {
		return $this->hasMany('Option');
	}

	public static function questionAll() {
		return static::select(
			'types.id','types.value',
			'subjects.id','subjects.subj_code','subjects.subj_description',
			'questions.id',
			'questions.question',
			// 'questions.opt_one',
			// 'questions.opt_two',
			// 'questions.opt_three',
			// 'questions.opt_four',
			// 'questions.answer',
			'questions.created_at as questions_created',
			'questions.updated_at as questions_updated',
			// 'questions.deleted_at as question_deleted',
			'options.opt_one',
			'options.opt_two',
			'options.opt_three',
			'options.opt_four',
			'options.answer',
			'options.is_img',
			// 'options.is_option',
			'options.created_at',
			'options.updated_at'
			// 'options.deleted_at'
			)
			->leftJoin('options','questions.id','=','options.question_id')
			->leftJoin('types','questions.type_id','=','types.id')
			->leftJoin('subjects','questions.subject_id','=','subjects.id')
			->get();
	}	

	public static function boot() {
		parent::boot();

		static::deleting(function($question) {
			foreach($question->option as $option) {
				$option->delete();
			}
		});
	}
		
}