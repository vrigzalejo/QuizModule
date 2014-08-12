@extends('layouts.default')

@section('title')
<title>Quiz Module</title>
@stop

@section('styles')
<!-- Custom styles for this template -->
<link rel="stylesheet" href="/assets/css/style.css" />
<link rel="stylesheet" href="/assets/css/font-awesome.css" />
<link rel="stylesheet" href="/assets/css/nprogress.css" />
@stop

@section('nav')
<!-- Menu -->
<nav class="menu" id="theMenu">
	<div class="menu-wrap">
		<h1 class="logo"><a href="{{ URL::to('/') }}">QUIZ Module</a></h1>
		<i class="fa fa-times menu-close"></i>
		<a href="#home" class="smoothScroll">Home</a>
		<a href="#about" class="smoothScroll">About</a>
		<a href="#developer" class="smoothScroll">Developer</a>
		<a href="#login" class="smoothScroll">Login</a>
		<a href="#"><i class="fa fa-facebook"></i></a>
		<a href="#"><i class="fa fa-twitter"></i></a>
		<a href="#"><i class="fa fa-dribbble"></i></a>
		<a href="#"><i class="fa fa-envelope"></i></a>
	</div>
	
	<!-- Menu button -->
	<div id="menuToggle"><i class="fa fa-bars"></i></div>
</nav>
@stop


@section('contents')
<section id="home" name="home"></section>
<div id="headerwrap">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1>QUIZ Module</h1>
			</div>
		</div><!--/row -->
	</div><!--/container -->
</div><!--/headerwrap -->

<section id="about" name="about"></section>
<div id="aboutwrap">
	<div class="container">
		<div class="row">

			<div class="col-lg-8 col-lg-offset-2 name-desc">
				<h2>This Quiz Module was developed exclusively for Ms. Racquel Cortez's subject quizzes.</h2>

				<div class="col-md-6  text-justify">
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
					<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
				</div>
				<div class="col-md-6 text-justify">
					<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
					<p> Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. </p>
				</div>

			</div><!--/col-lg-8-->

		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- /aboutwrap -->


<div class="sep about" data-stellar-background-ratio="0.5"></div>


<section id="module" name="module"></section>
<div id="modulewrap">

	<div class="container">
		<div class="row mt centered">
			<div class="col-lg-4 proc">
				<i class="fa fa-coffee"></i>
				<h3>The Module</h3>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
			</div>
			<div class="col-lg-4 proc">
				<i class="fa fa-cogs"></i>
				<h3>The Process</h3>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
			</div>
			<div class="col-lg-4 proc">
				<i class="fa fa-heart"></i>
				<h3>The Users</h3>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
			</div>

		</div><!--/row -->
	</div><!--/container -->
</div><!--/modulewrap -->


<div class="sep login-quiz" data-stellar-background-ratio="0.5"></div>

<div id="developer">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 mt">
				

				<div class="item active mb centered">
					<h3>VRIGZ ALEJO</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
					<p><img class="img-circle" src="/assets/img/developer.jpg" width="80"></p>
				</div>


			</div><!--/col-lg-8 -->

		</div><!--/row -->
	</div><!--/container -->
</div><!--/developer -->




<section id="login" name="login"></section>


<div id="loginwrap">
	<div class="container">
		<div class="row">		
		<div class="col-lg-6 col-md-6 col-sm-7 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
			  @if(Session::has('message') && Session::get('for') === 'login')
			    {{ Session::get('message') }}
			  @endif
				  <form method="POST" action="{{ URL::to('/') }}" accept-charset="UTF-8" class="form-signin">
				  {{ Form::token() }}
					<div class="form-group">

						<input name="studentno" type="text" class="form-control" placeholder="Enter student no." required />

						<input name="login_password" type="password" class="form-control" placeholder="Enter password" required />
					</div>
					  	<label>
    					<input type="checkbox" name="remember"> Remember me
 					 	</label>
					<div class="btn-group pull-right">
						<button type="submit" class="btn btn-default">Login</button>
						<button type="reset" class="btn btn-default">Reset</button>
					</div>
				</form>
			</div>
			
		</div><!--/row -->
	</div><!--/container -->
</div><!--/loginwrap-->

<hr>

<div class="container">
	<footer class="centered">
		<p>&copy; Pamantasan ng Lungsod ng Pasig 2014</p>
	</footer>
</div>
@stop



@section('scripts')
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
<script src="/assets/js/vendors/jquery/dist/jquery.js"></script>
<script src="/assets/js/vendors/jquery.nicescroll/jquery.nicescroll.js"></script>     
<script src="/assets/js/vendors/classie/classie.js"></script>
<script src="/assets/js/vendors/bootstrap/bootstrap.min.js"></script>
<script src="/assets/js/vendors/bootstrap/alert.js"></script>
<script src="/assets/js/vendors/smoothscroll/smoothscroll.js"></script>
<script src="/assets/js/vendors/jquery.stellar/jquery.stellar.min.js"></script>   
<script src="/assets/js/main.js"></script>
<script src="/assets/js/vendors/nprogress/nprogress.js"></script>  
<script>
	NProgress.start();
	NProgress.done();
</script>
@stop
