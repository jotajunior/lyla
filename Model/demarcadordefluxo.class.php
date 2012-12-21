<?php
include('autoload.php');

class DemarcadorDeFluxo
{
	private $conn, $marcacao;

	private function gravarDemarcacao( )
	{
		$sql = "INSERT INTO demarcador(id, marcacao, hora, label) VALUES (NULL, :marcacao, NOW(), :label)";

		$sth = $this->conn->prepare( $sql );

		$sth->bindParam(":marcacao", $this->marcacao, PDO::PARAM_STR);
		$sth->bindParam(":label"   , $this->label   , PDO::PARAM_STR);

		if( !$sth->execute() )
		{
			throw new Exception("Erro ao gravar demarcador.");
		}
	}

	public function __construct( $marcacao, $label )
	{
		$this->marcacao = (int) $marcacao;
		$this->label    = $label;
		$this->conn     = new Connection();
		$this->gravarDemarcacao( $marcacao );
	}

	public static function resgatarDemarcacao( $label )
	{
		$conn = new Connection();		
		$sql = "SELECT marcacao FROM demarcador WHERE label = :label ORDER BY hora DESC LIMIT 1";
		$sth = $conn->prepare( $sql );
		$sth->bindParam(":label", $label, PDO::PARAM_STR);

		$exec = $sth->execute();

		if ( !$exec )
		{
			throw new Exception("Erro ao resgatar demarcador.");
		}

		$ret = $sth->fetch(PDO::FETCH_ASSOC);
		return $ret['marcacao'];
	}
}
