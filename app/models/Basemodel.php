<?php 

class Basemodel extends Eloquent {

	protected $softDeletes = true;

	public static function validate($data = NULL, $rules = NULL) {
		if(!$rules) {
			return Validator::make($data, static::$rules);
		} else {
			return Validator::make($data, $rules);
		}
	}
}