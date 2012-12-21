<?php
include('autoload.php');

class TokenVO
{
	private $id, $id_voluntario, $token, $servico;

	public function __set( $var, $val )
	{
		switch( $var )
		{
			case 'id':
			case 'id_voluntario':
			case 'token':
			case 'nome':
				$this->$var = $val;
			break;
			case 'servico':
				switch( $val )
				{
					case 'orkut':
					case 'facebook':
					case 'twitter':		
						$this->$var = $val;
					break;
					default:
						throw new Exception("Só Orkut, Facebook e Twitter estão habilitados.");
					break;
				}
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
			case 'id_voluntario':
				return (int) $this->$var;
			break;
			case 'servico':
			case 'token':
			case 'nome':
				return $this->$var;
			break;
		}
	}
}

class TokenDAO extends DAO
{
	private $conn, $vo;

	public function __construct( TokenVO $vo )
	{
		$this->vo = $vo;
		$this->conn = new Connection();
	
		$args = array
			(
			"id_voluntario" => PDO::PARAM_INT,
			"servico"       => PDO::PARAM_STR,
			"token"         => PDO::PARAM_STR,
			"nome"          => PDO::PARAM_STR
			);
	
		parent::definirArgs( $args );
		parent::definirConexao( $this->conn );
		parent::definirTabela( "tokens" );
		parent::definirVO( $vo );
	}

	// verifica se um token já existe com determinado nome

	public function verificarExistencia( )
	{
		$sql = "SELECT COUNT(*) FROM tokens WHERE nome = :nome AND servico = :servico";

		$sth = $this->conn->prepare( $sql );
	
		$sth->bindParam(":nome"   , $this->vo->nome   , PDO::PARAM_STR);
		$sth->bindParam(":servico", $this->vo->servico, PDO::PARAM_STR);

		if($sth->execute())
		{
			return $sth->fetchColumn();
		}
		else
		{
			throw new Exception("Houve um erro durante a verificação de existência dos tokens.");
		}
		
	}

	public function tokenPertenceA( ) // verificar se o token ID pertence ao usuário ID_VOLUNTARIO
	{
		$sql = "SELECT COUNT(*) FROM tokens WHERE id = :id AND id_voluntario = :id_voluntario";

		$sth = $this->conn->prepare( $sql );

		$sth->bindParam(":id"           , $this->vo->id           , PDO::PARAM_INT);
		$sth->bindParam(":id_voluntario", $this->vo->id_voluntario, PDO::PARAM_INT);

		if( $sth->execute() )
		{
			return $sth->fetchColumn() > 0;
		}
		else
		{
			throw new Exception("Houve um erro ao verificar se o token pertence a determinado usuário.");
		}
	}

	// registra token

	public function registrar()
	{
			return parent::registrar( );
	}


	public function resgatarPorServico( )
	{
		$sql = "SELECT * FROM tokens WHERE servico = :servico";
		$sth = $this->conn->prepare( $sql );
		$sth->bindParam(":servico", $this->vo->servico, PDO::PARAM_STR);
	
		if( $sth->execute() )
		{
			return $sth->fetchAll(PDO::FETCH_ASSOC);
		}
		else
		{
			throw new Exception("Erro ao resgatar token.");
		}
	}

	public function resgatarPorVoluntario( )
	{
		$sql = "SELECT token, servico FROM tokens WHERE id_voluntario = :id";

		$sth = $this->conn->prepare( $sql );

		$sth->bindParam(":id", $this->vo->id_voluntario, PDO::PARAM_INT);
		
		if( $sth->execute() )
		{
			return $sth->fetchAll(PDO::FETCH_ASSOC);
		}
		else
		{
			throw new Exception("Erro ao resgatar token.");
		}
	}


	public function deletarPorVoluntario( )
	{
		$sql = "DELETE FROM tokens WHERE id_voluntario = :id";

		$sth = $this->conn->prepare( $sql );

		$sth->bindParam(":id", $this->vo->id_voluntario, PDO::PARAM_INT);

		if( !$sth->execute() )
		{
			throw new Exception("Houve um erro durante a deleção do token.");
		}
	}

	public function verificarOcorrencia( )
	{
		$sql = "SELECT COUNT(*) FROM tokens";
		
		$sth = $this->conn->query( $sql );

		if ( !$sth )
		{
			throw new Exception("Houve um erro durante a verificação de ocorrência dos tokens.");
		}

		return $sth->fetchColumn();
	}

	public function verificarOcorrenciaPorServico( )
	{
		$sql = "SELECT COUNT(*) FROM tokens WHERE servico = :servico";

		$sth = $this->conn->prepare( $sql );

		$sth->bindParam(":servico", $this->vo->servico, PDO::PARAM_STR);

		if( !$sth->execute() )
		{
			throw new Exception("Houve um erro durante a verificação de ocorrência por serviço dos tokens.");
		}

		return $sth->fetchColumn();
	}

	public function iterarServico( $inicio, $fim )
	{
		$sql = "SELECT token FROM tokens WHERE servico = :servico LIMIT :ini, :fim";

		$sth = $this->conn->prepare( $sql );

		$sth->bindParam(":servico", $this->vo->servico, PDO::PARAM_STR);
		$sth->bindParam(":ini"    , $inicio           , PDO::PARAM_INT);
		$sth->bindParam(":fim"    , $fim              , PDO::PARAM_INT);
	
		if( !$sth->execute() )
		{
			throw new Exception("Houve um erro durante o resgate parcelado dos tokens por serviço.");
		}

		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}

}
	
class TokenModel
{
	private $dao, $parte;

	public function __construct( TokenVO $vo )
	{
		$this->dao = new TokenDAO( $vo );
		$this->vo = $vo;
	}


	public function iterar( $ini, $fim ) 
	{
		$ini = (int) $ini;
		$fim = (int) $fim;

		return $this->dao->iterar( $ini, $fim );
	}
	
	// VERIFICAR SE É ULTIMA ITERAÇÃO , FAZER ITERAÇÃO PARA ENVIAR TOKENS

	public function registrar( )
	{
		//$this->dao->verificarExistencia();	
		return $this->dao->registrar();
	}

	public function resgatar( ) //RESGATA POR ID
	{
		return $this->dao->resgatar();
	}

	public function resgatarPorServico( )
	{
		return $this->dao->resgatarPorServico();
	}

	public function resgatarPorVoluntario( )
	{
		return $this->dao->resgatarPorVoluntario();
	}

	public function deletar( )
	{
		return $this->dao->deletar();
	}

	public function deletarPorVoluntario()
	{
		return $this->dao->deletarPorVoluntario();
	}
	
	public function verificarOcorrencia()
	{
		return $this->dao->verificarOcorrencia();
	}

	public function retornarTodos()
	{
		return $this->dao->retornarTodos();
	}
}
