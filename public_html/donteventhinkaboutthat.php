<?php
// IF YOU ARE LOOKIN AT THIS AND YOU'RE NOT ALLOWED TO, REPORT IT TO ME. IT'S A PROJECT FOR GOOD PURPOSES, DON'T MESS IT UP PLZ.
require("autoload.php");
try
{
	Sessao::iniciar(1);
	$view = new LoginView();
	$view->carregar("admin");
	$view->mostrarFormulario();
}
catch( Exception $e )
{
	echo $e->getMessage()."<br />";
}
