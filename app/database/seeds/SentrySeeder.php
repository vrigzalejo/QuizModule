<?php

class SentrySeeder extends Seeder {

	public function run() {
		/*
			Delete tables first
		*/
		DB::table('users')->delete();
		DB::table('groups')->delete();
		DB::table('users_groups')->delete();

		/*
			Create Users to users table
		*/
		$this->createUser('vrigz@admin.com', '00-000000', 'vrigz', 'Vrigz', 'Alejo', 1);
		$this->createUser('teacher@teacher.com', '00-000001', 'mamracquel', 'Racquel', 'Cortez', 1);
		$this->createUser('student@student.com', '00-000002', 'student', 'Foo', 'Bar', 1);
		

		/*
			Create Group to groups table
		*/
		$this->createGroup('SuperAdmin', ['system' => 1, 'system.prof' => 1, 'system.student' => 1]);
		$this->createGroup('Professor', ['system.prof' => 1, 'system.student' => 1]);
		$this->createGroup('Student', ['system.student' => 1]);

		/*
			 Assign user permissions
		*/
		$super = $this->byStudentNo('00-000000');
		$superGroup = $this->byGroup('SuperAdmin');
		$super->addGroup($superGroup);

		$guest = $this->byStudentNo('00-000001');
		$guestGroup = $this->byGroup('Professor');
		$guest->addGroup($guestGroup);
		
		$guest = $this->byStudentNo('00-000002');
		$guestGroup = $this->byGroup('Student');
		$guest->addGroup($guestGroup);
	}

	/* 
		Created static functions to lessen repetitions
	*/
	private static function byStudentNo($studentno) {
		return Sentry::getUserProvider()->findByLogin($studentno);
	}

	private static function byGroup($group) {
		return Sentry::getGroupProvider()->findByName($group);
	}

	private static function createUser($email = NULL, $studentno = NULL, $password = NULL, 
		$firstName = NULL, $lastName = NULL, $activated = NULL) {

		return Sentry::getUserProvider()->create(
			[
			'email'			=> $email,
			'studentno'		=> $studentno,
			'password'		=> $password,
			'first_name'	=> $firstName,
			'last_name'		=> $lastName,
			'activated'		=> $activated
			]
		);
	}

	private static function createGroup($name = NULL, array $permissions) {

		return Sentry::getGroupProvider()->create(
			[
			'name'			=> $name,
			'permissions'	=> $permissions
			]
		);
	}


}