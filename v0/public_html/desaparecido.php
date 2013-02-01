<?php
require_once( "autoload.php" );
error_reporting(~E_NOTICE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Projeto Lyla | Propagando a esperança!</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="View/default.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#desap {	
	text-decoration: none;
	width: 40%;
	text-align: center;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 15px;
	font-weight: normal;
	float: right;
	color: #363636;
	padding-right: 50px;
}

#desap table {
	border-style: hidden;
}

#desap td {
	border-width: 1px;
	padding: 5px;
	border-style: solid;
}

#fotos {
	width: 40%;
	float: left;
}
		/*
			Load CSS before JavaScript
		*/
		
		/*
			Slides container
			Important:
			Set the width of your slides container
			Set to display none, prevents content flash
		*/

		#slides {
			padding-left: 100px;
		}
		.slides_container {
			display:none;
		}

		/*
			Each slide
			Important:
			Set the width of your slides
			If height not specified height will be set by the slide content
			Set to display block
		*/
		.slides_container div {
			display:block;
		}
		
		/*
			Optional:
			Reset list default style
		*/
	</style>
	
	<script src="View/jquery.js"></script>
	<script src="View/slides.min.jquery.js"></script>

	
	<script>
		$(function(){
			$('#slides').slides({
				preload: true,
				generateNextPrev: false,
				generatePagination: false,
				autoHeight:true,
				effect: 'fade',
				slideSpeed: 100,
				bigTarget: true
			});
		});
	</script>

</head>
<body>
<div id="wrapper">
<div id="header">
	<div id="logo">
		<a href="index.php"><img src="View/images/lyla.png" /></a>
	</div>
	<!-- end div#logo -->
	<div id="menu"><!--
		<ul>
			<li class="active"><a href="#">HOME</a></li>
			<li><a href="#">O que é?</a></li>
			<li><a href="#">Quem fez?</a></li>
			<li><a href="#">Por quê?</a></li>
		</ul>-->
	</div>
	<!-- end div#menu -->
</div>
<div>
	<div id="page">

				<h2>Esta pessoa está desaparecida:</h2><br /><br />
			<div id="desap">


				<?php
				try
				{
					DesapController::mostrarDesap();
				}
				catch( Exception $e )
				{
					echo $e->getMessage()."<br />";
				}
				?>





			<!-- end div#content -->
			<!-- end div#sidebar -->
			<div style="clear: both; height: 1px"></div>
		</div>
	<!-- end div#page -->
</div>
<!-- end div#wrapper -->
<div id="footer-wrapper">
	<div id="footer">
		<p id="legal">Copyright &copy; 2011 Projeto Lyla | <a href="http://www.jotajunior.com">Jota Júnior</a>. Todos os direitos reservados.
	</div>
</div>
<!-- end div#footer -->
</body>
</html>

