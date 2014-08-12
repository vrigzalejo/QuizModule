<?php namespace App\Controllers\Quiz;

use App\Models\Level;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Type;
use App\Models\Subjquiz;
use App\Models\Question;
//use Response;

class ApiController extends \BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', ['on'=>'post|put|patch']);
	}

	public function getApiSection($id) {
		return Level::find($id)->section;
	}

	public function getApiStudent($id) {
		return Student::studentsBySection($id);
	}

	public function getApiTypeAll() {
		return Type::all();
	}

	public function getApiSubjectAll() {
		return Subject::all();
	}

	public function getApiSubjquizAll() {
		return Subjquiz::subjquizAll();
	}

	public function getApiQuestionAll() {
		return Question::questionAll();
	}

}
