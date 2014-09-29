<?php namespace App\Models;


class Level extends \Basemodel {
		
	public function section() {
		return $this->hasMany('Section');
	}


	public static function boot() {
		parent::boot();

		static::deleted(function($level) {
			$level->section()->delete();
		});
	}
}