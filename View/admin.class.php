<?php
include('autoload.php');


class AdminView extends View
{
	public static function listarPendente( $pendente, $fotos )
	{
		//$random = $pendentes[random(0, count($pendentes) - 1 )];   <~ USAR ESSA LÓGICA NO CONTROLLER PARA COLOCAR PENDENTE RANDOM
		DesapView::mostrarDesap( $pendente, $fotos );
		echo '<form action="ativarDesap.php?id='.$pendente['id'].'" method="POST">';
		echo '<input type="radio" name="ativar" id="ativar" value=0> Não<br />';
		echo '<input type="radio" name="ativar" id="ativar" value=1> Sim<br />';
		echo '<input type="submit" value="Decidir" /></form>';
	}
}
