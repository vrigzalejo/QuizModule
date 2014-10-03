<?php namespace App\Controllers\Quiz;

use View, Input, HTML, Request, Redirect, Response, Config, Sentry;
use App\Models\Subject;
use App\Models\Subjquiz;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Type;
use App\Models\Item;

class ItemsController extends \BaseController {

	protected $input;
	protected $credentials;
	protected $functionController;

	public function __construct(\App\Controllers\Quiz\FunctionController $functionController) {
		$this->input = Input::all();
		$this->credentials = [];
		$this->functionController = $functionController;
	}

	public function getItems($id) {
		$subjquiz = Subjquiz::find($id);

		if( !$subjquiz ) {
			return Redirect::to('/');
		}
		return View::make('dashboard.modules.quizzes.items')
			->with('subjquiz', $subjquiz);
	}

	public function postCreateItem()
	{
		if(Request::ajax() || Request::wantsJson() || Request::isJson()) {
			$input = $this->input;
			$credentials = $this->credentials;
			$rules = [
				'subjquiz_id'		=> 'required',
				'question_id' 		=> 'required'
			];
			// Used the main Validator class for Sentry
			$validation = Item::validate($input, $rules);

			if($validation->fails()) {
					$result = $this->functionController->result(false, 'add_item', $validation->getMessageBag()->toArray());
			} else {
				$credentials["subjquiz_id"] = HTML::entities($input["subjquiz_id"]);
				$credentials["question_id"] = HTML::entities($input["question_id"]);

				Item::create([
					'subjquiz_id'	=> $credentials["subjquiz_id"],
					'question_id' 	=> $credentials["question_id"]
				]);
			
				$result = $this->functionController->result(true, 'add_item', '<div data-alert class="alert-box success radius"><i class="fi-check size-72"></i>&nbsp;You have successfully registered Question: <b>'
				 . Question::find($credentials["question_id"])->first()->question
				 . '</b><a href="#" class="close">&times;</a></div>');
			}

			return $this->functionController->response($result);
		}

	}


	public function postDeleteItem() {
		if(Request::ajax() || Request::wantsJson() || Request::isJson()) {
			$input = $this->input;
			$credentials = $this->credentials;

			$credentials["id"] = HTML::entities($input["id"]);

			Item::deleteItem($credentials);

			$result = $this->functionController->result(true, 'delete_item', '<div data-alert class="alert-box success radius"><i class="fi-check size-72"></i>&nbsp;You have successfully deleted a subject.</div>');

			return $this->functionController->response($result);

		}
	}

}