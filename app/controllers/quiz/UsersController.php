<?php namespace App\Controllers\Quiz;

use Redirect, View, Input, Validator, Sentry, HTML, Request;
use App\Models\Student;
use App\Models\Level;

class UsersController extends \BaseController {

	protected $functionController;
	protected $input;
	protected $credentials;


	public function __construct(\App\Controllers\Quiz\FunctionController $functionController, Sentry $sentry) {
		$this->beforeFilter('csrf', ['on'=>'post|put|patch']);
		$this->functionController = $functionController;
		$this->input = Input::all();
		$this->credentials = [];
	}

	public function getLogin() {
		// Shows login form
		if(Sentry::check()) {
			return Redirect::to('/dashboard');
		}
		return View::make('login.index');
	}

	public function postLogin() {


		$input = $this->input;
		$credentials = $this->credentials;
		$rules = [
			'studentno'		 => 'required|exists:users,studentno',
			'login_password' => 'required'
		];
		// Used the super class for Sentry
		$validation = Validator::make($input, $rules);

		if($validation->fails()) {

				$result = $this->functionController->result(false, 'login', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><i class="glyphicon glyphicon-warning-sign"></i>&nbsp;Username and Password either does not match, or is not in the database.</div>');
			} else {
				$credentials["studentno"]	= $input["studentno"];
				$credentials["password"]	= $input["login_password"];
				$remember					= (Input::get('remember')) ? true : false;
				try {
					Sentry::authenticate($credentials, $remember);
					$result = $this->functionController->result(true, 'login', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><i class="glyphicon glyphicon-ok"></i>&nbsp;The user is logged in.</div>', Redirect::to('/dashboard'));

				} catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
					$throttle 		   = Sentry::findThrottlerByUserLogin($input["email"]);
					$result = $this->functionController->result(false, 'login', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><i class="glyphicon glyphicon-warning-sign"></i>&nbsp;Wrong password. Login attempt ( '.$throttle->getLoginAttempts().'/'.$throttle->getAttemptLimit().' ).</div>');
				} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
					$result = $this->functionController->result(false, 'login', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><i class="glyphicon glyphicon-warning-sign"></i>&nbsp;User was not found in the database.</div>');
				} catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
					$result = $this->functionController->result(false, 'login', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><i class="glyphicon glyphicon-warning-sign"></i>&nbsp;User is not activated and cannot be logged in.</div>');
				} catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
					$result = $this->functionController->result(false, 'login', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><i class="glyphicon glyphicon-warning-sign"></i>&nbsp;User is suspended for '. Sentry::findThrottlerByUserLogin($input["email"])->getSuspensionTime() .' minutes.</div>');
				} catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
					$result = $this->functionController->result(false, 'login', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><i class="glyphicon glyphicon-warning-sign"></i>&nbsp;User is banned and cannot be logged in.</div>');
				}
			}

			if(Request::ajax() || Request::wantsJson() || Request::isJson())
				return $result;
			else {
				if($result["success"]) 
					return Redirect::to('/dashboard')->with([
						'for'	  => $result["for"],
						'message' => $result["message"]
					]);
				else 
					return Redirect::to('/')->with([
						'for'	  => $result["for"],
						'message' => $result["message"]
					]);
			}

	}

	
	public function getLogout() {
		Sentry::logout();

		return Redirect::to('/');
	}

	public function getIndex() {
		return View::make('dashboard.modules.users.index');
	}
}
