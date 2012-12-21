<?php
include('../autoload.php');

class VoluntarioController
{

	public static function registrar()
	{
		Sessao::iniciar(1);
		
		if( $_POST['senha'] != $_POST['senhaVerificador'] )
		{
			throw new Exception("As senhas não correspondem.");
		}

		$vo = new VoluntarioVO();

		$vo->nome  = $_POST['nome'];
		$vo->senha = $_POST['senha'];
		$vo->login = $_POST['login'];
		$vo->email = $_POST['email'];

		$model = new VoluntarioModel( $vo );

		if( $model->registrar() )
		{
			$view = new LoginView();
			$view->carregar('voluntario');
			$view->redirecionar();
		}
		else
		{
			throw new Exception("Houve um erro ao cadastrar voluntário.");
		}		
	}
	public static function alterar() // para alterarVoluntario.php
	{
		LoginController::areaRestrita("voluntarios");
		$vo        = new VoluntarioVO();
		
		if( $_POST['senha'] != $_POST['senhaVerificador'] )
		{
			throw new Exception("As senhas não batem.");
		}

		$vo->id    = Sessao::pegarDado("id", "voluntarios");
		$vo->nome  = $_POST['nome'];
		$vo->email = $_POST['email'];
		$vo->login = $_POST['login'];
		$vo->senha = $_POST['senha'];

		$model     = new VoluntarioModel( $vo );

		if( $model->alterar() )
		{
			$view = new LoginView();
			$view->carregar('voluntario');
			$view->redirecionar();
		}
		else
		{
			throw new Exception("Houve um erro ao alterar seus dados.");
		}
	}

	public static function deletarToken() //para deletarToken.php
	{
		LoginController::areaRestrita('voluntarios');
		$vo                = new TokenVO();
		$vo->id            = (int) $_GET['id'];
		$vo->id_voluntario = Sessao::pegarDado("id", "voluntarios");

		$model  = new TokenModel( $vo );
		
		if( $model->tokenPertenceA() )
		{
			if( $model->deletar() )
			{
				$view = new LoginView();
				$view->carregar("voluntario");
				$view->redirecionar();
			}
		}
		else
		{
			throw new Exception("Você não é o dono desse token.");
		}
	}

	public static function listarTokens()
	{
		LoginController::areaRestrita("voluntarios");
		$vo                = new TokenVO();
		$vo->id_voluntario = LoginController::pegarDado("id", "voluntarios");

		$model             = new TokenModel( $vo );
		$tokens            = $model->resgatarPorVoluntario();

		VoluntarioView::listarTokens( $tokens );
	}
}
