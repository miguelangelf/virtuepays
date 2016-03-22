<?php
	$description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a semper sem, ac rutrum mauris. Integer a leo odio. Morbi tristique cursus risus, eu mattis dui venenatis vitae. Vivamus a lacus vitae ligula malesuada sagittis. Aliquam dapibus velit ac gravida viverra.";


		$color="blue darken-2";
	$brand="Virtue Pays";
	$showfloating=true;
	$colortext="blue-text text-darken-2";

?>

<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Virtue Pays</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="css2/main.css" />

		<link href="{{ asset('/css/materialize.css') }}" rel="stylesheet">

		<script src="{{ asset('/js/jquery.min-2.1.3.js') }}"></script>
		<script src="{{ asset('/js/materialize.js') }}"></script>




	</head>
	<body class="landing">









	<!--************************* NAVBAR ********************************-->
	<nav>
		<div class="nav-wrapper {{$color}}">
			<div class="container">				
				
				<a href="{{ url('/home') }}" class="brand-logo">
					Virtue Pays</a>

					<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>

					
				</div>
			</div>
		</nav>








		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
		

				<!-- Banner -->
					<section id="banner">
						<div class="inner">
							<h2>Virtue Pays</h2>
							<p>{{$description}}</p>
							<ul class="actions">
								<li><a href="{{ url('/home') }}" class="button special">Start</a></li>
							</ul>
						</div>
						<a href="#one" class="more scrolly">Learn More</a>
					</section>


<?php
	if(false){
?>

				<!-- Three -->
					<section id="one" class="wrapper style3 special">
						<div class="inner">
							<header class="major">
								<h2>Accumsan mus tortor nunc aliquet</h2>
								<p>Aliquam ut ex ut augue consectetur interdum. Donec amet imperdiet eleifend<br />
								fringilla tincidunt. Nullam dui leo Aenean mi ligula, rhoncus ullamcorper.</p>
							</header>
							<ul class="features">
								<li class="icon fa-paper-plane-o">
									<h3>Arcu accumsan</h3>
									<p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
								</li>
								<li class="icon fa-laptop">
									<h3>Ac Augue Eget</h3>
									<p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
								</li>
								<li class="icon fa-code">
									<h3>Mus Scelerisque</h3>
									<p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
								</li>
								<li class="icon fa-headphones">
									<h3>Mauris Imperdiet</h3>
									<p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
								</li>
								<li class="icon fa-heart-o">
									<h3>Aenean Primis</h3>
									<p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
								</li>
								<li class="icon fa-flag-o">
									<h3>Tortor Ut</h3>
									<p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
								</li>
							</ul>
						</div>
					</section>

				<!-- CTA -->
					<section id="cta" class="wrapper style4">
						<div class="inner">
							<header>
								<h2>Arcue ut vel commodo</h2>
								<p>Aliquam ut ex ut augue consectetur interdum endrerit imperdiet amet eleifend fringilla.</p>
							</header>
							<ul class="actions vertical">
								<li><a href="#" class="button fit special">Activate</a></li>
								<li><a href="#" class="button fit">Learn More</a></li>
							</ul>
						</div>
					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; Untitled</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
						</ul>
					</footer>


<?php
}
?>


			</div>

		<!-- Scripts -->
			<script src="js2/jquery.min.js"></script>
			<script src="js2/jquery.scrollex.min.js"></script>
			<script src="js2/jquery.scrolly.min.js"></script>
			<script src="js2/skel.min.js"></script>
			<script src="js2/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="js2/main.js"></script>

	</body>
</html>