<?php

Route::get('/', 'App\Controllers\Quiz\UsersController@getLogin');
Route::post('/', ['before' => 'csrf', 'uses' => 'App\Controllers\Quiz\UsersController@postLogin']);


Route::group(['before' => 'sentry.auth'], function() {
	
	Route::group(['prefix' => 'dashboard'], function() {
		Route::get('/', 'App\Controllers\Quiz\DashboardController@getDashboard');
		Route::get('signout', 'App\Controllers\Quiz\UsersController@getLogout');
	});

	Route::group(['before'=>'student.access'], function() {

		Route::group(['prefix' => 'dashboard'], function() {
			Route::get('takeaquiz', 'App\Controllers\Quiz\QuizzesController@getTakeAQuiz');
		});

		Route::group(['prefix' => 'api'], function() {
			Route::get('takeaquiz', 'App\Controllers\Quiz\ApiController@getTakeAQuiz');
		});
	});
	Route::group(['before'=>'prof.access'], function() {

		Route::group(['prefix' => 'dashboard'], function() {
			Route::get('quizzes', 'App\Controllers\Quiz\QuizzesController@getIndex');
			Route::get('questions', 'App\Controllers\Quiz\QuestionsController@getQuestions');
			Route::get('subjects', 'App\Controllers\Quiz\SubjquizController@getIndex');
			Route::get('students', 'App\Controllers\Quiz\StudentsController@getIndex');
			Route::get('reports', 'App\Controllers\Quiz\ReportsController@getIndex');
			Route::get('users', 'App\Controllers\Quiz\UsersController@getIndex');
			Route::get('settings', 'App\Controllers\Quiz\SettingsController@getIndex');
		
			Route::get('quizzes/{id}', 'App\Controllers\Quiz\ItemsController@getItems');

			Route::group(['before' => 'csrf'], function() {
				Route::post('questions', ['uses' => 'App\Controllers\Quiz\QuestionsController@postCreateQuestion']);	
				Route::post('questions/delete', ['uses' => 'App\Controllers\Quiz\QuestionsController@postDeleteQuestion']);
				Route::post('questions/update', ['uses' => 'App\Controllers\Quiz\QuestionsController@postUpdateQuestion']);				
				Route::post('quizzes', ['uses' => 'App\Controllers\Quiz\SubjquizController@postCreateQuiz']);
				Route::post('quizzes/update', ['uses' => 'App\Controllers\Quiz\SubjquizController@postUpdateQuiz']);
				Route::post('quizzes/delete', ['uses' => 'App\Controllers\Quiz\SubjquizController@postDeleteQuiz']);
				Route::post('quizzes/{id}/delete', ['uses' => 'App\Controllers\Quiz\ItemsController@postDeleteItem']);				
				Route::post('subjects', ['uses' => 'App\Controllers\Quiz\SubjquizController@postCreateSubject']);
				Route::post('subjects/update', ['uses' => 'App\Controllers\Quiz\SubjquizController@postUpdateSubject']);
				Route::post('subjects/delete', ['uses' => 'App\Controllers\Quiz\SubjquizController@postDeleteSubject']);		
				Route::post('students', ['uses' => 'App\Controllers\Quiz\StudentsController@postRegister']);
				Route::post('quizzes/{id}', ['uses' => 'App\Controllers\Quiz\ItemsController@postCreateItem']);							
			});
		});
	
		Route::group(['prefix' => 'api'], function() {
			Route::get('students/{id}', 'App\Controllers\Quiz\ApiController@getApiStudent');
			Route::get('subjects', 'App\Controllers\Quiz\ApiController@getApiSubjectAll');
			Route::get('questions', 'App\Controllers\Quiz\ApiController@getApiQuestionAll');
			Route::get('quizzes', 'App\Controllers\Quiz\ApiController@getApiSubjquizAll');
			Route::get('types', 'App\Controllers\Quiz\ApiController@getApiTypeAll');
			Route::get('sections/{id}', 'App\Controllers\Quiz\ApiController@getApiSection');
			Route::get('subjects/{sid}/quizzes/{id}/items', 'App\Controllers\Quiz\ApiController@getApiItem');
			Route::get('subjects/{sid}/questions', 'App\Controllers\Quiz\ApiController@getApiQuestionBySubject');
		});

			
	});
});

