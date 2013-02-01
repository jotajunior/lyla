<?php
include('autoload.php');

class AdminVO
{
	private $login, $senha;

	public function __set( $var, $val )
	{
		switch( $var )
		{
			case 'login':
			case 'senha':
			case 'id':
				$this->$var = $val;
			break;
			default:
				throw new Exception("Não tente brincar com o admin.");
			break;
		}
	}

	public function __get( $var )
	{
		switch( $var )
		{
			case 'login':
				return $this->$var;
			break;
			case 'senha':
				return md5($this->$var."TH1S_1S_M4_FUCK!NG_S4KT,+B14TC6");
			break;
			case 'id':
				return (int) $this->$var;
			break;
			default:
				throw new Exception("Essa variável não existe.");
			break;
		}
	}
}

class AdminDAO extends DAO
{
	private $conn, $vo;

	public function __construct( AdminVO $vo )
	{
		$args = array
			(
			"id"    => PDO::PARAM_INT,
			"login" => PDO::PARAM_STR,
			"senha" => PDO::PARAM_STR
			);

		$this->vo = $vo;
		$this->conn = new Connection();

		parent::definirTabela( "admin" );
		parent::definirConexao( $this->conn );
		parent::definirVO( $this->vo );
		parent::definirArgs( $args );
	}

	public function resgatarPendentes( )
	{
		$sql = "SELECT * FROM desap WHERE ativo = 0";
		$sth = $this->conn->query( $sql );
		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}

	public function ativar( $id )
	{
		$sql = "UPDATE desap SET ativo = 1 WHERE ativo = 0 AND id = :id";

		$sth = $this->conn->prepare( $sql );
		$sth->bindParam(":id", $id, PDO::PARAM_INT);
		
		return $sth->execute();
	}

	public function verificarOcorrencia( )
	{
		$sql = "SELECT COUNT(*) FROM admin WHERE login = :login";

		$sth = $this->conn->prepare( $sql );
		$sth->bindParam(":login", $this->vo->login, PDO::PARAM_STR);

		if( $sth->execute() )
		{
			return $sth->fetchColumn();
		}
		else
		{
			throw new Exception("Houve um erro ao verificar ocorrência do número de logins de administradores.");
		}
	}

	public function registrar()
	{
		if( $this->verificarOcorrencia() == 0 )
		{
			parent::registrar();
		}
		else
		{
			throw new Exception("Um admin com esse login já existe.");
		}
	}
}

class AdminModel
{
	private $dao, $vo;

	public function __construct( AdminVO $vo )
	{
		$this->vo  = $vo;
		$this->dao =  new AdminDAO( $this->vo );
	}

	public function registrar( )
	{
		return $this->dao->registrar();
	}
	
	public function deletar()
	{
		return $this->dao->deletar();
	}

	public function resgatarPendentes()
	{
		return $this->dao->resgatarPendentes();
	}

	public function ativar( $id )
	{
		return $this->dao->ativar( $id );
	}

	public function alterar()
	{
		return $this->dao->alterar();
	}

}
/*
$vo = new AdminVO();
$vo->login = 'oss';
$vo->senha = 'ass';
$model = new AdminModel( $vo );
$model->registrar();*/
