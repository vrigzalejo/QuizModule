<?php

use App\Models\Setting;

class SettingsSeeder extends Seeder {

	public function run() {
		/*
			Delete tables first
		*/
		DB::table('settings')->delete();

		$settings = [
			'time' => [1 => '60000']
		];

		/*
			Insert each $settings to Settings table
		*/
		foreach($settings as $k => $v) {
			$setting = new Setting;
			$setting->name = $k;
			$setting->values = json_encode($v);
			$setting->created_at = new DateTime;
			$setting->updated_at = new DateTime;
			$setting->save();
		}
		
	}

}