<?php
include('autoload.php');

class DesapView extends View
{

	private static function formatarCampo( $campo )
	{
		switch( $campo )
		{
			case 'data_nasc':
				$campo = 'Data de Nascimento';
			break;
			case 'cidade_desap':
				$campo = 'Cidade do desaparecimento';
			break;
			case 'estado_desap':
				$campo = 'Estado do desaparecimento';
			break;
			case 'cor_olhos':
				$campo = 'Cor dos olhos';
			break;
			case 'tipo_fisico':
				$campo = 'Tipo físico';
			break;
		}
		return ucfirst( $campo );
	}

	public static function formularioDeAlteracoes( $itens )
	{	
		echo 'Link do perfil do desaparecido <a href="desaparecido.php?id='.$itens['id'].'" target="_blank">aqui</a>.<br /><br />
		<form action="alterarDesap.php" method="POST">
		<table>';
		foreach( $itens as $item => $valor )
		{
			echo '<tr>';
			if ($item != 'id' and $item != 'foto' and $item != 'ativo')
			{
				echo '<td>'.self::formatarCampo( $item ).': </td><td>';
			}
			if( $item == "senha" )
			{
				echo '<input class="cad" type="password" name="'.$item.'" id="'.$item.'" />';
				echo '</td><tr><td>Confirmar senha: </td><td>';
				echo '<input type="password" class="cad" name="'.$item.'Verificador" id="'.$item.'Verificador" />'; // para o repita a senha
			}
			else if ( $item == "tipo_fisico" )
			{
				$ret = array('obeso', 'acima do peso', 'normal', 'magro', 'muito magro');
				parent::iterarSelect( $item, $valor, $ret );
			}
			else if ( $item == "cor_olhos" )
			{
				$ret = array('castanho', 'preto', 'azul', 'verde', 'castanho-claro');
				parent::iterarSelect( $item, $valor, $ret );
			}
			else if ( $item == "cor" )
			{
				$ret = array('branco', 'negro', 'asiático', 'indígena', 'mulato');
				parent::iterarSelect( $item, $valor, $ret );
			}
			else if( $item == "estado_desap" )
			{
				$ret = array("AC", "AL", "AM", "AP","BA","CE","DF","ES","GO","MA","MT","MS","MG","PA","PB","PR","PE","PI","RJ","RN","RO","RS","RR","SC","SE","SP","TO");
				parent::iterarSelect( $item, $valor, $ret );
			}
			else if ( $item != 'id' and $item != 'foto' and $item != 'ativo')
			{
				echo '<input type="text" class="cad" name="'.$item.'" id="'.$item.'" value="'.$valor.'" />';
			}
			echo '</td></tr>';
		}		
		echo "<tr><td><input type=\"submit\" value=\"Alterar\" class='cadsub' /></td></tr>";
		echo "</form>";
		echo "</table>";
	}


	public static function localizado( $id )
	{
		echo "<form action=\"localizado.php\"><input type=\"hidden\" id=\"id\" name=\"id\" value=\"$id\" /><input type=\"submit\" class=\"cadsub\" value=\"Sim!\" /> </form>";
		// no localizado, verificar se usuário desap está online, e se ele está SE excluindo (só pode assim).
	}

	public static function mostrarDesap( $dados, $fotos )
	{
		if( $dados == false )
		{
			echo "Esse usuário não foi validado ainda.";
		}
		else
		{
			$dados['data_nasc'] = explode("-", $dados['data_nasc']);
			$dados['data_nasc'] = $dados['data_nasc'][2]."/".$dados['data_nasc'][1]."/".$dados['data_nasc'][0]; //formatting date
		
			echo '<table>
			<tr><td><strong>Nome: </strong></td><td>'.$dados['nome'].'</td></tr>
			<tr><td><strong>Data de Nascimento: </strong></td><td>'.$dados['data_nasc'].'</td></tr>
			<tr><td><strong>Cor: </strong></td><td>'.$dados['cor'].'</td></tr>
			<tr><td><strong>Olhos: </strong></td><td>'.$dados['cor_olhos'].'</td></tr>
			<tr><td><strong>Altura: </strong></td><td>'.$dados['altura'].'</td></tr>
			<tr><td><strong>Tipo físico: </strong></td><td>'.$dados['tipo_fisico'].'</td></tr>
			<tr><td><strong>Local do desaparecimento: </strong></td><td>'.$dados['cidade_desap'].'-'.$dados['estado_desap'].'</td></tr>
			<tr><td><strong>Contato: </strong></td><td>'.$dados['contato'].'</td></tr>
		
			<tr><td colspan="2"><strong>Informações adicionais:</strong></td></tr>
			<tr><td colspan="2" rowspan="10">'.$dados['adicionais'].'</td></tr>

			</table>
			</div>
		<div id="slides">
			<div class="slides_container">';
			foreach( $fotos as $foto )
			{
				echo "<div><img src='http://jotajunior.net/imagens/".$foto."'></div>";
			}
			echo "</div><a class=\"prev\">anterior</a> | <a class=\"next\">próxima</a></div>";
		}
	}

