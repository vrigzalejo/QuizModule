<?php namespace App\Models;


class Subjquiz extends \Basemodel {

	protected $fillable = ['subject_id', 'name'];

	public function quiz() {
		return $this->hasMany('Quiz');
	}

	public static function subjquizAll() {
		return static::select(
			'subjects.id','subjects.subj_code','subjects.subj_description',
			'subjquizzes.id','subjquizzes.name', 'subjquizzes.created_at', 'subjquizzes.updated_at'
			)
			->leftJoin('subjects','subjquizzes.subject_id','=','subjects.id')
			->get();
	}

	public static function boot() {
		parent::boot();

		static::deleting(function($subjquiz) {
			foreach($subjquiz->quiz as $quiz) {
				$quiz->delete();
			}
		});
	}

	
}
