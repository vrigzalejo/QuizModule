<?php namespace App\Models;


class Level extends \Basemodel {
		
	public function section() {
		return $this->hasMany('Section');
	}
}