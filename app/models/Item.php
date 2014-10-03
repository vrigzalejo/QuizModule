<?php namespace App\Models;


class Item extends \Basemodel {

	protected $fillable = ['subjquiz_id', 'question_id'];

		
	public function subjquiz() {
		return $this->belongsToMany('Subjquiz');
	}

	public function question() {
		return $this->belongsToMany('Question');
	}

	public static function itemsBySubjquiz($sid, $id) {
		return static::select(
			'items.id',
			'items.subjquiz_id',
			'items.question_id',
			// 'subjects.id',
			'subjects.subj_code',
			'subjects.subj_description',
			// 'questions.id as question_id',
			'questions.type_id',
			'questions.subject_id',
			'questions.question',
			'questions.created_at as question_created',
			'questions.updated_at as question_updated',
			'options.id as option_id',
			// 'options.question_id',
			'options.opt_one',
			'options.opt_two',
			'options.opt_three',
			'options.opt_four',
			'options.answer',
			'options.is_img',
			// 'options.created_at',
			// 'options.updated_at',
			// 'types.id',
			'types.value'
			// 'options.deleted_at'
			)
			->join('subjquizzes','items.subjquiz_id','=','subjquizzes.id')
			->join('questions','items.question_id','=','questions.id')
			->join('options','questions.id','=','options.question_id')
			->join('types','questions.type_id','=','types.id')
			->join('subjects','questions.subject_id','=','subjects.id')
			->where('subjects.id', '=', $sid)
			->where('subjquizzes.id', '=', $id)
			->get();		
	}

	public static function deleteItem($credentials = []) {
		$item = static::find($credentials["id"]);
		$item->delete();
	}

}