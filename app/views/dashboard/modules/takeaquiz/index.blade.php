@extends('dashboard.dashboard')

@section('module.styles')
<link media="screen" rel="stylesheet" href="/assets/css/responsive-tables.css" />
<link media="screen" rel="stylesheet" href="/assets/css/lightbox.css" />
@stop


@section('module.contents')
<div class="row" style="padding-top:1em;" data-ng-controller="TakeAQuizCtrl">


    <search model="questions" filter="search"></search>
	<div data-ng-show="edit >= 0">
	  <div class="row">
		<div data-ng-bind-html="results" class="small-12 medium-6 large-6 large-centered medium-centered columns">
		</div>
	  </div>
	</div>
	
 @include('dashboard.modules.takeaquiz._table')
</div>
@stop


@section('module.scripts')
<script type="text/javascript" src="/assets/js/vendors/lightbox2/lightbox.min.js"></script>
<script type="text/javascript" src="/assets/js/vendors/foundation/foundation.abide.js"></script>
<script type="text/javascript" src="/assets/js/vendors/foundation/foundation.alert.js"></script>
<script type="text/javascript" src="/assets/js/vendors/foundation/responsive-tables.js"></script>

@stop