<?php
include('autoload.php');


class LoginVO
{
	private $login, $senha;
	
	public function __set( $var, $val )
	{
		switch( $var )
		{
			case "login":
			case "senha":
			case "campoSenha":
			case "campoLogin":
			case "tabela":
				$this->$var = $val;
			break;
			default:
				throw new Exception("Essa variável não existe.");
			break;
		}
	}

	public function __get( $var )
	{
		switch( $var )
		{
			case "login":
				return strtolower( $this->$var );
			break;
			case "senha":
				return md5($this->$var."TH1S_1S_M4_FUCK!NG_S4KT,+B14TC6");
			break;
			case "campoSenha":
			case "campoLogin":
			case "tabela":
				return $this->$var;
			break;
			default:
				throw new Exception("Essa variável não existe.");
			break;
		}
	}
}

class LoginDAO // EXTENDS DAO ? VERIFICAR DEPOIS.
{
	private $conn, $vo, $campoLogin, $campoSenha;
	public $tabela;
	
	public function __construct( LoginVO $vo )
	{
		$this->conn = new Connection();
		$this->vo = $vo;
		$this->tabela = $this->vo->tabela;
	}

	public function verificarOcorrencia( )
	{
		$sql = "SELECT COUNT(*) FROM ".$this->vo->tabela." WHERE ".$this->vo->campoLogin." = :login AND ".$this->vo->campoSenha." = :senha";

		$sth = $this->conn->prepare( $sql );
		$sth->bindParam(":login", $this->vo->login, PDO::PARAM_STR);
		$sth->bindParam(":senha", $this->vo->senha, PDO::PARAM_STR);
		
		if( !$sth->execute() )
		{
			throw new Exception("Erro ao consultar o banco durante o login.");
		}

		return $sth->fetchColumn();
	}

	public function retornarDadosPorLogin( )
	{
		$sql = "SELECT * FROM ".$this->vo->tabela." WHERE ".$this->vo->campoLogin." = :login";
		$sth = $this->conn->prepare( $sql );
		$sth->bindParam(":login", $this->vo->login, PDO::PARAM_STR);
		if ( !$sth->execute() )
		{
			throw new Exception("Houve um erro durante o resgate de dados do voluntário no login.");
		}
		return $sth->fetch(PDO::FETCH_ASSOC);
	}
}
		
		
class LoginModel
{
	public $dao;

	public function __construct( LoginVO $vo )
	{
		$this->dao = new LoginDAO( $vo );
	}


	public function gerarCompostoAntiRoubo()
	{
		return md5( $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'] . 'A_L1TTL3!B1T-M0R33~0F~S4LT');
	}
		
	public function entrar( )
	{
		if( $this->estaOnline() )
		{
			throw new Exception("Você já está logado.");
		}

		if ( $this->dao->verificarOcorrencia() == 1 )
		{
			session_regenerate_id();

			$_SESSION['dados_'.$this->dao->tabela] = serialize( $this->dao->retornarDadosPorLogin() );
			$_SESSION['ANTITHEFT']                 = $this->gerarCompostoAntiRoubo();
			$_SESSION['session_started']           = true;
			return true;
		}
		else
		{
			return false;
		}
	}


	public function estaOnline( )
	{
		return (isset( $_SESSION['dados_'.$this->dao->tabela] )) && ($_SESSION['dados_'.$this->dao->tabela] != array()) && (isset( $_SESSION['session_started']) );
	}
		

}

