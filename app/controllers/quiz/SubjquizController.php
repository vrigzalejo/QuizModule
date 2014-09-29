<?php namespace App\Controllers\Quiz;

use View, Input, HTML, Request, Redirect, Response, Config;
use App\Models\Subject;
use App\Models\Subjquiz;
use App\Models\Question;
use App\Models\Option;

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

	public function getQuestions()
	{
		return View::make('dashboard.modules.questions.index');
	}



	public function postCreateQuestion() {
		if(Request::ajax() || Request::wantsJson() || Request::isJson()) {
			$input = $this->input;
			$withOrWithOutImg = ($input["is_img"] || $input["is_img"] != NULL ? ['regex:~[0-9a-zA-Z\+/=]{20,}~'] : 'required|alpha_spaces');
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
				$credentials["type_id"] = HTML::entities($input["type_id"]);
				$credentials["subject_id"] = HTML::entities($input["subject_id"]);
				$credentials["question"] = HTML::entities($input["question"]);
				$credentials["opt_one"] = $this->functionController->imageOrText($input["is_img"], $input["opt_one"], $credentials["question"]);
				$credentials["opt_two"] = $this->functionController->imageOrText($input["is_img"], $input["opt_two"], $credentials["question"]);
				$credentials["opt_three"] = $this->functionController->imageOrText($input["is_img"], $input["opt_three"], $credentials["question"]);
				$credentials["opt_four"] = $this->functionController->imageOrText($input["is_img"], $input["opt_four"], $credentials["question"]);
				$credentials["answer"] = $this->functionController->imageOrText($input["is_img"], $input["answer"], $credentials["question"]);
				$credentials["is_img"] = $input["is_img"];


				$question = new Question;
				$question->type_id 		= $credentials["type_id"];
				$question->subject_id 	= $credentials["subject_id"];
				$question->question 	= $credentials["question"];
				// $question->opt_one 		= $credentials["opt_one"];
				// $question->opt_two 		= $credentials["opt_two"];
				// $question->opt_three 	= $credentials["opt_three"];
				// $question->opt_four 	= $credentials["opt_four"];
				// $question->answer 		= $credentials["answer"];
				// $question->is_img 		= $credentials["is_img"];
				$question->save();

				$option = new Option;
				$option->question_id = $question->id;
				$option->opt_one = $credentials["opt_one"];
				$option->opt_two = $credentials["opt_two"];
				$option->opt_three = $credentials["opt_three"];
				$option->opt_four = $credentials["opt_four"];
				$option->answer = $credentials["answer"];
				$option->is_img = $credentials["is_img"];
				$option->save();

				$result = $this->functionController->result(true, 'add_question', '<div data-alert class="alert-box success radius"><i class="fi-check size-72"></i>&nbsp;You have successfully created Question: <b>' . $credentials["question"] . '</b>, Subject: <b>' . Subject::find($credentials["subject_id"])->subj_code . '</b><a href="#" class="close">&times;</a></div>');
			}

			return $this->functionController->response($result);
		}
	}
	
	public function postUpdateQuestion() {
		
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
				$credentials["name"] = HTML::entities($input["add_quiz_name"]);
				$credentials["subject_id"] = HTML::entities($input["add_quiz_subject"]);

				Subjquiz::create([
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
				$credentials["name"] = HTML::entities($input["subjquiz_name"]);
				$subjectSelected = Subject::where('subj_code','=', HTML::entities($input["subjquiz_subject"]))->first();
				$credentials["subject_id"] = $subjectSelected->id;
			
				$subject = Subjquiz::find($input["subjquiz_id"]);
				$subject->name = $credentials["name"];
				$subject->subject_id = $credentials["subject_id"];
				$subject->save();

				$result = $this->functionController->result(true, 'update_quiz', '<div data-alert class="alert-box success radius"><i class="fi-check size-72"></i>&nbsp;You have successfully updated Quiz Name: <b>' . $credentials["name"] . '</b>, Subject: <b>' . $subjectSelected->subj_code . '</b><a href="#" class="close">&times;</a></div>');

			}

			return $this->functionController->response($result);
		}
	}

	public function postDeleteQuiz() {
		if(Request::ajax() || Request::wantsJson() || Request::isJson()) {
			$input = $this->input;
			$credentials = $this->credentials;
			$credentials["id"] = HTML::entities($input["subjquiz_id"]);
			$subjquiz = Subjquiz::find($credentials["id"]);
			$subjquiz->delete();

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
			
				$subject = Subject::find($input["subj_id"]);
				$subject->subj_code = $credentials["subj_code"];
				$subject->subj_description = $credentials["subj_description"];
				$subject->save();

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
			$subject = Subject::find($credentials["id"]);
			$subject->delete();

			$result = $this->functionController->result(true, 'delete_subject', '<div data-alert class="alert-box success radius"><i class="fi-check size-72"></i>&nbsp;You have successfully deleted a subject.</div>');

			return $this->functionController->response($result);

		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

	}

	

}
