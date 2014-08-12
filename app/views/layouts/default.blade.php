<!DOCTYPE html>
<!-- Developed by Vrigz Alejo -->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="<?= csrf_token() ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/assets/ico/favicon.ico">
   	@yield('title')
    <link rel="stylesheet" href="/assets/css/bootstrap.css" />
    @yield('styles')
 </head>

  <body data-spy="scroll" data-offset="0" data-target="#theMenu">
		
	@yield('nav')

	@yield('contents')

	@yield('modal')

  <div class="scroll-top-wrapper ">
      <span class="scroll-top-inner">
          <i class="fa fa-2x fa-arrow-circle-up"></i>
      </span>
  </div>
    <!-- Placed at the end of the document so the pages load faster -->
    @yield('scripts')

  </body>
</html>
