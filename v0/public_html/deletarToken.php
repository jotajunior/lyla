<?php
require_once( "autoload.php" );

try
{
	VoluntarioController::deletarToken();
}
catch( Exception $e )
{
	echo $e->getMessage()."<br />";
}
