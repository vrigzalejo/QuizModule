<?php namespace App\Models;

class Type extends \Basemodel {

	public function quiz() {
		return $this->hasMany('Quiz');
	}

	public function question() {
		return $this->hasMany('Question');
	}

	public static function boot() {
		parent::boot();

		static::deleting(function($type) {
			foreach($type->quiz as $quiz) {
				$quiz->delete();
			}
		});
	}
		
}