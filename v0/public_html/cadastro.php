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
<!------------------------------Begin Row------------------------->	
<div class="row">
<div style="width:960px; margin:0 auto; padding-bottom:30px;">
 <center> <h1>CADASTRO</h1><h4>Formulário de Cadastro</h4><br />

	Este é motivo de existir do Projeto Lyla. Coloque informações verdadeiras, concisas e deixe o sistema agir!<br><br><br></center>
<form action="cadDesap.php" method="POST" id="cadd">
		<table>
		<tbody><tr><td><b>Nome:</b> </td><td><input name="nome" id="nome" class="cad" type="text"></td></tr>
		<tr><td><b>Data de Nascimento:</b> </td><td><input class="cad" name="data_nasc" id="data_nasc" type="text"></td></tr>
		<tr><td><b>Cor:</b> </td><td><select id="cor" class="cad" name="cor"><option selected="selected" value="branco">Branco</option><option value="negro">Negro</option><option value="asiático">Asiático</option><option value="indígena">Indígena</option><option value="mulato">Mulato</option></select></td></tr>
		<tr><td><b>Olhos:</b> </td><td><select class="cad" id="cor_olhos" name="cor_olhos"><option selected="selected" value="castanho">Castanho</option><option value="azul">Azul</option><option value="preto">Preto</option><option value="verde">Verde</option><option value="castanho-claro">Castanho-claro</option></select></td></tr>
		<tr><td><b>Altura:</b> </td><td><input class="cad" id="altura" name="altura" type="text"></td></tr>
		<tr><td><b>Tipo Físico:</b> </td><td><select class="cad" id="tipo_fisico" name="tipo_fisico"><option selected="selected" value="obeso">Obeso</option><option value="acima do peso">Acima do peso</option><option value="normal">Normal</option><option value="magro">Magro</option><option value="muito magro">Muito magro</option></select></td></tr>
		<tr><td><b>Cidade do desaparecimento:</b> </td><td><input class="cad" name="cidade_desap" id="cidade_desap" type="text"></td></tr>
			<tr><td><b>Estado do desaparecimento:</b> </td><td><select name="estado_desap" id="estado_desap" class="cad">
			<option selected="selected" value="AC">AC</option>
			<option value="AL">AL</option>
			<option value="AM">AM</option>
			<option value="AP">AP</option>
			<option value="BA">BA</option>
			<option value="CE">CE</option>
			<option value="DF">DF</option>
			<option value="ES">ES</option>
			<option value="GO">GO</option>
			<option value="MA">MA</option>
			<option value="MG">MG</option>
			<option value="MS">MS</option>
			<option value="MT">MT</option>
			<option value="PA">PA</option>
			<option value="PB">PB</option>
			<option value="PE">PE</option>
			<option value="PI">PI</option>
			<option value="PR">PR</option>
			<option value="RJ">RJ</option>
			<option value="RN">RN</option>
			<option value="RO">RO</option>
			<option value="RR">RR</option>
			<option value="RS">RS</option>
			<option value="SC">SC</option>
			<option value="SE">SE</option>
			<option value="SP">SP</option>
			<option value="TO">TO</option>
			</select>
			</td></tr>
		<tr><td><b>Dados adicionais:</b> </td><td><textarea id="adicionais" class="cad" name="adicionais"></textarea></td></tr>
		<tr><td><b>Senha:</b> </td><td><input name="senha" id="senha" class="cad" type="password"></td></tr>
		<tr><td><b>Repita a senha: </b></td><td><input name="senhaVerificador" class="cad" id="senhaVerificador" type="password"></td></tr>
		<tr><td><b>Contato:</b> </td><td><input name="contato" id="contato" class="cad" type="text"></td></tr>
		
		</tbody></table>
        <tr align="center"><td align="center"><a href="#" class="cadsub" onclick="$('#cadd').submit();" type="submit"><center><img src="images/next.png" /></center></a></td></tr>
		</form></center> 
            </div>

		  	<div class="clear"></div>
            	
	</div>
</div>

<!------------------------------EOF Row------------------------->
	<br />
	<div class="content_body">
			<div class="lower_container">
            
				<div class="three_col_left home">
					<center><div class="three_col_img"><img src="images/warning.png" alt="img"/></div>
					<h4 class="bottom_margin">Seriedade</h4>
					<p>Não utilize o sistema para brincadeiras, insira informações verdadeiras sobre desaparecidos.</p>
					</center>

				<div class="clear"></div>
			  </div>
              
				
				<div class="three_col home">
					<div class="three_col_img"><img src="images/clock.png" alt="img" /></div>
					<h4 class="bottom_margin">Paciência</h4>
					<p>Os dados serão verificados e por isso não entrarão automáticamente no sistema; por isso não crie diversos cadastros, aguarde até as informações serem aprovadas. </a></p>
				</div>
				
				<div class="three_col_right home">
					<div class="three_col_img"><img src="images/bd.png" alt="img"/></div>
					<h4 class="bottom_margin">Divulgação</h4>
					<p>Após os dados serem aprovados, eles começarão a aparecer em redes sociais e na página do projeto.</a></p>
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
