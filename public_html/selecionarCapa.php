<?php
require_once( "autoload.php" );

try
{
	DesapController::mostrarSelecionarCapa();
}
catch( Exception $e )
{
	echo $e->getMessage()."<br />";
}
