@extends('dashboard.dashboard')

@section('module.styles')
<link media="screen" rel="stylesheet" href="/assets/css/responsive-tables.css" />
@stop


@section('module.contents')
<div class="row" style="padding-top:1em;" data-ng-controller="ItemsCtrl" data-ng-init="getQuestions({{{ $subjquiz->subject_id }}}); getItems({{{ $subjquiz->subject_id }}}, {{{ $subjquiz->id }}});">

@if(Session::has('message') && Session::get('for') === 'add_item')
 <div class="row">
 	<div class="small-12 medium-6 large-6 large-centered medium-centered columns">{{ Session::get('message') }}
	</div>
 </div>
 @endif
 @foreach($errors->all() as $error)
  <div class="row">
 	<div class="small-12 medium-6 large-6 large-centered medium-centered columns">
      <div data-alert class="alert-box alert radius"><i class="fi-alert size-72"></i>&nbsp;{{ $error }}<a href="#" class="close">&times;</a></div>
    </div>
  </div>
 @endforeach

@include('dashboard.modules.quizzes._form_items_create')

    <search model="items" filter="search"></search>
	<div data-ng-show="edit >= 0">
	  <div class="row">
		<div data-ng-bind-html="results" class="small-12 medium-6 large-6 large-centered medium-centered columns">
		</div>
	  </div>
	</div>

@include('dashboard.modules.quizzes._table_items')
	<!-- <div pagination="results"></div> -->
</div>
@stop


@section('module.scripts')
<script type="text/javascript" src="/assets/js/vendors/foundation/foundation.abide.js"></script>
<script type="text/javascript" src="/assets/js/vendors/foundation/foundation.alert.js"></script>
<script type="text/javascript" src="/assets/js/vendors/foundation/responsive-tables.js"></script>

@stop