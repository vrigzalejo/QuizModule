<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> 
<!--<![endif]-->
<!-- Developed by Vrigz Alejo -->
@yield('html')
<head>
	<meta charset="utf-8" />
	<meta name="csrf-token" content="<?= csrf_token() ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	@yield('title')
	<link rel="stylesheet" href="/assets/css/normalize.css" />
	<link rel="stylesheet" href="/assets/css/foundation.css" />
	<link rel="stylesheet" href="/assets/css/dashboard.css" />
	<link rel="stylesheet" href="/assets/css/app.css" />
	@yield('styles')
	@yield('angular.scripts')
	<script type="text/javascript" src="/assets/js/vendors/modernizr/modernizr.js"></script>
</head>
<body>
	@yield('nav')

	@yield('contents')
	<div class="scroll-top-wrapper">
    	<span class="scroll-top-inner">
    		<i class="fa fa-2x fa-arrow-circle-up"></i>
    	</span>
    </div>
	@yield('scripts')
	
</body>
</html>
