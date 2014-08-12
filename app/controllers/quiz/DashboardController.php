<?php namespace App\Controllers\Quiz;

use View;

class DashboardController extends \BaseController {


	public function __construct() {
		$this->beforeFilter('csrf', ['on'=>'post|put|patch']);
	}


	public function getDashboard() {

		return View::make('dashboard.dashboardcontents');
	}


}
