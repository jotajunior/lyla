<?php
require( "autoload.php" );
?>
<html>
<body>
<center>
<?php

try
{
	Sessao::iniciar();
	LoginController::areaRestrita("admin");
	AdminController::listarPendentes();
}
catch( Exception $e )
{
	echo $e->getMessage()."<br />";
}
?>
<a href="logout.php" />Sair</a></center>
