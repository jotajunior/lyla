<?php
require_once( "autoload.php" );

try
{
	VoluntarioController::alterar();
}
catch( Exception $e )
{
	echo $e->getMessage()."<br />";
}
