<?php
require_once( "autoload.php" );

try
{
	DesapController::selecionarCapa();
}
catch( Exception $e )
{
	echo $e->getMessage()."<br />";
}
