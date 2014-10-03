<?php namespace App\Models;

use App\Models\Subjquiz;
use DB;
class Quiz extends \Basemodel {

	public function student() {
		return $this->belongsTo('Student');
	}
		
	public function subjquiz() {
		return $this->belongsTo('Subjquiz');
	}


	public static function deleteQuiz($id) {
		$subjquiz = Subjquiz::find($id);
		$subjquiz->delete();
	}

	public static function updateQuiz($credentials = []) {

		$subject = Subjquiz::find($credentials["id"]);
		$subject->user_id = $credentials["user_id"];
		$subject->name = $credentials["name"];
		$subject->subject_id = $credentials["subject_id"];
		$subject->save();
	}

	// public static function takeAQuiz() {
	// 	return static::select(
	// 		DB::raw('COUNT(items.subjquiz_id) as subjquiz_items'),
	// 			'students.id', 'students.user_id',
	// 			'quizzes.id',
	// 			'subjects.id','subjects.subj_code','subjects.subj_description',
	// 			'subjquizzes.id','subjquizzes.name', 'subjquizzes.created_at', 'subjquizzes.updated_at'
	// 		)
	// 		->leftJoin('students','quizzes.user_id','=','students.id')
	// 		->leftJoin('subjects','subjquizzes.subject_id','=','subjects.id')
	// 		->leftJoin('items','subjquizzes.id','=','items.subjquiz_id')
	// 		->groupBy('subjquizzes.id')
	// 		->get();
	// }

}