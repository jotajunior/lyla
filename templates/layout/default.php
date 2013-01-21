<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>LYLA</title>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="icon" href="favicon.ico" />
		<!-- colorpicker stylesheet -->
		<link rel="stylesheet" type="text/css" href="colorpicker/css/colorpicker.css"/>
		<link rel="stylesheet" type="text/css" href="colorpicker/css/layout.css"/>

		<!-- important stylesheets -->
		<link rel="stylesheet" href="media/css/superfish.css" type="text/css" media="all" />
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:regular,bold" type="text/css" />
		<link rel="stylesheet" href="media/css/default.css" type="text/css" />
		<link rel="stylesheet" href="media/css/style.css" type="text/css" />
		<link rel="stylesheet" href="media/css/nivo-slider.css" type="text/css" media="all" />
		<link rel="stylesheet" href="media/css/pascal.css" type="text/css" media="all" />
		<link rel="stylesheet" href="media/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />

		<!-- important javascripts -->
		<script src="media/js/jquery-1.8.3.min.js" type="text/javascript"></script>
		<script src="media/js/superfish.js" type="text/javascript"></script>
		<script src="media/js/supersubs.js" type="text/javascript"></script>
		<script src="media/js/hoverIntent.js" type="text/javascript"></script>
		<script src="media/js/carousel.js" type="text/javascript"></script>
		<script src="media/js/jquery.prettyPhoto.js" type="text/javascript"></script>
		<script src="media/js/script.js" type="text/javascript"></script>
		<script src="media/jquery/jquery.cycle.all.latest.js" type="text/javascript"></script>

		<!-- colorpicker script -->
		<script type="text/javascript" src="colorpicker/js/eye.js"></script>
		<script type="text/javascript" src="colorpicker/js/utils.js"></script>
		<script type="text/javascript" src="colorpicker/js/colorpicker.js"></script>
		<script type="text/javascript" src="colorpicker/js/scripts.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#testimonials_home')
				.after('<div id="nav2">')
				.cycle({
					fx: 'fade', // choose your transition type, ex: fade, scrollUp, scrollRight, shuffle
					speed: 3000,
					timeout: 2000
				 });
			});
		</script>
	</head>
	<body>
		<div class="container-fluid main default-pat">
			<!---------------Begin header----------------------------------->		
			<header class="row-fluid header">
				<!--<div class="head">-->
				<!---------------Begin Logo----------------------------------->
				<div class="span3 logo">
					<h1><a href="index.php"><img src="media/img/logonew.png" alt="Logo" /></a></h1>
				</div>
				<!---------------End Logo------------------------------------->
					
				<!---------------Begin Menu--------------------------------->
				<div class="span9 menu">
					<ul class="sf-menu">
						<li class="active"><a href="index.php">HOME</a></li>
						<li><a href="oque.php">O QUE É</a></li>
						<li><a href="como.php">COMO FUNCIONA</a></li>
						<li><a href="painel.php">PAINEL</a></li>
						<li><a href="procurar.php">PROCURAR</a></li>
						<li><a href="contato.php">CONTATO</a></li>
					</ul>		
				</div>
				<!---------------------------END Menu-------------------------->			
			</header>
		</div>
		<?php echo $content; ?>
		<footer id="container-fluid extra2">
			<div class="row-fluid extra_main">
				<div class="span6 extra_left">© 2012. Projeto LYLA</div>
				<div class="extra_right">
					<ul class="social">
						<li><a href="#"><img src="media/img/facebook-logo-square.png" width="32" height="32" alt="facebook" /></a></li>
						<li><a href="#"><img src="media/img/twitter-bird3-square.png" alt="twitter" width="32" height="32"/></a></li>
						<li><a href="#"><img src="media/img/rss-cube.png" width="32" height="32" alt="rss" /></a></li>
						<li><a href="#"><img src="media/img/linkedin-logo-square2.png" width="32" height="32" alt="linkedin" /></a></li>	
					</ul>
				</div>
			</div>
		</footer>
	</body>
</html>