@if(Request::is('dashboard/students*') || Request::is('dashboard/subjects*') || Request::is('dashboard/quizzes*') || Request::is('dashboard/questions*'))
<html class="no-js" lang="en" data-ng-app="quizApp">
@else 
<html class="no-js" lang="en">
@endif
