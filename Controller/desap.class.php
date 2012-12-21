<?php
include('../autoload.php');

class DesapController
{
	public static function registrar( ) //cadDesap.php
	{
		//Sessao::iniciar(1);

		if( $_POST['senha'] != $_POST['senhaVerificador'] )
		{
			throw new Exception( "As senhas que digitou não batem." );
		}

		$vo = new DesapVO();

		$data = explode("/", $_POST['data_nasc'] );

		$vo->cor          = $_POST['cor'];
		$vo->cor_olhos    = $_POST['cor_olhos'];
		$vo->nome         = $_POST['nome'];
		$vo->data_nasc    = "{$data[2]}-{$data[1]}-{$data[0]}";
		$vo->altura       = $_POST['altura'];
		$vo->tipo_fisico  = $_POST['tipo_fisico'];
		$vo->adicionais   = $_POST['adicionais'];
		$vo->cidade_desap = $_POST['cidade_desap'];
		$vo->estado_desap = $_POST['estado_desap'];
		$vo->contato      = $_POST['contato'];
		$vo->senha        = $_POST['senha'];

		$model = new DesapModel( $vo );

		if( $model->registrar() )
		{
			$login = LoginController::entrar( $vo->nome , $_POST['senha'], "desap", 0 );
			LoginView::redirecionarPara("selecionarFotos.php");
		}
		
	}

	public static function mostrarDesap( ) //desaparecido.php
	{
		$id 	       = (int) $_GET['id'];
		
		$vo            = new DesapVO();
		$vo2           = new FotoVO();
		$vo2->id_desap = $id;
		$vo->id        = $id;

		$model = new DesapModel( $vo );
		$foto  = new FotoModel( $vo2 );

		DesapView::mostrarDesap( $model->resgatarDesap(0), $foto->resgatarPorDesap('foto', 0) );
	}

	public static function alterar( )
	{
		LoginController::areaRestrita('desap');

		if( $_POST['senha'] == "" )
		{
			throw new Exception( "Você não pode deixar a senha em branco!" );
		}

		if( $_POST['senha'] != $_POST['senhaVerificador'] )
		{
			throw new Exception( "As senhas que digitou não batem." );
		}

		$vo = new DesapVO();

		$data = explode("/", $_POST['data_nasc'] );

		$vo->id           = Sessao::pegarDado("id", "desap");
		$vo->cor          = $_POST['cor'];
		$vo->cor_olhos    = $_POST['cor_olhos'];
		$vo->nome         = $_POST['nome'];
		$vo->data_nasc    = "{$data[2]}-{$data[1]}-{$data[0]}";
		$vo->altura       = $_POST['altura'];
		$vo->tipo_fisico  = $_POST['tipo_fisico'];
		$vo->adicionais   = $_POST['adicionais'];
		$vo->cidade_desap = $_POST['cidade_desap'];
		$vo->estado_desap = $_POST['estado_desap'];
		$vo->contato      = $_POST['contato'];
		$vo->senha        = $_POST['senha'];

		$model = new DesapModel( $vo );

		if( $model->alterar() )
		{
			echo "Dados alterados com sucesso!";
			$view = new LoginView();
			$view->carregar( 'desap' );
			$view->redirecionar();
		}
	}

	public static function selecionarFotos( $arg = "" ) //para o cadFoto.php
	{
		LoginController::areaRestrita('desap');

		$vo           = new FotoVO();
		$vo->id_desap = Sessao::pegarDado("id", "desap");

		$verificador  = new FotoModel( $vo );

		if ( $verificador->verificarOcorrenciaPorDesap() < 3 )
		{
			$upload = new Upload();

			$upload->setTamanhoMaximo( 2048000 );
			$upload->setAlturaMaxima( 500 );
			$upload->setLarguraMaxima( 500 );

			$fotos   = $_FILES['foto'];
			$fotosb  = array();
			$values  = array_values( $fotos );
			$counter = count( $values[0] ) - 1;

			for( $i = 0; $i <= $counter; $i++ )
			{
				$fotosb[$i]["name"]     = $fotos["name"][$i];
				$fotosb[$i]["type"]     = $fotos["type"][$i];
				$fotosb[$i]["tmp_name"] = $fotos["tmp_name"][$i];
				$fotosb[$i]["error"]    = $fotos["error"][$i];
				$fotosb[$i]["size"]     = $fotos["size"][$i];
			}

			foreach( $fotosb as $foto )
			{
				if( $foto["name"] != "" ) // THIS WAS FREAKING ME OUT OMG, but pardon me, it's 4 am
				{
					$vo2           = new FotoVO();
					$vo2->id_desap = Sessao::pegarDado("id", "desap");
					$vo2->foto     = $upload->subirFoto( $foto );

					$model         = new FotoModel( $vo2 );

					$model->registrar();
				}
			}

			if( $arg == 1 )
			{
				LoginView::redirecionarPara("foto.php");
			}
			else
			{
				$view = new LoginView();
				$view->carregar( "desap" );
				$view->redirecionar();
			}
		}
		else
		{
			throw new Exception("Você atingiu a cota máxima de fotos. Delete alguma e tente novamente.");
		}
	}

