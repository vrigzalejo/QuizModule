<?php namespace App\Controllers\Quiz;

use View, Input, HTML, Request, Redirect, Response, Config, Sentry;
use App\Models\Subject;
use App\Models\Subjquiz;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Type;

class SubjquizController extends \BaseController {

	protected $input;
	protected $credentials;
	protected $functionController;

	public function __construct(\App\Controllers\Quiz\FunctionController $functionController) {
		$this->input = Input::all();
		$this->credentials = [];
		$this->functionController = $functionController;
	}
	
	public function getIndex()
	{
		return View::make('dashboard.modules.subjects.index');
	}



	public function postCreateQuiz() {
		if(Request::ajax() || Request::wantsJson() || Request::isJson()) {

			$input = $this->input;
			$credentials = $this->credentials;
			$rules = [
				'add_quiz_name' 		=> 'required|unique:subjquizzes,name',
				'add_quiz_subject' 		=> 'required|integer',			
			];
			// Used the main Validator class for Sentry
			$validation = Subjquiz::validate($input, $rules);

			if($validation->fails()) {
				$result = $this->functionController->result(false, 'add_quiz', $validation->getMessageBag()->toArray());
			} else {
				$credentials["user_id"] = Sentry::getUser()->id;
				$credentials["name"] = HTML::entities($input["add_quiz_name"]);
				$credentials["subject_id"] = HTML::entities($input["add_quiz_subject"]);

				Subjquiz::create([
					'user_id'		=> $credentials["user_id"],
					'name'			=> $credentials["name"],
					'subject_id'  	=> $credentials["subject_id"]
				]);

				$result = $this->functionController->result(true, 'add_quiz', '<div data-alert class="alert-box success radius"><i class="fi-check size-72"></i>&nbsp;You have successfully registered Quiz Name: <b>' . $credentials["name"] . '</b>, Subject: <b>' . Subject::find($credentials["subject_id"])->subj_code . '</b><a href="#" class="close">&times;</a></div>');
			}

			return $this->functionController->response($result);
		}

	}



	public function postUpdateQuiz() {

		if(Request::ajax() || Request::wantsJson() || Request::isJson()) {
			$input = $this->input;
			$credentials = $this->credentials;
			$rules = [
				'subjquiz_name' 		=> 'required',
				'subjquiz_subject' 		=> 'required',			
			];
			// Used the main Validator class for Sentry
			$validation = Subjquiz::validate($input, $rules);

			if($validation->fails()) {
				$result = $this->functionController->result(false, 'update_quiz', $validation->getMessageBag()->toArray());
			} else {	
				$subjectSelected = Subject::where('subj_code','=', HTML::entities($input["subjquiz_subject"]))->first();	
				
				$credentials["id"] = HTML::entities($input["subjquiz_id"]);
				$credentials["user_id"] = Sentry::getUser()->id;
				$credentials["name"] = HTML::entities($input["subjquiz_name"]);					
				$credentials["subject_id"] = $subjectSelected->id;
				$credentials["subjquiz_id"] = HTML::entities($input["subjquiz_id"]);

				Quiz::updateQuiz($credentials);


				$result = $this->functionController->result(true, 'update_quiz', '<div data-alert class="alert-box success radius"><i class="fi-check size-72"></i>&nbsp;You have successfully updated Quiz Name: <b>' . $credentials["name"] . '</b>, Subject: <b>' . $subjectSelected->subj_code . '</b><a href="#" class="close">&times;</a></div>');

			}

			return $this->functionController->response($result);
		}
	}

	public function postDeleteQuiz() {
		if(Request::ajax() || Request::wantsJson() || Request::isJson()) {
			$input = $this->input;

			Quiz::deleteQuiz(HTML::entities($input["subjquiz_id"]));

			$result = $this->functionController->result(true, 'delete_subject', '<div data-alert class="alert-box success radius"><i class="fi-check size-72"></i>&nbsp;You have successfully deleted a Quiz. <a href="#" class="close">&times;</a></div>');

			return $this->functionController->response($result);

		}
	}

	public function postCreateSubject()
	{
		if(Request::ajax() || Request::wantsJson() || Request::isJson()) {
			$input = $this->input;
			$credentials = $this->credentials;
			$rules = [
				'add_subj_code' 		=> 'required|unique:subjects,subj_code',
				'add_subj_description' 	=> 'required|unique:subjects,subj_description',			
			];
			// Used the main Validator class for Sentry
			$validation = Subject::validate($input, $rules);

			if($validation->fails()) {
					$result = $this->functionController->result(false, 'add_subject', $validation->getMessageBag()->toArray());
			} else {
				$credentials["subj_code"] = HTML::entities(strtoupper($input["add_subj_code"]));
				$credentials["subj_description"] = HTML::entities($input["add_subj_description"]);

				Subject::create([
					'subj_code'			=> $credentials["subj_code"],
					'subj_description'  => $credentials["subj_description"]
				]);
			
				$result = $this->functionController->result(true, 'add_subject', '<div data-alert class="alert-box success radius"><i class="fi-check size-72"></i>&nbsp;You have successfully registered Subject Code: <b>' . $credentials["subj_code"] . '</b>, Description: <b>' . $credentials["subj_description"] . '</b><a href="#" class="close">&times;</a></div>');
			}

			return $this->functionController->response($result);
		}

	}

	public function postUpdateSubject() {

		if(Request::ajax() || Request::wantsJson() || Request::isJson()) {
			$input = $this->input;
			$credentials = $this->credentials;
			$rules = [
				'subj_code' 		=> 'required',
				'subj_description' 	=> 'required',			
			];
			// Used the main Validator class for Sentry
			$validation = Subject::validate($input, $rules);

			if($validation->fails()) {
				$result = $this->functionController->result(false, 'update_subject', $validation->getMessageBag()->toArray());
			} else {		
				$credentials["subj_code"] = HTML::entities(strtoupper($input["subj_code"]));
				$credentials["subj_description"] = HTML::entities($input["subj_description"]);
				$credentials["subj_id"] = HTML::entities($input["subj_id"]);

				Subject::updateSubject($credentials);

				$result = $this->functionController->result(true, 'update_subject', '<div data-alert class="alert-box success radius"><i class="fi-check size-72"></i>&nbsp;You have successfully updated Subject Code: <b>' . $credentials["subj_code"] . '</b>, Description: <b>' . $credentials["subj_description"] . '</b><a href="#" class="close">&times;</a></div>');

			}

			return $this->functionController->response($result);
		}
	}

	public function postDeleteSubject() {
		if(Request::ajax() || Request::wantsJson() || Request::isJson()) {
			$input = $this->input;
			$credentials = $this->credentials;

			$credentials["id"] = HTML::entities($input["subj_id"]);

			Subject::deleteSubject($credentials);

			$result = $this->functionController->result(true, 'delete_subject', '<div data-alert class="alert-box success radius"><i class="fi-check size-72"></i>&nbsp;You have successfully deleted a subject.</div>');

			return $this->functionController->response($result);

		}
	}

}
