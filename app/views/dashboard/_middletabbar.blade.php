<section class="middle tab-bar-section">
	<h1 class="title">
	@if(Request::is('dashboard'))
		Home
	@elseif(Request::is('dashboard/takeaquiz*'))
		Take a Quiz
	@elseif(Request::is('dashboard/quizzes*'))
		Quizzes
	@elseif(Request::is('dashboard/questions*'))
		Questions
	@elseif(Request::is('dashboard/subjects*'))
		Subjects
	@elseif(Request::is('dashboard/students*'))
		Students
	@elseif(Request::is('dashboard/reports*'))
		Reports
	@elseif(Request::is('dashboard/users*'))
		Users
	@elseif(Request::is('dashboard/settings*'))
		Settings
    @endif
    </h1>
</section>