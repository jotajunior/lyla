<?php
include('autoload.php');

class View
{
	public static function dizerOla( $pessoa )
	{
		echo "Olá, ".$pessoa."!";
	}

	public static function iterarSelect( $item, $valor, $ret )
	{
		echo "<select class='cad' id=\"$item\" name=\"$item\">";
		foreach( $ret as $rot )
		{
			if( $rot == $valor )
			{
				echo "<option value=\"$valor\" selected>$valor</option>";
			}
			else
			{
				echo "<option value=\"$rot\">$rot</option>";
			}
		}
		echo "</select>";
	}
}
