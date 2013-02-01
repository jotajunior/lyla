<?php
require( "autoload.php" );

try
{
	Sessao::iniciar();
	DesapController::deletarFoto( );
}
catch( Exception $e )
{
	echo $e->getMessage(), "<br />";
}
