<?php
require_once( "autoload.php" );
Sessao::iniciar();
try
{
	DesapController::alterar();
}
catch( Exception $e )
{
	echo $e->getMessage()."<br />";
}
