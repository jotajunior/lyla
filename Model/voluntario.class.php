<?php
include('autoload.php');

class VoluntarioVO // lida com sanitização até certo ponto dos campos
{
	private $id, $nome, $email, $login, $senha;

	public function __set( $var, $val )
	{
		switch( $var )
		{
			case 'nome':
			case 'id':
			case 'email':
			case 'login':
			case 'senha':
				$this->$var = $val;
			break;
			default:
				throw new Exception("Você não pode criar variáveis.");
			break;
		}
	}

	public function __get( $var )
	{
		switch( $var )
		{
			case 'id':
				return (int) $this->$var;
			break;
			case 'login':
				return strtolower( $this->$var );
			break;
			case 'senha':
				return md5($this->$var."TH1S_1S_M4_FUCK!NG_S4KT,+B14TC6");
			break;
			case 'email':
			case 'nome':
				return $this->$var;
			break;
		}
	}
}

class VoluntarioDAO extends DAO // só lida com banco de dados
{
	public function __construct( VoluntarioVO $vo )
	{
		$this->conn = new Connection();

		$args = array
		(
		"nome"  => PDO::PARAM_STR,
		"senha" => PDO::PARAM_STR,
		"login" => PDO::PARAM_STR,
		"email" => PDO::PARAM_STR
		);

		$this->vo = $vo;

		parent::definirVO( $vo );
		parent::definirTabela( "voluntarios" );
		parent::definirConexao( $this->conn );
		parent::definirArgs( $args );		
	}

	public function registrar( )
	{
		return parent::registrar( );
	}

	public function alterar( )
	{
		return parent::alterar( );
	}
	
	public function resgatar( )
	{
		return parent::resgatar();
	}

	public function deletar( )
	{
		return parent::deletar();
	}

	
	public function verificarOcorrencia( )
	{
		$sql = "SELECT COUNT(*) FROM voluntarios WHERE login=:login OR email=:email";

		$sth = $this->conn->prepare( $sql );

		$sth->bindParam(":login", $this->vo->login, PDO::PARAM_STR);
		$sth->bindParam(":email", $this->vo->email, PDO::PARAM_STR);
		
		if( !$sth->execute() )
		{
			throw new Exception("Erro ao consultar o banco durante o login.");
		}
		else
		{
			return $sth->fetchColumn();
		}
	}
}

class VoluntarioModel
{
	private $dao, $vo;

	public function __construct( VoluntarioVO $vo )
	{
		$this->vo  = $vo;
		$this->dao = new VoluntarioDAO( $vo );
	}


	private function validarCampos( ) // verificação padrão de e-mail e login
	{
		if( filter_var( $this->vo->email, FILTER_VALIDATE_EMAIL ) == false )
		{
			throw new Exception("Digite um e-mail válido.");
		}

		// vendo se não tem caracteres não permitidos no login
		preg_match("/[^a-zA-Z0-9]/", $this->vo->login, $c);

		if ( $c != array() )
		{
			throw new Exception("Seu login deve conter apenas nomes e números.");
		}
	}

	public function registrar( ) // model = verificação mais inclusão
	{
		$this->validarCampos();

		if( $this->dao->verificarOcorrencia() == 0 )
		{
			$this->dao->registrar();
		}
		else
		{
			throw new Exception("Já existe alguém com esse login e/ou e-mail.");
		}	
		
	}

	public function alterar( )
	{
		$this->validarCampos();

		if( $this->dao->verificarOcorrencia() == 0 )
		{
			$this->dao->alterar();
		}
		else
		{
			throw new Exception("Já existe alguém com esse login e/ou e-mail.");
		}
	}


	public function resgatar( )
	{
		$this->dao->resgatar();
	}
			
}
