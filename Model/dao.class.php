<?php
include('autoload.php');

class DAO
{
	private $conn, $vo, $tabela, $args;

	//private function __construct(){}

	public function definirConexao( Connection $conn )
	{
		$this->conn = $conn;
	}

	public function definirVO( $vo )
	{
		$this->vo = $vo;
	}

	public function definirTabela( $tabela )
	{
		$this->tabela = $tabela;
	}

	public function definirArgs( $args )
	{
		$this->args = $args;
	}

	public function verificarArray( $array )
	{
		if( !is_array( $array ) )
		{
			throw new Exception("Esse parâmetro deveria ter um parâmetro como array.");
		}
	}


	public function retornarTodos( $add = "" )
	{
		$sql = "SELECT id FROM ".$this->tabela." ".$add." ORDER BY id ASC";

		$sth = $this->conn->query( $sql );

		$fetch = $sth->fetchAll(PDO::FETCH_ASSOC);
	
		$ret = array();

		foreach( $fetch as $item )
		{
			$ret[] = $item['id'];
		}

		return $ret;
	}

	public function iterar( $ini, $fim )
	{
		$sql = "SELECT * FROM ".$this->tabela." LIMIT :ini, :fim";

		$sth = $this->conn->prepare( $sql );
		$sth->bindParam(":ini", $ini, PDO::PARAM_INT);
		$sth->bindParam(":fim", $fim, PDO::PARAM_INT);

		if( !$sth->execute() )
		{
			throw new Exception("Houve um erro durante a iteração do serviço.");
		}

		$dados = $sth->fetchAll(PDO::FETCH_ASSOC);

		$ret = array();

		foreach( $dados as $item => $val )
		{
			$ret[] = $val['id'];
		}

		return $ret;		
	}

	public function registrar( )
	{

		$this->verificarArray( $this->args );

		$args2 = array();

		foreach( $this->args as $var => $val )
		{
			$args2[":".$var] = $val;
		}

		$sql = "INSERT INTO `".$this->tabela."` (".implode(array_keys($this->args), ", ").") VALUES (".implode(array_keys($args2), ", ").")";

		$sth = $this->conn->prepare( $sql );
		
		foreach( $this->args as $var => $val )
		{
			$sth->bindParam(":".$var, $this->vo->$var, $val);
		}

		$exec = $sth->execute();

		if( !$exec )
		{
			$k = $sth->errorInfo();
			$k = $k[2];
			throw new Exception( $k );
		}

		return $exec;
	}

	/*public function verificarOcorrencia( )
	{
		$sql = "SELECT COUNT(*) FROM ".$this->tabela." WHERE id = :id";

		$sth = $this->conn->prepare( $sql );

		$sth->bindParam(":id", $this->vo->id, PDO::PARAM_INT);

		if( $sth->execute() )
		{
			return $sth->fetchColumn();
		}
		else
		{
			throw new Exception("Erro ao verificar ocorrência do id {$this->vo->id}");
		}
	}*/

	public function resgatar( )
	{
		$sql = "SELECT * FROM ".$this->tabela." WHERE id = :id";

		$sth = $this->conn->prepare( $sql );

		$sth->bindParam( ":id", $this->vo->id, PDO::PARAM_INT);

		if ( !$sth->execute() )
		{
			echo "Houve um erro durante o resgate de dados.";
		}

		return $sth->fetch(PDO::FETCH_ASSOC);
	}

	public function deletar( )
	{
		$sql = "DELETE FROM ".$this->tabela." WHERE id = :id";

		$sth = $this->conn->prepare( $sql );

		$sth->bindParam(":id", $this->vo->id, PDO::PARAM_INT);

		$exec = $sth->execute();

		if( !$exec )
		{
			throw new Exception("Houve um erro durante a deleção do item.");
		}

		return $exec;
	}

	public function alterar( )
	{
		$this->verificarArray( $this->args );

		$args2 = array();

		foreach( $this->args as $var => $val	)
		{
			$args2[":".$var] = $val;
		}

		$sql = "UPDATE `".$this->tabela."` SET ";

		$keys = array_keys( $this->args );
		$box = array();

		//$blacklist = array('ativo'); //some hacking here
			

		foreach( $keys as $key ) 
		{
		//	if( !in_array($key, $blacklist) )
		//	{
				$box[] = "`".$key."` = :".$key;
		//	}
		}

		$sql .= implode($box, ", ");

		$sql .= " WHERE id = :id";

		$sth = $this->conn->prepare( $sql );

		foreach( $this->args as $var => $val )
		{
			$sth->bindParam(":".$var, $this->vo->$var, $val);
		}
	
		$sth->bindParam(":id", $this->vo->id, PDO::PARAM_INT);
		
		$exec = $sth->execute();

		if( !$exec )
		{
			throw new Exception("Houve um erro durante a alteração dos dados.");
		}
		
		return $exec;
		
	} 
}/*
$d = new DAO();
$conn = new Connection();
$vo = new DesapVO();
$vo->nome = "testew5";
$vo->data_nasc = "2011-01-01";
$vo->cor="branco";
$vo->cor_olhos="azul";
$vo->altura="1.99";
$vo->tipo_fisico="magro";
$vo->cidade_desap="barra mansa";
$vo->estado_desap="rj";
$vo->contato="999999999";
$vo->senha="12345";
$vo->adicionais="nonono";

		$args = array
			(
			"nome"         => PDO::PARAM_STR,
			"data_nasc"    => PDO::PARAM_STR,
			"cor"          => PDO::PARAM_STR,
			"cor_olhos"    => PDO::PARAM_STR,
			"altura"       => PDO::PARAM_STR,
			"tipo_fisico"  => PDO::PARAM_STR,
			"cidade_desap" => PDO::PARAM_STR,
			"estado_desap" => PDO::PARAM_STR,
			"contato"      => PDO::PARAM_STR,
			"senha"	       => PDO::PARAM_STR,
			"adicionais"   => PDO::PARAM_STR
			);

		$d->definirConexao( $conn );
		$d->definirVO( $vo );
		$d->definirTabela( "desap" );
		$d->definirArgs( $args );
echo $d->registrar();
_________________________________________
|     desap    |      desaparecidos     |
+--------------+------------------------+
| nome         | nome                   |
| data_nasc    | data_nascimento        |
| cor          | pele_ds                |
| cor_olhos    | olhos_ds               |
| altura       | alt_ds                 |
| tipo_fisico  | estat_fis_ds           |
| cidade_desap | ult_cidade             |
| estado_desap | ult_estado             |
| contato      | cadastrante.telefone   |
| foto         | fotos_ds.path          |
| senha        | 'qualquercoisa'        |
| adicionais   | motivo                 |
| ativo        | 1                      |
+--------------+------------------------+




*/
