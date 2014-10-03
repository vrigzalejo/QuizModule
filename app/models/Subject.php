<?php namespace App\Models;

class Subject extends \Basemodel {

	protected $fillable = ['subj_code', 'subj_description'];

	public function quiz() {
		return $this->hasManyThrough('Quiz', 'Subjquiz');
	}


	public function question() {
		return $this->hasMany('Question');
	}


	public function subjquiz() {
		return $this->hasMany('Subjquiz');
	}

	public static function deleteSubject($credentials = []) {
		$subject = static::find($credentials["id"]);
		$subject->delete();
	}

	public static function updateSubject($credentials = []) {
		$subject = $credentials["subj_id"];
		$subject->subj_code = $credentials["subj_code"];
		$subject->subj_description = $credentials["subj_description"];
		$subject->save();
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