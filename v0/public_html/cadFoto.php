<?php
require_once("autoload.php");
try
{
	Sessao::iniciar();
	
	$arg = isset( $_POST['voltar'] ) ? 1 : "";

	DesapController::selecionarFotos( $arg );
}
catch( Exception $e )
{
	echo $e->getMessage()."<br />";
}
