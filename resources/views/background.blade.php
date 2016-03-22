<?php
	$color="blue darken-2";
	$brand="Virtue Pays";
	$showfloating=true;
	$colortext="blue-text text-darken-2";

	if(isset($overridecolor)){
		$color=$overridecolor;
	}

	if(isset($overridefloating)){
		$showfloating=$overridefloating;
	}

	if(isset($overridebrand)){
		$brand=$overridebrand;
	}

	$footerheader="Chambamex es un producto de ITESM.com.mx";

	$footerbody="Autopista del Sol km 104, Colonia Real del Puente, C. P. 62790, Xochitepec, Morelos. |  Conmutador: (777) 362 0800. D.R.© Instituto Tecnológico y de Estudios Superiores de Monterrey, México. 2015";
?>






<!DOCTYPE html>
<html>
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>{{$brand}}</title>

	<link href="{{ asset('/css/materialize.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/rating.css') }}" rel="stylesheet">
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<script src="{{ asset('/js/jquery.min-2.1.3.js') }}"></script>
	
	<script src="{{ asset('/js/materialize.js') }}"></script>
	<script src="{{ asset('/js/rating.js') }}"></script>
	<script src="http://malsup.github.com/jquery.form.js"></script> 
	<script src="{{ asset('/js/corefunctionalities.js') }}"></script>

	<style>
		body {
			display: flex;
			min-height: 100vh;
			flex-direction: column;
		}
		.thedate{
			vertical-align: bottom;
		}
		#mytextarea{
			min-height:200px; 
		}
		.laimagen{
			max-height: 250px; 
			max-width: 250px;
		}


 
 		.parallax-container {
      		height: 300px;
    	}

		
	</style>

</head>

<body>



	<!--**********************FLOATING BUTTON************************ -->
	@if (!Auth::guest() && $showfloating)
	<div class="fixed-action-btn " style="bottom: 45px; right: 24px;">
		<a class="btn-floating btn-large waves-effect waves-light {{$color}}" href="{{ url('/new-post') }}"><i class="material-icons">mode_edit</i></a>
	</div>
	@endif




	<!--******************* DROPDOWNS ***********************************-->
	@if (!Auth::guest())
	<ul id="dropdown1" class="dropdown-content">
		<li><a href="{{ url('/user/'.Auth::id()) }}">Profile</a></li>
		<li><a href="{{ url('/logout') }}">Logout</a></li>
	</ul>

	<ul id="dropdown2" class="dropdown-content">
		<li><a href="{{ url('/user/'.Auth::id()) }}">Profile</a></li>
		<li><a href="{{ url('/logout') }}">Logout</a></li>
	</ul>
	@endif


	<!--************************* NAVBAR ********************************-->
	<nav>
		<div class="nav-wrapper {{$color}}">
			<div class="container">				
				
				<a href="{{ url('/home') }}" class="brand-logo">
					{{$brand}}</a>

					<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>

					@if (!Auth::guest())
					<ul class="right hide-on-med-and-down">
						<li><a href="{{ url('/user/'.Auth::id().'/posts') }}">My Posts<i class="material-icons left">toc</i></a></li>
						<li><a class="dropdown-button" href="#!" data-beloworigin="true" data-activates="dropdown1">{{ Auth::user()->name }}<i class="material-icons left">perm_identity</i></a></li>
					</ul>
					<ul class="side-nav" id="mobile-demo">
						<li><a href="{{ url('/user/'.Auth::id().'/posts') }}">My Posts<i class="material-icons left">toc</i></a></li>
						<li><a class="dropdown-button" href="#!" data-beloworigin="true" data-activates="dropdown2">{{ Auth::user()->name }}</a></li>
					</ul>

					@else
					<ul class="right hide-on-med-and-down">
						<li><a href="{{ url('/login') }}">Login<i class="material-icons left">lock_open</i></a></li>
						<li><a href="{{ url('/register') }}">Sign in<i class="material-icons left">toc</i></a></li>
					</ul>
					<ul class="side-nav" id="mobile-demo">
						<li><a href="{{ url('/login') }}">Login<i class="material-icons left">lock_open</i></a></li>
						<li><a href="{{ url('/register') }}">Sign in<i class="material-icons left">toc</i></a></li>
					</ul>
					@endif
				</div>
			</div>
		</nav>



		<!--*********************** CONTENEDORES ****************************-->
		<div class="postbg">
			@yield('postbg')
		</div>


		<div class="container">
			<div class="row">
				<div class="col s12">
					<h2 class="header {{$colortext}}">
						@yield('pagename')					
					</h2>
				</div>
			</div>

			<div class="row">
				<div class="col s12">
					@yield('details')
				</div>
			</div>

			<div class="row">
				<div class="col s12">
					<p class="flow-text">
						@yield('content')				
					</p>
				</div>
			</div>
		</div>

		<!--*********************** FOOTER ****************************-->
		<footer class="page-footer {{$color}}">
			<div class="container">
				<div class="row">
					<div class="col l8 s12">
						<h5 class="white-text">{{$footerheader}}</h5>
						<p class="grey-text text-lighten-4"> {{$footerbody}}</p>
					</div>
					<div class="col l2 offset-l2 s12">
						<h5 class="white-text">Links</h5>
						<ul>
							<li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
							<li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
							<li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
							<li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="footer-copyright">
				<div class="container">
					© 2016 Copyright Text
					<a class="grey-text text-lighten-4 right" href="#!">More Links</a>
				</div>
			</div>
		</footer>

	</body>
</html>




@if (Session::has('message'))
	<script type="text/javascript">
		$( document ).ready(function() {
			Materialize.toast('{{ Session::get('message') }}', 11000) // 4000 is the duration of the toast

		});
	</script>
@endif


@if (Session::has('status'))
	<script type="text/javascript">
		$( document ).ready(function() {
			Materialize.toast('{{ Session::get('status') }}', 11000) // 4000 is the duration of the toast
		});
	</script>
@endif




@if (count($errors) > 0)
	@foreach ($errors->all() as $error)
		<script type="text/javascript">
			$( document ).ready(function() {
			  Materialize.toast('{{$error}}', 11000) // 4000 is the duration of the toast
			});
		</script>
	@endforeach
@endif

