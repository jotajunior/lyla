<?php
require_once( "autoload.php" );
?>
<html>
<head>
	<title>Login de Controle de Desaparecidos do Projeto Lyla</title>
</head>
<body>
<center>
<?php
	$view = new LoginView();
	$view->carregar( 'desap' );
	$view->mostrarFormulario();
?>
</center>
</body>
</html>
