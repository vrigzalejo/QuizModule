<?php

use App\Models\Level;

class LevelsSeeder extends Seeder {

	public function run() {
		/*
			Delete tables first
		*/
		DB::table('levels')->delete();

		$levels = [
			'Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6','Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'
		];

		for($i = 0; $i < count($levels); $i++) {
			$level = new Level;
			$level->level = $levels[$i];
			$level->save();
		}

	}

}