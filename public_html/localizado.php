<?php
require("autoload.php");
try
{
	Sessao::iniciar();
	DesapController::deletar();
}
catch( Exception $e )
{
	echo $e->getMessage()."<br />";
}
