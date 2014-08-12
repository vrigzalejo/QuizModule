@extends('layouts.default_dashboard')

@section('html')
@include('dashboard._html')
@stop


@section('title')
@include('dashboard._pagetitles')
@stop

@section('styles')
<link rel="stylesheet" href="/assets/css/foundation-icons.css" />
@yield('module.styles')
@stop

@section('angular.scripts')
<script src="/assets/js/vendors/angular/angular.js"></script>
<script src="/assets/js/vendors/angular/ng-infinite-scroll.js"></script>
<script src="/assets/js/vendors/angular/imageupload.js"></script>
<script src="/assets/js/vendors/angular/angular-cookies.js"></script>
<script src="/assets/js/vendors/angular/angular-sanitize.js"></script>
<script src="/assets/js/vendors/angular/loading-bar.js"></script>
@stop

@section('nav')
@include('dashboard._dashboardnavsection')
@stop

@section('contents')
<div class="off-canvas-wrap" data-offcanvas>
    <div class="inner-wrap">
        @include('dashboard._offcanvastogglemenu')

        @include('dashboard._leftcanvas')

        @include('dashboard._rightcanvas')


        @yield('dashboard.contents')
        @yield('module.contents')


        <a class="exit-off-canvas"></a>


    </div>
</div>
@stop

@section('scripts')
<!--
<script src="js/vendor/jquery/dist/jquery.js"></script>  
<script src="js/foundation/foundation.abide.js"></script>
<script src="js/foundation/foundation.accordion.js"></script>
<script src="js/foundation/foundation.alerts.js"></script>    
<script src="js/foundation/foundation.clearing.js"></script>   
<script src="js/foundation/foundation.dropdown.js"></script>
<script src="js/foundation/foundation.equalizer.js"></script>
<script src="js/foundation/foundation.interchange.js"></script>  
<script src="js/foundation/foundation.joyride.js"></script>   
<script src="js/foundation/foundation.js"></script>  
<script src="js/foundation/foundation.magellan.js"></script>
<script src="js/foundation/foundation.offcanvas.js"></script> 
<script src="js/foundation/foundation.orbit.js"></script> 
<script src="js/foundation/foundation.reveal.js"></script>
<script src="js/foundation/foundation.slider.js"></script>   
<script src="js/foundation/foundation.tab.js"></script>  
<script src="js/foundation/foundation.tooltips.js"></script>
<script src="js/foundation/foundation.topbar.js"></script>   
<script src="js/app.js"></script>    
-->

<!-- Main Dashboard's scripts -->
<script src="/assets/js/vendors/jquery/dist/jquery.js"></script> 
<script src="/assets/js/vendors/foundation/foundation.js"></script> 
<script src="/assets/js/vendors/foundation/foundation.topbar.js"></script> 
<script src="/assets/js/vendors/foundation/foundation.offcanvas.js"></script>
<script src="/assets/js/app.js"></script>
<script src="/assets/js/quiz-angular/services.js"></script>
<script src="/assets/js/quiz-angular/directives.js"></script>
<script src="/assets/js/quiz-angular/controllers.js"></script>   
<script src="/assets/js/quiz-angular/quiz.js"></script>  
@yield('module.scripts')
<!-- End --> 
@stop
