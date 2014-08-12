<?php namespace App\Models;

class Type extends \Basemodel {

	public function quiz() {
		return $this->hasMany('Quiz');
	}

	public function question() {
		return $this->hasMany('Question');
	}
		
}