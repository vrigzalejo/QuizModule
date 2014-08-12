@extends('dashboard.dashboard')

@section('module.styles')
<link media="screen" rel="stylesheet" href="/assets/css/responsive-tables.css" />
@stop


@section('module.contents')
<div class="row" style="padding-top:1em;" data-ng-controller="SubjectCtrl">
<div class="row">
	<div class="small-4 medium-2 large-2 small-centered large-centered medium-centered columns">
		<toggle-create caption="Subject" toggled="showAddSubject"></toggle-create>
	</div>
</div>

@include('dashboard.modules.subjects._form_create')

    <search model="subjects" filter="search"></search>
	<div data-ng-show="edit >= 0">
	  <div class="row">
		<div data-ng-bind-html="results" class="small-12 medium-6 large-6 large-centered medium-centered columns">
		</div>
	  </div>
	</div>
	
@include('dashboard.modules.subjects._table')

</div>
@stop


@section('module.scripts')
<script type="text/javascript" src="/assets/js/vendors/foundation/foundation.abide.js"></script>
<script type="text/javascript" src="/assets/js/vendors/foundation/foundation.alert.js"></script>
<script type="text/javascript" src="/assets/js/vendors/foundation/responsive-tables.js"></script>

@stop