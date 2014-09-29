<?php namespace App\Models;

class Option extends \Basemodel {

	public function question() {
		return $this->belongsTo('Question');
	}
		
}