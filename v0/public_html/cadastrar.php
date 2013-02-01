<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Projeto Lyla | Propagando a esperança!</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="View/default.css" rel="stylesheet" type="text/css" />
	
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
		<img src="View/images/lyla.png" />
	</div>
	<!-- end div#logo -->
	<div id="menu">
		<!--<ul>
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
	
	<div id="cad"><center>
				<h1><strong>Cadastro</strong></h1><h2> de desaparecido.</h2><br />
			Este é motivo de existir do Projeto Lyla. Coloque informações verdadeiras, concisas e deixe o sistema agir!<br /><br /><br />
<form action="cadDesap.php" method="POST">
		<table>
		<tr><td>Nome: </td><td><input type="text" name="nome" id="nome" class="cad" /></td></tr>
		<tr><td>Data de Nascimento: </td><td><input type="text" class="cad" name="data_nasc" id="data_nasc" /></td></tr>
		<tr><td>Cor: </td><td><select id="cor" class="cad" name="cor"><option value="branco">Branco</option><option value="negro">Negro</option><option value="asiático">Asiático</option><option value="indígena">Indígena</option><option value="mulato">Mulato</option></select></td></tr>
		<tr><td>Olhos: </td><td><select class="cad" id="cor_olhos" name="cor_olhos"><option value="castanho">Castanho</option><option value="azul">Azul</option><option value="preto">Preto</option><option value="verde">Verde</option><option value="castanho-claro">Castanho-claro</option></select></td></tr>
		<tr><td>Altura: </td><td><input type="text" class="cad" id="altura" name="altura" /></td></tr>
		<tr><td>Tipo Físico: </td><td><select class="cad" id="tipo_fisico"  name="tipo_fisico"><option value="obeso">Obeso</option><option value="acima do peso">Acima do peso</option><option value="normal">Normal</option><option value="magro">Magro</option><option value="muito magro">Muito magro</option></select></td></tr>
		<tr><td>Cidade do desaparecimento: </td><td><input class="cad" type="text" name="cidade_desap" id="cidade_desap" /></td></tr>
			<tr><td>Estado do desaparecimento: </td><td><select name="estado_desap" id="estado_desap" class="cad">
			<option value="AC">AC</option>
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
		<tr><td>Dados adicionais: </td><td><textarea id="adicionais" class="cad" name="adicionais"></textarea></td></tr>
		<tr><td>Senha: </td><td><input type="password" name="senha" id="senha" class="cad" /></td></tr>
		<tr><td>Repita a senha: </td><td><input type="password" name="senhaVerificador" class="cad" id="senhaVerificador" /></td></tr>
		<tr><td>Contato: </td><td><input type="text" name="contato" id="contato" class="cad" /></td></tr>
		<tr><td><input type="submit" value="Próximo passo" class="cadsub" /></td></tr>
		</table>
		</form></center>
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
</html>
