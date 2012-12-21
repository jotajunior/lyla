<?php
require_once( "autoload.php" );
Sessao::iniciar(1);
try
{
	DesapController::registrar();
}
catch( Exception $e )
{
	echo $e->getMessage()."<br />";
}
