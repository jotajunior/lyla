<?php
/*
A arte de gerenciar pessoas é um dos grandes desafios dos administradores, e não é por qualquer motivo. Para coordenar com eficiência um grupo de pessoas, um atributo muito notável é necessário: a liderança. O líder define rumos, motiva sua equipe e, acima de tudo, acredita em sua missão.
Liderança é bem mais que um conceito, é uma atitude que a pessoa toma para a própria vida. Um indivíduo não precisa ser líder apenas no trabalho, mas pode também ser líder entre seus amígos, família, enfim, em tudo que envolve um grupo de pessoas se relacionando.
Existe também o conceito de chefe, que é aquele que hierarquicamente se sobrepõe a um outro grupo de pessoas, mas é completamente diferente de um líder. O chefe coordena e busca somente resultados, o líder motiva os subordinados e os faz quererem os resultados tanto quanto ele; o chefe é separado do grupo e vê tudo de fora, o líder é parte integrante do grupo e os representa; o chefe se respalda na hierarquia para justificar seus atos, o líder é o exemplo. Esses dois conceitos nunca devem se misturar.
A dificuldade de liderar também não é pequena. É necessário abdicar de parte de sua liberdade para servir de modelo, de parte dua sua vontade para satisfazer o coletivo.  É necessário não deixar a hierarquia falar mais alto, e sim colocar o bom-senso no patamar mais alto da capacidade de julgamento.
Enfim, liderar pessoas é mais do que simplesmente distribuir ordens, é uma filosofia que a pessoa adota em relação a subordinados, e dessa forma a capacidade de liderança se faz um dos adjetivos mais destacáveis de um indivíduo.
*/
set_include_path('/home/jotaj896/public_html');
include('autoload.php');

class DesapVO
{

	public function __set( $var, $val )
	{
		switch( $var )
		{
			case 'nome':
			case 'cor':
			case 'id':
			case 'cor_olhos':
			case 'altura':
			case 'tipo_fisico':
			case 'cidade_desap':
			case 'estado_desap':
			case 'contato':
			case 'data_nasc':
			case 'adicionais':
			case 'ativo':
				$this->$var = $val;
			break;
			case 'senha':
				$this->senha = md5($val."TH1S_1S_M4_FUCK!NG_S4KT,+B14TC6");
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
			case 'ativo':
				return (int) $this->$var;
			break;
			case 'altura':
				return (float) $this->$var;
			break;
			case 'nome':
			case 'cor':
			case 'cor_olhos':
			case 'tipo_fisico':
			case 'cidade_desap':
			case 'estado_desap':
			case 'data_nasc':
			case 'adicionais':
			case 'senha':
			case 'contato':
				return $this->$var;
			break;

			default:
				throw new Exception("Essa variável não existe.");
			break;
		}
	}
}	

class DesapDAO extends DAO
{
	private $conn, $vo; 

	public function __construct( DesapVO $vo )
	{
		$this->conn = new Connection();
		$this->vo   = $vo;

		$args       = array
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
				"adicionais"   => PDO::PARAM_STR,
				"ativo"        => PDO::PARAM_INT
				);

		parent::definirConexao( $this->conn );
		parent::definirVO( $vo );
		parent::definirTabela( "desap" );
		parent::definirArgs( $args );
	}

	public function resgatarDesap( $a = 0 )
	{
		/*
			0 PÚBLICO
			1 USUÁRIO
			2 ADMIN
		*/

		$ret = parent::resgatar();
		
		if( ( $ret['ativo'] == 1 && $a == 0 ) || ( $a == 1 ) || ( $ret['ativo'] == 0 && $a == 2 ) )
		//   /\ só aprovadas para o público
		//                                         /\ todas para os usuários
		//                                                                      /\ somente não aprovadas para o admin
		{
			return $ret;
		}
		else
		{
			return false;
		}	
	}
}

class DesapModel
{
	private $dao;

	public function resgatarParaRedesSociais( $rede ) // resgatar verificando se existe foto para o usuário
	{	
		$ret = $this->resgatar();

		switch( $rede )
		{
			case 'orkut':
			case 'facebook':		
				if( $ret['foto'] != '' )
				{
					return $ret;
				}
			break;

			case 'twitter':
				return $ret;
			break;

			default:
				throw new Exception("Houve um erro durante o resgate dos dados para redes sociais.");
			break;
		}
	}

	public function __construct( DesapVO $vo )
	{
		$this->dao = new DesapDAO( $vo );
	}

	public function registrar( )
	{
		return $this->dao->registrar();
	}

	public function resgatarDesap( $a )
	{
		return $this->dao->resgatarDesap( $a );
	}

	public function alterar( )
	{
		return $this->dao->alterar();
	}

	public function deletar( )
	{
		return $this->dao->deletar();
	}

	public function iterar( $ini, $fim )
	{
		$ini = (int) $ini;
		$fim = (int) $fim;

		return $this->dao->iterar( $ini, $fim );
	}

	public function retornarTodos( $add )
	{
		return $this->dao->retornarTodos( $add );
	}
}
