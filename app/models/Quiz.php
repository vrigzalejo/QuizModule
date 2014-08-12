<?php namespace App\Models;


class Quiz extends \Basemodel {

	public function student() {
		return $this->belongsTo('Student');
	}
		
	public function subjquiz() {
		return $this->belongsToMany('Subjquiz');
	}

}