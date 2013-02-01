<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
<script type="text/javascript" src="http://cloud.github.com/downloads/malsup/cycle/jquery.cycle.all.latest.js"></script>

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
				<li><a href="index.php">HOME</a></li>
				
				<li><a href="oque.php">O QUE É</a>	
				</li>
			
				<li><a href="como.php">COMO FUNCIONA</a>
					
				</li>
	
				<li><a href="painel.php">PAINEL</a>
					
				</li>
	
				<li><a href="procurar.php">PROCURAR</a></li>
		
				<li class="active"><a href="contato.php">CONTATO</a></li>
			</ul>		
		</div>
		<!---------------------------END Menu-------------------------->			
  </div>
  <div class="clear"></div>	
</div>
<!---------------------EOF Header-------------------------->
	
<div class="clear"></div>

	<div class="clear"></div>
<!------------------------------Begin Row------------------------->	
<div class="row">
<div style="text-align:center; width:960px; margin:0 auto; padding-bottom:30px;">
  <h1>CONTATO</h1><h4>Formulário de Contato</h4><br />

<form action="enviar.php" method="POST">
                                <input type="hidden">
                               
                             <center>
                                  
                            <table width="100%" border="0" align="center" ellspacing="0" cellpadding="0">
                              <tr> 
                                <td>Nome:<br> <input type="text" size="30" name="nome" value=""></td>
                              </tr>
                              <tr> 
                                <td>E-mail:<br>
                                  <input type="text" size="30" name="email" value=""></td>
                              </tr>
                              <tr> 
                                <td>Assunto:<br> <input type="text" size="30" name="assunto" value=""></td>
                              </tr>
                              <tr> 
                                <td>Mensagem:<br>
                                  <textarea cols="600" rows="20" name="mensagem" class="estilotextarea"></textarea> 
                                </td>
                              </tr>
                              <tr> 
                                <td align="center"> <a href="#"><img src="images/enviar.png" /> </a>
                                  &nbsp; <img src="images/limpar.png" /> </a></td>
                              </tr>
                            </table>
                              </center>
                              </form> 
            </div>

		  	<div class="clear"></div>
            	
	</div>
</div>

<!------------------------------EOF Row------------------------->
	<br />
	<div class="content_body">
			<div class="lower_container">
				<div class="three_col_left home">
					<div class="three_col_img"><img src="images/homeicon1.png" class="webicon" alt="img"/></div>
					<h4 class="bottom_margin">No Facebook</h4>
					<p>Cadastre sua conta no Facebook e já comece a ajudar. As mensagens serão publicadas no seu mural, sem incomodar você nem seus amigos.</p>
					<p><a href="#">Cadastrar no Facebook agora!</a></p>

				<div class="clear"></div>
			  </div>
              
				
				<div class="three_col home">
					<div class="three_col_img"><img src="images/homeicon2.png" class="webicon" alt="img" /></div>
					<h4 class="bottom_margin">Twitter</h4>
					<p>Instale o aplicativo do Projeto LYLA e ocasionalmente serão postados tweets para ajudar a encontrar os desaparecidos.</p>
<p><a href="#">Cadastrar no Twitter agora!</a></p>
				</div>
				
				<div class="three_col_right home">
					<div class="three_col_img"><img src="images/homeicon3.png" class="webicon"  alt="img"/></div>
					<h4 class="bottom_margin">e no Orkut</h4>
					<p>Você também pode ajudar pelo Orkut. Em suas 'atividades' serão publicadas as mensagens que ajudarão muitas famílias.</p>
<p><a href="#">Cadastrar no Orkut agora!</a></p>
				</div>
				<div class="clear"></div>
				
			</div>
            
            


<!--------------------EOF lower_container-------------------------->




<!--------------------EOF lower_container-------------------------->


<!--------------------Begin lower_container-------------------------->		


	
			
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
