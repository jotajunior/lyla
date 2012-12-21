<?php
require_once('autoload.php');

try
{
	Sessao::iniciar();
	if( $_POST['ativar'] == 1 )
	{
		AdminController::ativarDesap();
	}
	else if ( $_POST['ativar'] == 0 ) // melhor verificar, nao custa nada...
	{
		AdminController::deletarDesap();
		LoginView::redirecionarPara("painelAdmin.php");
	}
}
catch( Exception $e )
{
	echo $e->getMessage()."<br />";
}
