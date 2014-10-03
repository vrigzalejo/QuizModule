<?php namespace App\Controllers\Quiz;

use View, Input, HTML, Request, Redirect, Response, Config, Sentry;
use App\Models\Subject;
use App\Models\Subjquiz;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Type;

class QuestionsController extends \BaseController {

	protected $input;
	protected $credentials;
	protected $functionController;

	public function __construct(\App\Controllers\Quiz\FunctionController $functionController) {
		$this->input = Input::all();
		$this->credentials = [];
		$this->functionController = $functionController;
	}

	public function getQuestions()
	{
		return View::make('dashboard.modules.questions.index');
	}

	public function postCreateQuestion() {
		if(Request::ajax() || Request::wantsJson() || Request::isJson()) {
			$input = $this->input;
			$withOrWithOutImg = ($input["is_img"] || $input["is_img"] != NULL ? ['regex:~[0-9a-zA-Z\+/=]{20,}~'] : 'required');
			$credentials = $this->credentials;
			$rules = [
				'type_id'		=> 'required|integer',
				'subject_id'	=> 'required|integer',
				'question'		=> 'required',
				'opt_one'		=> $withOrWithOutImg,
				'opt_two'		=> $withOrWithOutImg,
				'opt_three'		=> $withOrWithOutImg,
				'opt_four'		=> $withOrWithOutImg,
				'answer'		=> $withOrWithOutImg,
			];

			$validation = Question::validate($input, $rules);
			if($validation->fails()) {
				$result = $this->functionController->result(false, 'add_question', $validation->getMessageBag()->toArray());
			} else {
				$credentials["user_id"] = Sentry::getUser()->id;
				$credentials["type_id"] = HTML::entities($input["type_id"]);
				$credentials["subject_id"] = HTML::entities($input["subject_id"]);
				$credentials["question"] = HTML::entities($input["question"]);
				$credentials["opt_one"] = $this->functionController->imageOrText($input["is_img"], $input["opt_one"], $credentials["question"]);
				$credentials["opt_two"] = $this->functionController->imageOrText($input["is_img"], $input["opt_two"], $credentials["question"]);
				$credentials["opt_three"] = $this->functionController->imageOrText($input["is_img"], $input["opt_three"], $credentials["question"]);
				$credentials["opt_four"] = $this->functionController->imageOrText($input["is_img"], $input["opt_four"], $credentials["question"]);
				$credentials["answer"] = $this->functionController->imageOrText($input["is_img"], $input["answer"], $credentials["question"]);
				$credentials["is_img"] = $input["is_img"];


				Question::createQuestion($credentials);

				$result = $this->functionController->result(true, 'add_question', '<div data-alert class="alert-box success radius"><i class="fi-check size-72"></i>&nbsp;You have successfully created Question: <b>' . $credentials["question"] . '</b>, Subject: <b>' . Subject::find($credentials["subject_id"])->subj_code . '</b><a href="#" class="close">&times;</a></div>');
			}

			return $this->functionController->response($result);
		}
	}
	
	public function postUpdateQuestion() {
		if(Request::ajax() || Request::wantsJson() || Request::isJson()) {
			$input = $this->input;
			$credentials = $this->credentials;
			$rules = [
				'type_id' 		=> 'required',
				'subject_id' 	=> 'required',
				'question'		=> 'required',
				'opt_one'		=> 'required',
				'opt_two'		=> 'required',
				'opt_three'		=> 'required',
				'opt_four'		=> 'required',
				'answer'		=> 'required',

			];
			
			$validation = Question::validate($input, $rules);

			if($validation->fails()) {
				$result = $this->functionController->result(false, 'update_quiz', $validation->getMessageBag()->toArray());
			} else {	
				$typeSelected = Type::where('value','=', HTML::entities($input["type_id"]))->first();	
				$subjectSelected = Subject::where('subj_code','=', HTML::entities($input["subject_id"]))->first();	
				
				$credentials["id"] = HTML::entities($input["id"]);
				$credentials["option_id"] = HTML::entities($input["option_id"]);
				$credentials["user_id"] = Sentry::getUser()->id;	
				$credentials["type_id"] = $typeSelected->id;				
				$credentials["subject_id"] = $subjectSelected->id;
				$credentials["question"] = HTML::entities($input["question"]);
				$credentials["opt_one"] = HTML::entities($input["opt_one"]);
				$credentials["opt_two"] = HTML::entities($input["opt_two"]);
				$credentials["opt_three"] = HTML::entities($input["opt_three"]);
				$credentials["opt_four"] = HTML::entities($input["opt_four"]);
				$credentials["answer"] = HTML::entities($input["answer"]);

				Question::updateQuestion($credentials);


				$result = $this->functionController->result(true, 'update_quiz', '<div data-alert class="alert-box success radius"><i class="fi-check size-72"></i>&nbsp;You have successfully updated Question: <b>' . $credentials["question"] . '</b>, Subject: <b>' . $subjectSelected->subj_code . '</b><a href="#" class="close">&times;</a></div>');

			}

			return $this->functionController->response($result);
		}		
	}

	public function postDeleteQuestion() {
		if(Request::ajax() || Request::wantsJson() || Request::isJson()) {
			$input = $this->input;
			$credentials = $this->credentials;
			
			$credentials["id"] = HTML::entities($input["id"]);
			$credentials["opt_one"] = $input["is_img"] == 1 ? HTML::entities($input["opt_one"]) : NULL;
			$credentials["opt_two"] = $input["is_img"] == 1 ? HTML::entities($input["opt_two"]) : NULL;
			$credentials["opt_three"] = $input["is_img"] == 1 ? HTML::entities($input["opt_three"]) : NULL;
			$credentials["opt_four"] = $input["is_img"] == 1 ? HTML::entities($input["opt_four"]) : NULL;
			$credentials["is_img"] = HTML::entities($input["is_img"]);


			Question::deleteQuestion($credentials["id"]);
			$this->functionController->deleteImage($credentials);

			$result = $this->functionController->result(true, 'delete_subject', '<div data-alert class="alert-box success radius"><i class="fi-check size-72"></i>&nbsp;You have successfully deleted a Quiz. <a href="#" class="close">&times;</a></div>');

			return $this->functionController->response($result);

		}
	}


	
}