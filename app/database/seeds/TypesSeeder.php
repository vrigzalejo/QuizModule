<?php

use App\Models\Type;

class TypesSeeder extends Seeder {

	public function run() {
		/*
			Delete tables first
		*/
		DB::table('types')->delete();

		$types = [
			'Multiple Choice','Identification'
		];

		for($i = 0; $i < count($types); $i++) {
			$type = new Type;
			$type->value = $types[$i];
			$type->save();
		}

	}

}