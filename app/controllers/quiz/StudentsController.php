<?php namespace App\Controllers\Quiz;

use Sentry, View, Input, Validator, HTML, Request, Redirect;
use App\Models\Level;
use App\Models\Section;
use App\Models\Student;

class StudentsController extends \BaseController {

	protected $input;
	protected $credentials;
	protected $functionController;

	public function __construct(\App\Controllers\Quiz\FunctionController $functionController) {
		$this->input = Input::all();
		$this->credentials = [];
		$this->functionController = $functionController;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return View::make('dashboard.modules.students.index');
	}

	public function postRegister() {
		$input = $this->input;
		$credentials = $this->credentials;
		$rules = [
			'register_studentno' => 'required|unique:users,studentno|regex:/^([0-9]{2})+([-])+([0-9]{4})([0-9]{1})?$/',
			'register_email' 	 => 'email|unique:users,email',
			'password'			 => 'required|min:8|confirmed',
			'password_confirmation' => 'required|min:8',
			'register_lastname'  => 'required|alpha',
			'register_firstname' => 'required|alpha',
			'register_mi'		 => 'required|alpha|max:3',
			'register_level'	 => 'required',
			'register_section'	 => 'required'
			
		];
		$validation = Student::validate($input, $rules);

		if($validation->fails()) {
				$result = $this->functionController->result(false, 'register');
		} else {
			$credentials["email"] = HTML::entities($input["register_email"]);
			$credentials["studentno"] = HTML::entities($input["register_studentno"]);
			$credentials["password"] = HTML::entities($input["password_confirmation"]);
			$credentials["last_name"] = HTML::entities($input["register_lastname"]);
			$credentials["first_name"] = HTML::entities($input["register_firstname"]);

			try {
				$user = Sentry::register($credentials, true);
				$studentGroup = Sentry::findGroupByName('Student');
				$user->addGroup($studentGroup);

				$user_id = Sentry::findUserByLogin($credentials["studentno"])->getId();
				$level = Level::find(Input::get('register_level'))->level;
				$section = Section::find(Input::get('register_section'))->section;


				Student::create([
					'user_id'	=> $user_id,
					'email'		=> $credentials["email"],
					'studentno' => $credentials["studentno"],
					'lastname'	=> $credentials["last_name"],
					'firstname'	=> $credentials["first_name"],
					'mi'		=> HTML::entities(Input::get('register_mi')),
					'level'		=> $level,
					'section'	=> $section,
					'created_at' => new \DateTime,
					'updated_at' => new \DateTime
				]);

				$result = $this->functionController->result(true, 'register', '<div data-alert class="alert-box success radius"><i class="fi-check size-72"></i>&nbsp;You have successfully registered Student No.: <b>' . $credentials["studentno"] . '</b>, Student Name: <b>' . $credentials["last_name"] . ', '	. $credentials["first_name"] . ' ' . HTML::entities(Input::get('register_mi')) . '</b><a href="#" class="close">&times;</a></div>');
				//$result["_redirect"] = Redirect::to('/');

			} catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
				$throttle = Sentry::findThrottlerByUserLogin($input["email"]);
				$result = $this->functionController->result(false, 'register', '<div data-alert class="alert-box alert radius"><i class="fi-alert size-72"></i>&nbsp;Wrong password. Login attempt ( '.$throttle->getLoginAttempts().'/'.$throttle->getAttemptLimit().' ).<a href="#" class="close">&times;</a></div>');
			} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
				$result = $this->functionController->result(false, 'register', '<div data-alert class="alert-box alert radius"><i class="fi-alert size-72"></i>&nbsp;User was not found in the database.<a href="#" class="close">&times;</a></div>');
			} catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
				$result = $this->functionController->result(false, 'register', '<div data-alert class="alert-box alert radius"><i class="fi-alert size-72"></i>&nbsp;User is not activated and cannot be logged in.<a href="#" class="close">&times;</a></div>');
			} catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
				$result = $this->functionController->result(false, 'register', '<div data-alert class="alert-box alert radius"><i class="fi-alert size-72"></i>&nbsp;User is suspended for '. Sentry::findThrottlerByUserLogin($input["email"])->getSuspensionTime() .' minutes.<a href="#" class="close">&times;</a></div>');
			} catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
				$result = $this->functionController->result(false, 'register', '<div data-alert class="alert-box alert radius"><i class="fi-alert size-72"></i>&nbsp;User is banned and cannot be logged in.<a href="#" class="close">&times;</a></div>');
			}
		}

		if(Request::ajax() || Request::wantsJson() || Request::isJson())
			return $result;
		else {
			if($result["success"]) {
				return Redirect::to('/dashboard/students')
					->with([
					'for'	  => $result["for"],
					'message' => $result["message"]
					]);
			} else {
				return Redirect::to('/dashboard/students')
					->withErrors($validation);
			}

		}		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
		//
	}


}
