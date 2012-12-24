<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
error_reporting(~E_NOTICE);
require("autoload.php");

try
{
	Sessao::iniciar(1);
						
?>

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
    <div id="coluna1"><br /><center><h1>Destaques</h1></center><br /><center><img src="images/foto.png" /></center><center><h5>Dados</h5></center><br />
    <b> Nome</b>: Fulano da Silva Siclano<br />
    <b> Idade</b>: XX anos<br />
    <b> Desaparecido em:</b>: XX/XX/XX<br />
    <b> Outras informações</b>: -/--/-/-/-/-/-/-<br />
     </div>
<!------------------------------Begin Row------------------------->	
<div class="lado">
<br /><center><h1>É responsável por um<br />desaparecido?</h1></center><br />

Cadastre os dados da pessoa desaparecida no nosso
sistema e, após a aprovação do registro, esses dados serão
divulgados em redes sociais.<br />
<center><br /><a href="cadastro.php"><img src="images/cadastrar.png"></a></center>

<br />
<?php
	DesapView::mostrarInfoOnline();
}	
catch( Exception $e )
{
	echo $e->getMessage()."<br />";
}
?>
</div>
<div class="row">
<div style="text-align:center; width:960px; margin:0 auto; padding-bottom:30px;">
  <h1>PROJETO LYLA</h1><h4>Recuperando a esperança de famílias</h4></div>
		<div class="slider-wrapper theme-pascal">

            <div id="slider" class="nivoSlider">
                <img src="images/slider_image/slider1.jpg" height="420" width="960" alt="" title="<h5>AJUDE</h5>
				<h6>VOCÊ PODE AJUDAR O PROJETO DE DIVERSAS MANEIRAS.</h6>" />
				<img src="images/slider_image/slider2.jpg" alt=""  title="<h5>ESPALHE ESPERANÇA</h5>
				<h6>CADASTRE SUAS CONTAS NAS REDES SOCIAIS!</h6>" />
				<img src="images/slider_image/slider3.jpg" alt="" title="<h5>CADASTRE DESAPARECIDOS</h5>
				<h6>ASSIM ELES PASSARÃO A FAZER PARTE DO NOSSO BANCO DE DADOS!</h6>" />
				
                <img src="images/slider_image/slider4.jpg" alt="" title="#htmlcaption" />
     			<img src="images/slider_image/slider5.jpg" alt="" title="<h5>DIVULGUE</h5>
				<h6>INFORME A SEUS CONHECIDOS SOBRE O SISTEMA E COLABORE AINDA MAIS!</h6>" />
            </div>
            
            <div id="htmlcaption" class="nivo-html-caption">
				<h5>IMPARCIALIDADE</h5>
				<h6>TODOS OS DESAPARECDOS SERÃO DIVULGADOS DA MESMA FORMA!</h6>
            </div>

		  	<div class="clear"></div>
            	
	</div>
</div>

<!------------------------------EOF Row------------------------->
	<br />
	<div class="content_body">
			<div class="lower_container">
				<div class="three_col_left home">
					<div class="three_col_img"><a href="auth_fb_direct.php" target="_self"><img src="images/homeicon1.png" class="webicon" alt="img"/></div>
					<h4 class="bottom_margin">No Facebook</h4></a>
					<p>Cadastre sua conta no Facebook e já comece a ajudar. As mensagens serão publicadas no seu mural, sem incomodar você nem seus amigos.</p>
					<p><a href="auth_fb_direct.php" target="_blank">Cadastrar no Facebook agora!</a></p>

				<div class="clear"></div>
			  </div>
              
				
				<div class="three_col home">
					<div class="three_col_img"><a href="auth_twitter_direct.php?authorize=1&force_write=1" target="_self"><img src="images/homeicon2.png" class="webicon" alt="img" /></a></div>
					<h4 class="bottom_margin">Twitter</h4>
					<p>Instale o aplicativo do Projeto LYLA e ocasionalmente serão postados tweets para ajudar a encontrar os desaparecidos.</p>
<p><a href="auth_twitter_direct.php" target="_blank">Cadastrar no Twitter agora!</a></p>
				</div>
				
				<div class="clear"></div>
				
			</div>
            
            


<!--------------------EOF lower_container-------------------------->




<!--------------------EOF lower_container-------------------------->

<div class="lower_container_border"><img src="images/horizontal-shadow.png" width="940" height="30"  alt="img"/></div>
<!--------------------Begin lower_container-------------------------->		

<div class="lower_container3">
			<div id="our_mission_img"><img src="images/iMac_225.png"  alt="img" /></div>

				<div id="our_mission">
					<h4 class="bottom_margin">Sobre o sistema</h4>
					<p>O nosso sistema basicamente distribui informações, essa é a chave. Pense no Lyla como uma buzina.
Quem fornece as informações? Os responsáveis dos desaparecidos.
Eles cadastram o perfil da pessoa no nosso sistema, e assim são a energia elétrica da nossa buzina. Fornecem o que precisamos.

Já os voluntários são os veículos que o sistema utiliza para ter essa informação distribuída; eles
são o som que essa buzina gera, para avisar o mundo que existe alguém que precisa ser localizado.</p>
					
					
				</div>
					<div id="client_home">
						<h4 class="bottom_margin">Relatos</h4>
						<div id="client_inner">

						<div id="testimonials_home">

						 
						 <blockquote><p>//
										<cite>//</cite></p></blockquote>
						 
										<blockquote><p>//
										<cite>//</cite></p></blockquote>
						 
										<blockquote><p>//
										<cite>//</cite></p></blockquote>
										
						</div>
					 
					</div>


				</div>
			
			<div class="clear"></div>
		</div>
		
	
<!--------------------EOF lower_container-------------------------->
			
					
		<div class="clear"></div>
	</div>

		
<div class="clear"></div>

<!------------------------EOF advert2------------------------------------->		
		

<!-----------------EOF footer--------------------->

<div id="extra2">
	<div class="extra_main">
		<div class="extra_left">© 2012. Projeto LYLA</div>
			<div class="extra_right">
				<ul class="social">
						<li><a href="#"><img src="images/facebook-logo-square.png" width="32" height="32" alt="facebook" /></a></li>
						<li><a href="#"><img src="images/twitter-bird3-square.png" alt="twitter" width="32" height="32"/></a></li>
						<li><a href="#"><img src="images/rss-cube.png" width="32" height="32" alt="rss" /></a></li>
						<li><a href="#"><img src="images/linkedin-logo-square2.png" width="32" height="32" alt="linkedin" /></a></li>
						
				</ul>
			</div>
		</div>
		<div class="clear"></div>
</div>
	<!-----------------------------EOF extra2---------------------------------------->

</div>
<!---------------------------------EOF main--------------------------------------->


<!--Nivo Slider script-->
<script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>

<script type="text/javascript">
$(window).load(function() {
        $('#slider').nivoSlider({
		
        });
    });
    
</script>
</body>
</html>
