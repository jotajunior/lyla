<?php
error_reporting(~E_NOTICE);
include('autoload.php');


// INICIAR SESSAO NO ARQUIVO QUE FOR ESPALHAR AS MSGS.  2KRITU1tWD2tGrsSQRgx7Q
//r8huOrXIIBUsL04h6rXNrSdIQQTUjLPvE77LCjXkcHM


class SocialService // conecta o id do token ao id do desaparecido
{
	private $tmodel, $dmodel;

	public function conectar( $id_token, $id_desap )
	{
		$tvo                 = new TokenVO();
		$dvo                 = new DesapVO();
		$fvo                 = new FotoVO();

		$tvo->id             = $id_token;
		$dvo->id             = $id_desap;
		$fvo->id_desap       = $id_desap;
	
		$this->tmodel        = new TokenModel( $tvo );
		$this->dmodel        = new DesapModel( $dvo );
		$fmodel              = new FotoModel( $fvo );

		$foto                = $fmodel->resgatarPorDesap('foto', 0);

		$dados_desap         = $this->dmodel->resgatarDesap(0);

		if( $dados_desap != false ) // usuário foi aprovado? se sim, continua...
		{
			$dados_desap['foto'] = $foto[0];

			$dados_token         = $this->tmodel->resgatar();

			$msg                 = $this->gerarTexto( $dados_desap, $dados_token['servico'] );

			switch( $dados_token['servico'] )
			{       /*
				case 'orkut':
					$token = $dados_token['token'];
					$this->espalharOrkut( $msg, $token );
				break;*/

				case 'twitter':
					$token = unserialize( $dados_token['token'] );
					$this->espalharTwitter( $msg, $token );
				break;

				case 'facebook':
					$token = unserialize( $dados_token['token'] );
					$this->espalharFacebook( $msg, $token );
				break;
			}
		}
	}

	private function gerarTexto( $fetch, $servico )
	{		
		$fetch['data_nasc'] = explode("-", $fetch['data_nasc']);
		$fetch['data_nasc'] = $fetch['data_nasc'][2]."/".$fetch['data_nasc'][1]."/".$fetch['data_nasc'][0]; //formatting date

		switch( $servico )
		{ /*
			case 'orkut':
				$ret = array();
				$ret[0]  = "Projeto Lyla - Dê qualquer informação sobre:";
				$ret[1]  = "Nome:<a href=\"http://lyla.jotajunior.com/desaparecido.php?id=".$fetch['id']."\">".$fetch['nome']."</a><br />";
				$ret[1] .= "Data de Nascimento: ".$fetch['data_nasc']." | Altura: ".$fetch['altura']." | Tipo físico: ".$fetch['tipo_fisico']." | Olhos: ".$fetch['cor_olhos']."<br />";
				$ret[1] .= "Cidade: ".$fetch['cidade_desap']."-".$fetch['estado_desap']." | Contato: ".$fetch['contato']."<br />";
				$ret[1] .= "Ajude famílias e propague a esperança! Junte-se ao <a href=\"lyla.jotajunior.com\">Projeto Lyla</a>.";
				$ret[2]  = $fetch['foto'];
			break;*/
			case 'facebook':
				$ret     = array();
				$ret[0]  = "Projeto Lyla - Dê qualquer informação sobre: \n";
				$ret[0] .=  "Nome: ".$fetch['nome']."\n";
				$ret[0] .= "Data de Nascimento: ".$fetch['data_nasc']." | Altura: ".$fetch['altura']." | Tipo físico: ".$fetch['tipo_fisico']." | Olhos: ".$fetch['cor_olhos']."\n";
				$ret[0] .= "Cidade: ".$fetch['cidade_desap']."-".$fetch['estado_desap']." | Contato: ".$fetch['contato']."\n";
				$ret[0] .= "Link do desaparecido: ".$this->encurtarUrl("http://lyla.jotajunior.com/desaparecido.php?id=".$fetch['id']);
				$ret[0] .= "\n\n Junte-se ao Projeto Lyla e propague a esperança!";
				$ret[1]  = $fetch['foto'];
				
			break;
			case 'twitter':
				$ret  = "#projetoLYLA | Desaparecido | ";
				$ret .= "Nome: ".$fetch['nome']." | Cidade: ".$fetch['cidade_desap']."-".$fetch['estado_desap']." | Link: ".$this->encurtarUrl("http://lyla.jotajunior.com/desaparecido.php?id=".$fetch['id']);
			break;
			default:
				throw new Exception("Houve um erro durante a geração da mensagem.");
			break;
		}
	return $ret;
	}

	private function encurtarUrl( $url )
	{
		return file_get_contents('http://migre.me/api.txt?url='.trim( urlencode( $url ) ) );
	}

	/*private function espalharOrkut( $mensagem, $token )
	{
		session_start();
		$_SESSION['oauth_token'] = $token;
		require_once("activitycreation.php");
		$orkutApi = new Orkut('www.jotajunior.com', 'rg1oynDE2pLMUT7TqJEuGnzl');
		$orkutApi->login();
		$activity = new Activity( $orkutApi );
		$activity->setTitle( $mensagem[0] );
		$activity->setBody( $mensagem[1] );
		$activity->create();
	}*/

	public function espalharFacebook( $mensagem, $token )
	{
		return file_get_contents("https://graph.facebook.com/me/feed?access_token=".$token."&message=".urlencode( $mensagem[0] )."&method=post&picture=".urlencode($mensagem[1]));
	}

	private function espalharTwitter( $mensagem, $token )
	{
		$tmhOAuth = new tmhOAuth(array(
		  'consumer_key'    => '',
		  'consumer_secret' => '',
		  'user_token'      => $token['oauth_token'], 
		  'user_secret'     => $token['oauth_token_secret'],
		));

		return $tmhOAuth->request('POST', $tmhOAuth->url('1/statuses/update'), array(
		  'status' => $mensagem
		));
	}
	
}
