<?php namespace App\Models;


class Section extends \Basemodel {

	public function level() {
		return $this->belongsTo('Level');
	}
		
}