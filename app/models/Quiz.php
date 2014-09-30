<?php namespace App\Models;
use Subjquiz;

class Quiz extends \Basemodel {

	public function student() {
		return $this->belongsTo('Student');
	}
		
	public function subjquiz() {
		return $this->belongsToMany('Subjquiz');
	}


	public static function deleteQuiz($id) {
		$subjquiz = Subjquiz::find($id);
		$subjquiz->delete();
	}

	public static function updateQuiz($credentials = []) {
		$subject = $credentials["subjquiz_id"];
		$subject->name = $credentials["name"];
		$subject->subject_id = $credentials["subject_id"];
		$subject->save();
	}
}