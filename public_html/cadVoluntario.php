<?php
require_once( "autoload.php" );

try
{
	VoluntarioController::registrar();
}
catch( Exception $e )
{
	echo $e->getMessage()."<br />";
}

