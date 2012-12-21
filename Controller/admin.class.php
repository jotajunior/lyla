<?php
include('autoload.php');

class AdminController
{
	public static function listarPendentes( )
	{
		LoginController::areaRestrita('admin');
		$vo            = new AdminVO();
		$fvo           = new FotoVO();

		$model         = new AdminModel( $vo );


		$pendente      = $model->resgatarPendentes();
		$pendente      = $pendente[rand(0, count( $pendente ) - 1 )];

		$fvo->id_desap = $pendente['id'];

		$fmodel        = new FotoModel( $fvo );

		$fotos         = $fmodel->resgatarPorDesap('foto', 2);

		AdminView::listarPendente( $pendente, $fotos );
	}

	public static function ativarDesap( )
	{
		LoginController::areaRestrita('admin');
		$vo    = new AdminVO();
		$model = new AdminModel( $vo );
		$id    = (int) $_GET['id'];

		if( $model->ativar( $id ) )
		{
			$view = new LoginView();
			$view->carregar( 'admin' );
			$view->redirecionar();
		}
	}

	public static function deletarDesap( )
	{
//		LoginController::areaRestrita('admin');

		$vo            = new DesapVO();
		$vo2           = new FotoVO();

		$id_desap      = $_GET['id'];

		$vo->id        = $id_desap;
		$vo2->id_desap = $id_desap;

		$model         = new DesapModel( $vo );
		$model2        = new FotoModel( $vo2 );

		$fotos         = $model2->resgatarPorDesap( 'foto', 2 );

		foreach( $fotos as $foto )
		{
			if( $model->deletar() )
			{
				if( unlink( "/var/www/lyla2/imagens/".$foto ) )
				{					
					$view = new LoginView();
					$view->carregar('admin');
					$view->redirecionar();
				}
			}
			else
			{
				throw new Exception("Erro ao deletar a foto do banco de dados.");
			}
		}

	}
}
