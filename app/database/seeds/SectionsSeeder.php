<?php

use App\Models\Course;
use App\Models\Section;

class SectionsSeeder extends Seeder {

	public function run() {
		/*
			Delete tables first
		*/
		DB::table('sections')->delete();
		$levels_section = [
			'A','B','C','D','E','F','G','H','I','J', 
			'K','L','M','N','O','P','Q','R','S','T',
			'U','V','W','X','Y','Z'
		];


		$level_g1 = Level::where('level', 'Grade 1')->first();
		$level_g2 = Level::where('level', 'Grade 2')->first();
		$level_g3 = Level::where('level', 'Grade 3')->first();
		$level_g4 = Level::where('level', 'Grade 4')->first();
		$level_g5 = Level::where('level', 'Grade 5')->first();
		$level_g6 = Level::where('level', 'Grade 6')->first();
		$level_g7 = Level::where('level', 'Grade 7')->first();
		$level_g8 = Level::where('level', 'Grade 8')->first();
		$level_g9 = Level::where('level', 'Grade 9')->first();
		$level_g10 = Level::where('level', 'Grade 10')->first();
		$level_g11 = Level::where('level', 'Grade 11')->first();
		$level_g12 = Level::where('level', 'Grade 12')->first();


		for($i = 0; $i < count($levels_section); $i++) {
			$section = new Section;
			$section->level_id = $level_g1->id;
			$section->section = $levels_section[$i];
			$section->save();
		}
		for($i = 0; $i < count($levels_section); $i++) {
			$section = new Section;
			$section->level_id = $level_g2->id;
			$section->section = $levels_section[$i];
			$section->save();
		}
		for($i = 0; $i < count($levels_section); $i++) {
			$section = new Section;
			$section->level_id = $level_g3->id;
			$section->section = $levels_section[$i];
			$section->save();
		}
		for($i = 0; $i < count($levels_section); $i++) {
			$section = new Section;
			$section->level_id = $level_g4->id;
			$section->section = $levels_section[$i];
			$section->save();
		}
		for($i = 0; $i < count($levels_section); $i++) {
			$section = new Section;
			$section->level_id = $level_g5->id;
			$section->section = $levels_section[$i];
			$section->save();
		}
		for($i = 0; $i < count($levels_section); $i++) {
			$section = new Section;
			$section->level_id = $level_g6->id;
			$section->section = $levels_section[$i];
			$section->save();
		}
		for($i = 0; $i < count($levels_section); $i++) {
			$section = new Section;
			$section->level_id = $level_g7->id;
			$section->section = $levels_section[$i];
			$section->save();
		}
		for($i = 0; $i < count($levels_section); $i++) {
			$section = new Section;
			$section->level_id = $level_g8->id;
			$section->section = $levels_section[$i];
			$section->save();
		}
		for($i = 0; $i < count($levels_section); $i++) {
			$section = new Section;
			$section->level_id = $level_g9->id;
			$section->section = $levels_section[$i];
			$section->save();
		}
		for($i = 0; $i < count($levels_section); $i++) {
			$section = new Section;
			$section->level_id = $level_g10->id;
			$section->section = $levels_section[$i];
			$section->save();
		}
		for($i = 0; $i < count($levels_section); $i++) {
			$section = new Section;
			$section->level_id = $level_g11->id;
			$section->section = $levels_section[$i];
			$section->save();
		}
		for($i = 0; $i < count($levels_section); $i++) {
			$section = new Section;
			$section->level_id = $level_g12->id;
			$section->section = $levels_section[$i];
			$section->save();
		}
	}

}