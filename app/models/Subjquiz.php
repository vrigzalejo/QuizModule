<?php namespace App\Models;


class Subjquiz extends \Basemodel {

	protected $fillable = ['subject_id', 'name'];

	public function quiz() {
		return $this->hasMany('Quiz');
	}

	public static function subjquizAll() {
		return static::select(
			'subjects.id','subjects.subj_code','subjects.subj_description',
			'subjquizzes.id','subjquizzes.name', 'subjquizzes.created_at', 'subjquizzes.updated_at', 'subjquizzes.deleted_at'
			)
			->leftJoin('subjects','subjquizzes.subject_id','=','subjects.id')
			->get();
	}

	public static function questionAll() {
		return static::select(
			'types.id','types.value',
			'subjects.id','subjects.subj_code','subjects.subj_description',
			'questions.*'
			)
			->leftJoin('types','questions.type_id','=','types.id')
			->leftJoin('subjects','questions.subject_id','=','subjects.id')
			->get();
	}		
}
