<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('SentrySeeder');
		$this->command->info('Sentry tables seeded!');
		$this->call('SettingsSeeder');
		$this->command->info('Settings table seeded!');
		$this->call('LevelsSeeder');
		$this->command->info('Levels table seeded!');
		$this->call('SectionsSeeder');
		$this->command->info('Sections table seeded!');
		$this->call('TypesSeeder');
		$this->command->info('Types table seeded!');

	}

}