	public static function mostrarSelecionarCapa() //para o selecionarCapa.php
	{
		LoginController::areaRestrita("desap");
		$vo           = new FotoVO();
		$vo->id_desap = Sessao::pegarDado("id", "desap");

		$model        = new FotoModel( $vo );
		$fotos        = $model->resgatarPorDesap();

		DesapView::escolherCapa( $fotos );
	}

	public static function selecionarCapa() //para o cadCapa.php
	{
		LoginController::areaRestrita('desap');
		$vo           = new FotoVO();
		$vo->foto     = $_POST['capa'];
		$vo->id_desap = Sessao::pegarDado("id", "desap");

		$model        = new FotoModel( $vo );

		$model->definirCapaPorFoto();
		$view = new LoginView();
		$view->carregar( "desap" );
		$view->redirecionar();
	}

	public static function deletarFotoSuporte( $id )
	{
		$vo           = new FotoVO();
		$vo->id       = $id;
		$vo->id_desap = Sessao::pegarDado("id", "desap");
		
		$model        = new FotoModel( $vo );
		$foto         = $model->resgatar();
		$foto         = $foto['foto'];

		if( $model->deletar() )
		{
			if( unlink( "/var/www/lyla2/imagens/".$foto ) )
			{
				LoginView::redirecionarPara("foto.php");
			}
		}
		else
		{
			throw new Exception("Erro ao deletar a foto do banco de dados.");
		}
	}

	public static function deletarFoto( )
	{
		$id = (int) $_GET['id'];

		self::deletarFotoSuporte( $id );
	}

	public static function deletar( ) //DELETAR USUÁRIO POR COMPLETO
	{
		LoginController::areaRestrita('desap');

		$vo            = new DesapVO();
		$vo2           = new FotoVO();

		$id_desap      = Sessao::pegarDado("id", "desap");

		$vo->id        = $id_desap;
		$vo2->id_desap = $id_desap;

		$model         = new DesapModel( $vo );
		$model2        = new FotoModel( $vo2 );

		$fotos         = $model2->resgatarPorDesap( 'id', 1 );

		LoginController::sair();

		foreach( $fotos as $foto )
		{
			$vo1           = new FotoVO();
			$vo1->id       = $foto;
			$vo1->id_desap = $id_desap;
		
			$model1        = new FotoModel( $vo1 );
			$foto1         = $model1->resgatar();
			$foto1         = $foto1['foto'];

			if( $model1->deletar() )
			{
				unlink( "/var/www/lyla2/imagens/".$foto1 );
			}
			else
			{
				throw new Exception("Erro ao deletar a foto do banco de dados.");
			}
		}
		

		if( $model->deletar() )
		{
			LoginView::redirecionarPara("index.php");
		}
	}

	public static function formularioDeAlteracoes( )
	{
		LoginController::areaRestrita('desap');

		$vo                = new DesapVO();
		$vo->id            = (int) Sessao::pegarDado('id', 'desap');

		$model             = new DesapModel( $vo );

		$data              = $model->resgatarDesap(1);

		$nasc              = explode( "-", $data['data_nasc'] );
		$nasc              = $nasc[2]."/".$nasc[1]."/".$nasc[0];
		$data['data_nasc'] = $nasc;

		DesapView::formularioDeAlteracoes( $data );
	}

	public static function mostrarGerenciadorFotos( )
	{
		LoginController::areaRestrita('desap');
		
		$vo           = new FotoVO();
		$vo->id_desap = (int) Sessao::pegarDado('id', 'desap');

		$model        = new FotoModel( $vo );
		
		DesapView::mostrarGerenciarFotos( $model->resgatarPorDesap( "*", 1 ) );
	}

	public static function localizado( )
	{
		LoginController::areaRestrita('desap');
		DesapView::localizado( Sessao::pegarDado('id', 'desap') );
	}	
}

