<?php namespace App\Models;


class Subject extends \Basemodel {

	protected $fillable = ['subj_code', 'subj_description'];

	public function quiz() {
		return $this->hasManyThrough('Quiz', 'Subjquiz');
	}


	public function question() {
		return $this->hasMany('Question');
	}
		
}