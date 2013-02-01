<?php
include("autoload.php");
try
{
	Sessao::iniciar();
	LoginController::areaRestrita('desap');
}
catch(Exception $e)
{
	echo "Você precisa estar logado para cadastrar fotos.<br />", $e->getMessage(),"<br />";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<title>LYLA</title>

<!-- colorpicker stylesheet -->
<link rel="stylesheet" type="text/css" href="colorpicker/css/colorpicker.css"/>
<link rel="stylesheet" type="text/css" href="colorpicker/css/layout.css"/>

<!-- important stylesheets -->
<link rel="stylesheet" href="css/superfish.css" type="text/css" media="all" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:regular,bold" type="text/css" />
<link rel="stylesheet" href="css/default.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/pascal.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />

<!-- important javascripts -->
<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="js/superfish.js" type="text/javascript"></script>
<script src="js/supersubs.js" type="text/javascript"></script>
<script src="js/hoverIntent.js" type="text/javascript"></script>
<script type="text/javascript" src="js/carousel.js"></script>
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="jquery/jquery.cycle.all.latest.js"></script>

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
<div class="main default-pat">

<!---------------Begin header----------------------------------->		
<div class="header">
	<div class="head">
		<!---------------Begin Logo----------------------------------->
			<div class="logo">
				<h1><a href="index.php"><img src="images/logonew.png" alt="Logo" /></a></h1>
			</div>	
			
		<!---------------End Logo------------------------------------->
		
		<!---------------Begin Menu--------------------------------->
		<div class="menu">
			<ul class="sf-menu">
				<li class="active"><a href="index.php">HOME</a></li>
				
				<li><a href="oque.php">O QUE É</a>	
				</li>
			
				<li><a href="como.php">COMO FUNCIONA</a>
					
				</li>
	
				<li><a href="painel.php">PAINEL</a>
					
				</li>
	
				<li><a href="procurar.php">PROCURAR</a></li>
		
				<li><a href="contato.php">CONTATO</a></li>
			</ul>		
		</div>
		<!---------------------------END Menu-------------------------->			
  </div>
  <div class="clear"></div>	
</div>
<!---------------------EOF Header-------------------------->
	
<div class="clear"></div>

	<div class="clear"></div>
<div class="row">
<div style="text-align:center; width:960px; margin:0 auto; padding-bottom:30px;">
          <script type="text/javascript">  
            function abrir() {  
                var arquivo = document.getElementById("foto[]");  
                arquivo.click();  
            }  
              
            function atualizar(campoDe, idPara) {  
                var fileName = document.getElementById(idPara);  
                fileName.value = campoDe.value;  
            }  
  
            function validarBrowser() {  
                if(navigator.appName == "Netscape") {  
                    document.getElementById("fileText").style.display = "none";  
                    document.getElementById("fileOpener").style.display = "block";  
                }  
            }  
             
        </script>  
				<h2>Selecionar</h2><h1><strong> fotos</strong></h1><br />
			Este é o motivo de existir do Projeto Lyla. Coloque informações verdadeiras, concisas e deixe o sistema agir!<br /><br />
<center>
	<form  method="POST" action="cadFoto.php" enctype="multipart/form-data">
		Você pode cadastrar no máximo três fotos: <br />
		<table>
		<tr><td><input type="file" class="cad" name="foto[]" id="foto[]" /></td></tr>
		<tr><td><input type="file"  class="cad" name="foto[]" id="foto[]" /></td></tr>
		<tr><td><input type="file" name="foto[]" class="cad" id="foto[]" /></td></tr>
		<tr><td><input type="submit" class="cadsub" value="Cadastrar!" /></td></tr></table></form>
</center>
</div>

<!------------------------------EOF Row------------------------->
	
<!--------------------EOF lower_container-------------------------->




<!--------------------EOF lower_container-------------------------->

<div class="lower_container_border"><img src="images/horizontal-shadow.png" width="940" height="30"  alt="img"/></div>
			
					
		<div class="clear"></div>
	</div>

		
<div class="clear"></div>

<!------------------------EOF advert2------------------------------------->		
		

<!-----------------EOF footer--------------------->

<!---------------------------------EOF main--------------------------------------->


</body>
</html>
