<?php
include('autoload.php');

class FotoVO
{
	public $id_desap, $id, $foto, $capa;

	public function __set( $var, $val )
	{
		switch( $var )
		{
			case "id_desap":
			case "id":
			case "foto":
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
			case "id_desap":
			case "id":
				return (int) $this->$var;
			break;
			case "foto":
				return $this->$foto;
			break;
			default:
				throw new Exception("Você não pode criar variáveis.");	
			break;
		}
	}
}

class FotoDAO extends DAO
{
	public $conn, $vo;

	public function __construct( FotoVO $vo , $conn = null) // pode definir conexão aqui, pois é uma classe simplesmente de auxílio
	{
		$this->vo = $vo;
		
		if( $conn === null )
		{		
			$conn = new Connection();
		}

		$this->conn = $conn;

		$args = array
			(
			"id_desap" => PDO::PARAM_INT,
			"foto"     => PDO::PARAM_STR
			);

		parent::definirArgs( $args );
		parent::definirConexao( $conn );
		parent::definirTabela( "fotos" );
		parent::definirVO( $vo );

	}


	//public function deletar( )
	//{
	//	return parent::deletar();
	//}

	public function zerarCapas( )
	{
		$sql = "UPDATE TABLE fotos SET capa = 0 WHERE capa = 1 AND id_desap = :id_desap";
		
		$sth = $this->conn->prepare( $sql );

		$sth->bindParam(":id_desap", $this->vo->id_desap, PDO::PARAM_INT);

		$exec = $sth->execute();

		if( !$exec )
		{
			throw new Exception("Houve um erro durante a desmarcação de capas.");
		}

		return $exec;
	}

	public function definirCapa( )
	{
		$sql = "UPDATE TABLE fotos SET capa = 1 WHERE capa = 0 AND id = :id";

		$sth = $this->conn->prepare( $sql );
		
		$sth->bindParam(":id", $this->vo->id, PDO::PARAM_INT);

		$exec = $sth->execute();

		if( !$exec )
		{
			throw new Exception( "Houve um erro ao definir a foto $this->vo->id como capa." );
		}

		return $exec;
	}

	public function definirCapaPorFoto( )
	{
		$sql = "UPDATE TABLE fotos SET capa = 1 WHERE capa = 0 AND foto = :foto AND id_desap = :id_desap";

		$sth = $this->conn->prepare( $sql );

		$sth->bindParam(":foto"    , $this->vo->foto    , PDO::PARAM_STR);
		$sth->bindParam(":id_desap", $this->vo->id_desap, PDO::PARAM_INT);

		$exec = $sth->execute();

		if( !$exec )
		{
			throw new Exception( "Houve um erro ao definir a foto $this->vo->foto como capa." );
		}

		return $exec;
	}

	public function resgatarCapa( )
	{
		$sql = "SELECT foto FROM fotos WHERE capa = 1 AND id_desap = :id_desap";
	
		$sth = $this->conn->prepare( $sql );

		$sth->bindParam(":id_desap", $this->vo->id_desap, PDO::PARAM_INT);

		if( !$sth->execute() )
		{
			throw new Exception("Houve um erro durante o resgate da capa do usuário.");
		}

		return $sth->fetch(PDO::FETCH_ASSOC);
	}

	public function resgatarPorDesap( $item, $lugar )
	{
		$sql = "SELECT $item FROM fotos WHERE id_desap = :id_desap";

		$sth = $this->conn->prepare( $sql );

		$sth->bindParam(":id_desap", $this->vo->id_desap, PDO::PARAM_INT);

		if( !$sth->execute() )
		{
			throw new Exception( "Houve um erro durante o resgate das fotos do desaparecido." );
		}


		$fotos = $sth->fetchAll(PDO::FETCH_ASSOC);
	
		if( $item != "*" )
		{
			$ret = array();

			foreach( $fotos as $foto )
			{
				$ret[] = $foto[ $item ];
			}

			$res = $ret;
		}
		else
		{
			$res = $fotos;
		}

		$vo     = new DesapVO();
		$vo->id = $this->vo->id_desap;

		$model  = new DesapModel( $vo );

		if ( $model->resgatarDesap( $lugar ) != false )
		{
			return $res;
		}
		else
		{
			return false;
		}

	}

	public function verificarOcorrenciaPorDesap( )
	{
		$sql = "SELECT COUNT(*) FROM fotos WHERE id_desap = :id_desap";

		$sth = $this->conn->prepare( $sql );

		$sth->bindParam(":id_desap", $this->vo->id_desap, PDO::PARAM_INT);

		if( $sth->execute() )
		{
			return $sth->fetchColumn();
		}
		else
		{
			throw new Exception("Erro ao verificar ocorrência de fotos por id do desaparecido.");
		}
	}

	public function deletar( )
	{
		$sql = "DELETE FROM fotos WHERE id = :id AND id_desap = :id_desap";

		$sth = $this->conn->prepare( $sql );

		$sth->bindParam(":id"      , $this->vo->id      , PDO::PARAM_INT);
		$sth->bindParam(":id_desap", $this->vo->id_desap, PDO::PARAM_INT);

		$exec = $sth->execute();

		if ( !$exec )
		{
			throw new Exception("Houve um erro ao deletar a foto.");
		}
		else
		{
			return $exec;
		}
	}
}

class FotoModel
{
	private $dao, $vo;

	public function __construct( FotoVO $vo )
	{
		$this->dao = new FotoDAO( $vo );
	}
	
	public function resgatar( )
	{
		return $this->dao->resgatar();
	}

	public function verificarOcorrenciaPorDesap( )
	{
		return $this->dao->verificarOcorrenciaPorDesap();
	}

	public function registrar( )
	{
		return $this->dao->registrar();
	}

	public function deletar( )
	{
		return $this->dao->deletar();
	}

	public function definirCapa( ) //tem que id_desap e id estar setado
	{
		if ( $this->dao->zerarCapas() )
		{
			return $this->dao->definirCapa();
		}
	}

	public function resgatarCapa( )
	{
		return $this->dao->resgatarCapa();
	}

	public function definirCapaPorFoto()
	{
		return $this->dao->definirCapaPorFoto();
	}

	public function resgatarPorDesap( $item = 'foto', $lugar )
	{
		return $this->dao->resgatarPorDesap( $item, $lugar );
	}
}
