<?php

Route::get('/', 'App\Controllers\Quiz\UsersController@getLogin');
Route::post('/', ['before' => 'csrf', 'uses' => 'App\Controllers\Quiz\UsersController@postLogin']);


Route::group(['before' => 'sentry.auth'], function() {
	Route::get('/dashboard', 'App\Controllers\Quiz\DashboardController@getDashboard');
	Route::get('/dashboard/signout', 'App\Controllers\Quiz\UsersController@getLogout');

	/*
	Route::get('/dashboard/acquisitions', 'AcquisitionsController@getIndex');
	Route::get('/dashboard/requisitions', 'RequisitionsController@getIndex');
	Route::get('/dashboard/procurements', 'ProcurementsController@getIndex');
	Route::get('/dashboard/itemsandmeals','ItemsAndMealsController@getIndex');
	Route::get('/dashboard/histories',	  'HistoriesController@getIndex');
	Route::get('/dashboard/divisions',	  'DivisionsController@getIndex');
	Route::get('/dashboard/offices', 	  'OfficesController@getIndex');
	Route::get('/dashboard/employees', 	  'EmployeesController@getIndex');
	Route::get('/dashboard/reports', 	  'ReportsController@getIndex');
	Route::get('/dashboard/vendors', 	  'VendorsController@getIndex');
	
	Route::group(['before'=>'superadmin.access|admin.access'], function() {
		Route::get('/dashboard/users', 		  'UserController@getIndex');
		Route::get('/dashboard/settings', 	  'SettingsController@getIndex');
});	
	*/
	Route::group(['before'=>'student.access'], function() {
		Route::get('/dashboard/takeaquiz', 'App\Controllers\Quiz\QuizzesController@getTakeAQuiz');
	});

	Route::group(['before'=>'prof.access'], function() {
		Route::get('/dashboard/quizzes', 'App\Controllers\Quiz\QuizzesController@getIndex');
		Route::get('/dashboard/questions', 'App\Controllers\Quiz\SubjquizController@getQuestions');
		Route::get('/dashboard/subjects', 'App\Controllers\Quiz\SubjquizController@getIndex');
		Route::get('/dashboard/students', 'App\Controllers\Quiz\StudentsController@getIndex');
		Route::get('/dashboard/reports', 'App\Controllers\Quiz\ReportsController@getIndex');
		Route::get('/dashboard/users', 'App\Controllers\Quiz\UsersController@getIndex');
		Route::get('/dashboard/settings', 'App\Controllers\Quiz\SettingsController@getIndex');
	
		Route::post('/dashboard/questions', ['before' => 'csrf', 'uses' => 'App\Controllers\Quiz\SubjquizController@postCreateQuestion']);	
		Route::post('/dashboard/quizzes', ['before' => 'csrf', 'uses' => 'App\Controllers\Quiz\SubjquizController@postCreateQuiz']);
		Route::post('/dashboard/quizzes/update', ['before' => 'csrf', 'uses' => 'App\Controllers\Quiz\SubjquizController@postUpdateQuiz']);
		Route::post('/dashboard/quizzes/delete', ['before' => 'csrf', 'uses' => 'App\Controllers\Quiz\SubjquizController@postDeleteQuiz']);				
		Route::post('/dashboard/subjects', ['before' => 'csrf', 'uses' => 'App\Controllers\Quiz\SubjquizController@postCreateSubject']);
		Route::post('/dashboard/subjects/update', ['before' => 'csrf', 'uses' => 'App\Controllers\Quiz\SubjquizController@postUpdateSubject']);
		Route::post('/dashboard/subjects/delete', ['before' => 'csrf', 'uses' => 'App\Controllers\Quiz\SubjquizController@postDeleteSubject']);		
		Route::post('/dashboard/students', ['before' => 'csrf', 'uses' => 'App\Controllers\Quiz\StudentsController@postRegister']);
			
		Route::get('/api/students/{id}', 'App\Controllers\Quiz\ApiController@getApiStudent');
		Route::get('/api/subjects', 'App\Controllers\Quiz\ApiController@getApiSubjectAll');
		Route::get('/api/questions', 'App\Controllers\Quiz\ApiController@getApiQuestionAll');
		Route::get('/api/quizzes', 'App\Controllers\Quiz\ApiController@getApiSubjquizAll');
		Route::get('/api/types', 'App\Controllers\Quiz\ApiController@getApiTypeAll');
		Route::get('/api/sections/{id}', 'App\Controllers\Quiz\ApiController@getApiSection');
			
	});
});

