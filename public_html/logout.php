<?php
require( "autoload.php" );

try
{
	Sessao::iniciar();
	LoginController::sair();
	LoginView::redirecionarPara( "index.php" );
}
catch( Exception $e )
{
	echo $e->getMessage()."<br />";
}
