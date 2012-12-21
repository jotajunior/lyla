<?php
include('autoload.php');

class VoluntarioView extends View
{

	private function formatarCampo( $campo )
	{
		return ucfirst( $campo );
	}

	public static function formularioDeAlteracoes( $itens )
	{
		echo "<form action=\"alterarVoluntario.php\" method=\"POST\">";
		echo "<table>";
		foreach( $itens as $item => $valor )
		{
			echo "<tr>";
			if( $item != 'id' )
			{
				echo "<td>".self::formatarCampo( $item ).": </td><td>";
			}
			if( $item == "senha" )
			{
				echo '<input type="password" name="'.$item.'" id="'.$item.'" />';
				echo '</td><tr><td>Confirmar senha: </td><td>';
				echo '<input type="password" name="'.$item.'Verificador" id="'.$item.'Verificador" />'; // para o repita a senha
			}
			else if( $item != "id" )
			{
				echo '<input type="text" name="'.$item.'" id="'.$item.'" value="'.$valor.'" />';
			}
			echo "</td></tr>";
		}
		
		echo "<tr><td><input type=\"submit\" value=\"Alterar\" /></td></tr>";
		echo "</table>";
		echo "</form>";
	}

	public static function listarTokens( $tokens )
	{
		echo "<table>";
		if( count( $tokens ) > 0 )
		{
			foreach( $tokens as $dados )
			{
				echo "<tr><td>";
				echo "<img src=\"".$dados['servico'].".jpg\"></td><td>".$dados['nome']."</td><td><a href=\"deletarToken.php?id=\"".$dados['id']."\">Remover</a></td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		else
		{
			echo "Você ainda não tem nenhuma conta voluntária registrada.";
		}
	}

	public static function adicionarToken( )
	{
		echo "<p>Ajude o Projeto Lyla! Registre sua conta em alguma das seguintes redes sociais e divulgue a esperança.<br />";
		echo "Trabalhamos de forma sutil e não invasiva no seu perfil.<br /></p>";
		echo "<table>";
		echo "<tr><td><a href=\"auth_ok.php\" target=\"_blank\"><img src=\"orkut.jpg\" /> Orkut </a></td></tr>";
		echo "<tr><td><a href=\"auth_fb.php\" target=\"_blank\"><img src=\"facebook.jpg\" /> Facebook </a></td></tr>";
		echo "<tr><td><a href=\"auth_twitter.php?authorize=1&amp;force_write=1\" target=\"_blank\"><img src=\"twitter.jpg\" /> Twitter </a></td></tr>";
		echo "</table>";
	}

	public static function mostrarFormularioCadastro()
	{
		echo '<form action="cadVoluntario.php" method="POST">
		<table>
		<tr><td>Nome: </td><td><input type="text" id="nome" name="nome" /></td></tr>
		<tr><td>E-mail: </td><td><input type="text" id="email" name="email" /></td></tr>
		<tr><td>Login: </td><td><input type="text" id="login" name="login" /></td></tr>
		<tr><td>Senha: </td><td><input type="password" id="senha" name="senha" /></td></tr>
		<tr><td>Repita a senha: </td><td><input type="password" id="senhaVerificador" name="senhaVerificador" /></td></tr>
		<tr><td><input type="submit" value="Colaborar!" /></tr></table></form>';
	}
}