	public static function mostrarFormularioCadastro( )
	{
		echo '<form action="cadDesap.php" method="POST">
		<table>
		<tr><td>Nome: </td><td><input type="text" name="nome" id="nome" /></td></tr>
		<tr><td>Data de Nascimento: </td><td><input type="text" name="data_nasc" id="data_nasc" /></td></tr>
		<tr><td>Cor: </td><td><select id="cor" name="cor"><option value="branco">Branco</option><option value="negro">Negro</option><option value="asiático">Asiático</option><option value="indígena">Indígena</option><option value="mulato">Mulato</option></select></td></tr>
		<tr><td>Olhos: </td><td><select id="cor_olhos" name="cor_olhos"><option value="castanho">Castanho</option><option value="azul">Azul</option><option value="preto">Preto</option><option value="verde">Verde</option><option value="castanho-claro">Castanho-claro</option></select></td></tr>
		<tr><td>Altura: </td><td><input type="text" id="altura" name="altura" /></td></tr>
		<tr><td>Tipo Físico: </td><td><select id="tipo_fisico" name="tipo_fisico"><option value="obeso">Obeso</option><option value="acima do peso">Acima do peso</option><option value="normal">Normal</option><option value="magro">Magro</option><option value="muito magro">Muito magro</option></select></td></tr>
		<tr><td>Cidade do desaparecimento: </td><td><input type="text" name="cidade_desap" id="cidade_desap" /></td></tr>
		<tr><td>Estado do desaparecimento: </td><td><input type="text" name="estado_desap" id="estado_desap" /></td></tr>
		<tr><td>Dados adicionais: </td><td><textarea id="adicionais" name="adicionais"></textarea></td></tr>
		<tr><td>Senha: </td><td><input type="password" name="senha" id="senha" /></td></tr>
		<tr><td>Repita a senha: </td><td><input type="password" name="senhaVerificador" id="senhaVerificador" /></td></tr>
		<tr><td><input type="submit" value="Cadastrar" /></td></tr>
		</table>
		</form>';
	}

	public static function mostrarFormularioFoto( )
	{
		//mostrar formulario para o desap com id $id
		echo '<form  method="POST" action="cadFoto.php" enctype="multipart/form-data">
		Você pode cadastrar no máximo três fotos: <br />
		<table>
		<tr><td><input type="file" name="foto[]" id="foto[]" /></td></tr>
		<tr><td><input type="file" name="foto[]" id="foto[]" /></td></tr>
		<tr><td><input type="file" name="foto[]" id="foto[]" /></td></tr>
		<tr><td><input type="submit" value="Cadastrar fotos!" /></td></tr></table></form>';
	}

	public static function escolherCapa( $fotos )
	{
		echo '<form action="cadCapa.php" method="POST">
		<table><tr>';

		$count = count( $fotos ) - 1;

		foreach( $fotos as $foto )
		{
			echo '<td><img src="'.$foto.'" /></td>';
		}

		echo '</tr><tr>';

		for( $i = 0; $i <= $count; $i++ )
		{
			echo '<td><input type="radio" name="capa" id="capa" value="'.$fotos[$i].'" /></td>';
		}

		echo '</tr><tr><td><input type="submit" value="Escolher Foto Principal" /></td></tr></table></form>';
	}

	public static function mostrarGerenciarFotos( $dados )
	{
		echo "<table>";

		foreach( $dados as $dado )
		{
			echo "<tr><td><img src='http://jotajunior.net/imagens/".$dado['foto']."'></td><td><a href='http://jotajunior.net/lyla/deletarFoto.php?id=".$dado['id']."'>Deletar</a></td></tr>";
		}

		echo "</table>";
	}

	public static function mostrarInfoOnline( )
	{
		if ( LoginController::online("desap") )
		{
			echo '
			<img src="images/horizontal-shadow_ultrasmall.png" />
			<center>
			Você está logado com o desaparecido <strong>'.Sessao::pegarDado("nome", "desap").'</strong><br />
			<a href="painelDesap.php">Alterar Dados</a><br />
			<a href="logout.php">Sair</a></center>';
		}
		else
		{
			echo '<center><img src="images/horizontal-shadow_ultrasmall.png" /><h1>Já está no sistema?</h1></center><br />Faça seu login aqui para editar informações.<br />
			<form id="form1" name="form1" method="post" action="submit">
			<b>Nome: </b> <input name="login" type="text" id="login" style="width: 98%;"><br />
			<b>Senha:</b> <input name="senha" type="text" id="senha" style="width: 98%;">
			<center><br /><a href="#" onClick="entrada()"><img src="images/login.png" /></a></center>
			</form>';
		}

	}
}
