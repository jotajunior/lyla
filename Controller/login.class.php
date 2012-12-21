<?php
include('../autoload.php');


class LoginController
{
	private $campo;

	public static function entrar( $nome, $senha, $tipo, $redirect = 1 )
	{
		$vo = new LoginVO();

		switch( $tipo )
		{
			case 'desap':
				$vo->tabela     = "desap";
				$vo->campoLogin = "nome";
			break;
			case 'admin':				
				$vo->tabela     = "admin";
				$vo->campoLogin = "login";
			break;
			case 'voluntario':
				$vo->tabela     = "voluntarios";
				$vo->campoLogin = "login";
			break;
			default:
				throw new Exception("Este tipo não existe.");
			break;
		}

		$vo->campoSenha = "senha";	
		$vo->login = $nome;
		$vo->senha = $senha;


		$model = new LoginModel( $vo );
		
		$entrou = $model->entrar();

		if( $entrou == 1 && $redirect == 1 )
		{
			$view = new LoginView();
			$view->carregar( $tipo );
			$view->redirecionar();
		}
		else if( $entrou == 0 )
		{
			throw new Exception("[1] Houve um erro durante o login.");
			
		}
	}

	public static function init( )
	{
		self::entrar( $_POST['login'], $_POST['senha'], $_POST['tipo'] );
	}

	public static function online( $quem )
	{
		return (isset( $_SESSION['dados_'.$quem] )) && ($_SESSION['dados_'.$quem] != array()) && (isset( $_SESSION['session_started']) );
	}

	public static function areaRestrita( $quem )
	{
		if( !self::online( $quem ) )
		{
			throw new Exception("Essa área é restrita.");
		}
	}

	public static function sair( )
	{
		$_SESSION = array();
		session_unset();
		session_destroy();
	}
}
