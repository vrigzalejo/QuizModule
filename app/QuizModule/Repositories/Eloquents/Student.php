<?php namespace QuizModule\Repositories\Eloquents;

use QuizModule\Repositories\AbstractEloquent;

class Student extends AbstractEloquent {

	protected $fillable = ['user_id', 'email', 'studentno', 'lastname', 'firstname', 'mi', 'level', 'section'];

	public function quiz() {
		return $this->hasMany('QuizModule\Repositories\Dashboard\Eloquents\Quiz');
	}		

	public function user() {
		return $this->belongsTo('User');
	}

	public static function studentsBySection($id) {
		$getsection = Section::find($id)->section;
		$getlevel = Section::find($id)->level->level;
		return static::select(
			'users.id','users.activated','users.activation_code','users.last_login','users.created_at',
			'users.updated_at',
			'students.id','students.user_id', 'students.studentno', 'students.email', 'students.lastname',
			'students.firstname','students.mi','students.level','students.section',
			'students.created_at as stud_created_at',
			'students.updated_at as stud_updated_at',
			'students.deleted_at as stud_deleted_at'
			)
			->leftJoin('users','students.user_id','=','users.id')
			->where('students.section','=',$getsection)
			->where('students.level','=',$getlevel)
			->get();
	}

}