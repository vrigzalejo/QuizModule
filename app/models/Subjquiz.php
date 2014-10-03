<?php namespace App\Models;

use DB;

class Subjquiz extends \Basemodel {

	protected $fillable = ['user_id', 'subject_id', 'name'];

	public function quiz() {
		return $this->hasMany('Quiz');
	}

	public function item() {
		return $this->hasMany('Item');
	}

	public function subject() {
		return $this->belongsTo('Subject');
	}

	public function user() {
		return $this->belongsTo('User');
	}

	public static function subjquizAll() {
		return static::select(
			DB::raw('COUNT(items.subjquiz_id) as subjquiz_items'),
			'subjects.id','subjects.subj_code','subjects.subj_description',
			'subjquizzes.id','subjquizzes.name', 'subjquizzes.created_at', 'subjquizzes.updated_at'
			)
			->leftJoin('subjects','subjquizzes.subject_id','=','subjects.id')
			->leftJoin('items','subjquizzes.id','=','items.subjquiz_id')
			->groupBy('subjquizzes.id')
			->get();
	}

	public static function boot() {
		parent::boot();

		static::deleting(function($subjquiz) {
			foreach($subjquiz->quiz as $quiz) {
				$quiz->delete();
			}
		});

		static::deleting(function($subjquiz) {
			foreach($subjquiz->item as $item) {
				$item->delete();
			}
		});
	}

	
}
