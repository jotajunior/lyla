<?php
include('autoload.php');

class Sessao // classe para lidar com sessões e métodos estáticos do LoginModel
{
	public static function pegarDado( $dado, $tabela )
	{
		switch( $dado )
		{
			case 'id':
			case 'nome':
			case 'login':
			case 'senha':
			case 'email':
				if( $tabela != 'admin' && $tabela != 'voluntarios' && $tabela != 'desap' )
				{
					throw new Exception("A tabela $tabela não existe.");
				}

				if ( ( isset( $_SESSION['dados_'.$tabela] ) ) && ($_SESSION['dados_'.$tabela] != array()) && (isset( $_SESSION['session_started']) ) )
				{
					$sessao = unserialize( $_SESSION['dados_'.$tabela] );
					return $sessao[$dado];
				}
				else
				{
					throw new Exception("Você não está logado.");
				}
			break;
			default:
				throw new Exception("Você não pode acessar dados que não existem.");
			break;
		}
	}

	public static function iniciar( $primeira_vez = 0 ) // MÉTODOS PARA EVITAR O ROUBO E FIXAÇÃO DE SESSÕES
	{		
		// USA O PRIMEIRA_VEZ CASO SEJA A INICIAÇÃO SE SESSÃO DA PÁGINA DE LOGIN
		ini_set('session.cookie_httponly', true);
		ini_set('session.use_only_cookie', true);
	
		/*if ( $primeira_vez == 1 )
		{
			session_start();

			$_SESSION = array(); 

			if ( isset( $_COOKIE[session_name()] ) ) 
			{ 
			    setcookie(session_name(), '', time()-42000, '/'); 
			} 
		
			session_destroy(); 
		}*/

		@session_start();

		/*if(strpos(strtolower($_SERVER['REQUEST_URI']), 'phpsessid') !== false)
		{
			session_destroy();
			session_regenerate_id();
			session_start();
		}*/ //se não permitir o ini_set();

		if( !isset($_SESSION['session_started']) )
		{
			@session_regenerate_id();
			$_SESSION['session_started'] = true;
		}

		if( isset($_SESSION['ANTITHEFT']) )
		{
			if( $_SESSION['ANTITHEFT'] != md5( $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'] . 'A_L1TTL3!B1T-M0R33~0F~S4LT') )
			{
				throw new Exception("Tentativa de fraude detectada.");
			}
		} else if ( $primeira_vez == 0 ) // só pode NAO TER ANTITHEFT se for a primeira vez
		{				//SE nao tiver antitheft e nao for a primeira vez... \/
			throw new Exception("Os seus dados de sessão não estão completos.");
		}
	}
}
