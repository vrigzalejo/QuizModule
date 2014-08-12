<?php namespace App\Controllers\Quiz;

use HTML, Response;

class FunctionController extends \BaseController {

	protected $result;

	public function __construct() {
		$this->result = [];
	}

	/**
	 * [result - In short, messages]
	 * @param  [boolean] $success 
	 * @param  [string] $for     [In what module]
	 * @param  [string] $message [Result message]
	 * @param  [object] $redirect [Redirect to other page]
	 * @return [array]          [Returns the chained results]
	 */
	public function result($success, $for, $message = NULL, $redirect = NULL) {
		$result = $this->result;
		$result["success"] = $success;
		$result["for"] = $for;
		$message == NULL ? : $result["message"] = $message;
		$redirect == NULL ? : $result["_redirect"] = $redirect;
		return $result;
	}

	/**
	 * [response - JSON response to browser]
	 * @param  [array] $result [Gets the result messages then convert it to JSON]
	 * @return [array]         [Returns the chained]
	 */
	public function response($result) {
		return Response::make(json_encode($result), 200)->header('Content-Type', 'text/json');
	}

	/**
	 * [imageOrText - Validation of image or text]
	 * @param  [Boolean] $isImg      [Gets the checkbox value]
	 * @param  [String] $input      [Gets the input]
	 * @param  [String] $credential [Gets sanitized input]
	 * @return [String]             [Returns if it's image or text]
	 */
	public function imageOrText($isImg, $input, $credential) {
		return $isImg || $isImg != NULL ? $this->convertToImage($input, $credential) : HTML::entities($input);
	}

	/**
	 * [convertToImage - Convertion of Base64 to Image file.]
	 * @param  [String] $input    [Gets the base64 encoded image file]
	 * @param  [String] $question [Gets the question]
	 * @return [String]           [Returns md5 hash filename]
	 */
	public function convertToImage($input, $question) {
		$input = str_replace('data:image/png;base64,', '', $input);
		$input = str_replace(' ', '+', $input);
		$data = base64_decode($input); 
		$newName = md5(strtolower(str_replace(' ', '+', $question.$input))).'.png';
		$path = public_path().'/assets/photos/';
		$saveToPath = $path.$newName;
		if(!file_exists($path)) mkdir($path, 0777);
		$file = file_put_contents($saveToPath, $data); // Save to /assets/photos folder first

		if($file) return $newName; // Return md5 hash filename			
	}

}