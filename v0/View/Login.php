<?php

namespace View;

class Login extends View
{
	public function carregar( $classe )
	{
		switch( $classe )
		{
			case 'desap':
			case 'voluntario':
			case 'admin':
				$this->action = $classe;
				$this->url = 'painel'.ucfirst($classe).'.php';
			break;
			default:
				throw new Exception("Não existe login para $classe.");
			break;
		}
	}		
			
	public function mostrarFormulario( )
	{
		echo '<form action="login.php" method="POST">';
		echo '<table>';
		echo '<tr><td>Nome: </td><td><input type="text" name="login" id="login" /></td></tr>';
		echo '<tr><td>Senha: </td><td><input type="password" name="senha" id="senha" /></td></tr>';
		echo '<tr><td><input type="submit" value="Entrar" /></td></tr>';
		echo '<input type="hidden" value="'.$this->action.'" id="tipo" name="tipo" />';
		echo '</table>';
	}
	
}
