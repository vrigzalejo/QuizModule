<?php namespace App\Models;


class Subject extends \Basemodel {

	protected $fillable = ['subj_code', 'subj_description'];

	public function quiz() {
		return $this->hasManyThrough('Quiz', 'Subjquiz');
	}


	public function question() {
		return $this->hasMany('Question');
	}


	public static function boot() {
		parent::boot();

		static::deleting(function($subject) {
			foreach($subject->question as $question) {
				$question->delete();
			}
		});

		static::deleting(function($subject) {
			foreach($subject->quiz as $quiz) {
				$quiz->delete();
			}
		});
	}
		
}