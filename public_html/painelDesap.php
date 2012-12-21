<?php
require_once( "autoload.php" );
try {
	Sessao::iniciar();
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
#page {
	text-decoration: none;
	text-align: center;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 20px;
	font-weight: normal;
	text-shadow: #CDB5CD 0.05em 0.05em;
	color: #363636;
}
#cad {
	padding-bottom: 10px;
	float: right;
	padding-right: 200px;
}
#local {
	float: left;
	padding-left: 200px;
}
#local a {
	text-decoration: none;
	text-align: center;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 25px;
	background-color:#473C8B;
	color: white;
	text-shadow: white 0em 0em;
}

#local h1 {
	font-size: 25px;
}
#local h2 {
	font-size: 20px;
}
#cad td {
	padding: 5px;
}

.cad {
	width: 200px;
	border: 1px solid black;
	color: #000000;
	font-size: 20px;
	height: 28px;
}

.cadsub {
	height: 50px;
	width: 200px;
	border: none;
	background: #473C8B;
	color: white;
	text-decoration: bold;
}

.cadsub:hover, #local a:hover {
	background: #4682B4;
}


        .button {  
            border: 0px;  
            background-color: #473C8B;
	    width: 80px;
	    height: 30px;
	    color: white;
        } 

	.button:hover {
		background: #4682B4;
	}
	</style>
	<script type="text/javascript" src="View/jquery.js"></script>
	<script type="text/javascript" src="View/mask.js"></script>
	<script type="text/javascript">
		jQuery.noConflict();
		(function($) {
		$(function() {
		$('#data_nasc').mask('99/99/9999'); //data
		$('#altura').mask('9.99'); //telefone
		});
		})(jQuery);

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
		<h1><strong>Painel</strong></h1><h2> do desaparecido</h2><br />
	<div id="cad">			
			<?php
					DesapController::formularioDeAlteracoes();
			?>	
	</div>
	<div id="local">


		<h2>Foi </h2><h1><strong>localizado</strong>?</h1><br />
			<?php
					DesapController::localizado();
			?>	<br />
	<hr /><br />
	<a href="foto.php">&nbsp;&nbsp;Gerenciar Fotos&nbsp;&nbsp;</a><br /><br />
	<a href="logout.php">&nbsp;&nbsp;Sair&nbsp;&nbsp;</a>
	</div>
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
<?php
		}
		catch( Exception $e )
		{
			echo $e->getMessage()."<br />";
		}
?>
</html>
