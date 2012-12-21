<?php
ini_set('include_path', '/var/www/newlyla');
include('autoload.php');


set_time_limit(0);

class Cerebro
{
	private function init( )
	{
		$dvo               = new DesapVO();
		$this->dm          = new DesapModel( $dvo );
		$this->todosdesap  = $this->dm->retornarTodos( "WHERE ativo = 1" ); // o filtro será feito no 
		$this->totaldesap  = count( $this->todosdesap );

		$tvo               = new TokenVO();
		$this->tm          = new TokenModel( $tvo );
		$this->todostokens = $this->tm->retornarTodos();
		$this->totaltoken  = count( $this->todostokens );

		$this->marcador_desap   = DemarcadorDeFluxo::resgatarDemarcacao( "desap" );
		$this->marcador_token   = DemarcadorDeFluxo::resgatarDemarcacao( "token" );
		$this->diff             = $this->totaldesap - $this->marcador_desap;

		$this->service          = new SocialService();
	}

	public function pensar( )
	{
		$this->init();


		if( $this->totaldesap > $this->totaltoken )
		{
			$this->maisDesap();
		}
		else if ( $this->totaldesap < $this->totaltoken )
		{
			$this->maisToken();
		}
		else
		{
			$this->igual();
		}

	}

	private function igualar( $array1, $array2 ) // função para igualar o número de itens em cada array
	{
		$c1 = count( $array1 ) - 1;
		$c2 = count( $array2 ) - 1;

		$ret1 = array();
		$ret2 = array();

		if( $c1 > $c2 )
		{
			for( $i = 0; $i <= $c2; $i++ )
			{
				$ret1[] = $array1[$i];
			}
			$ret2 = $array2;
		}
		else if ( $c1 < $c2 ) //caso seja menor... (excluindo possibilidade de igualdade)
		{
			for( $i = 0; $i <= $c1; $i++ )
			{
				$ret2[] = $array2[$i];
			}
			$ret1 = $array1;
		}
		else // caso seja igual...
		{
			$ret1 = $array1;
			$ret2 = $array2;
		}

		return array($ret1, $ret2);
	}

	private function maisDesap( ) //lógica pica, pqp
	{
		//echo $this->diff,"|",$this->marcador_desap,"|",$this->totaltoken;
		if( $this->diff < $this->totaltoken ) 
		{
			// nessa situação, pula de numero_token em numero_token
			// caso esteja no desaparecido 70/80 e existam 30 tokens e for usada a lógica normal, vão 'sobrar' 20 tokens, o que não pode
			// essa parte faz usar o resto dos tokens que sobram com outros desaparecidos
			
			$vars = $this->igualar( $this->dm->iterar($this->marcador_desap, $this->totaldesap), $this->tm->iterar(0 , $this->diff) );
			//                               /\ pegando resto de desaps                     /\ pegando parte dos tokens
			
			$desap = $vars[0];
			$token = $vars[1];


			$count = count( $desap ) - 1;

			for( $i = 0; $i <= $count; $i++ )
			{
				$this->service->conectar( $token[ $i ], $desap[ $i ] );
			}
				// /\ conectando os tokens aos desaps

			$resto = $this->totaltoken - $this->marcador_token;
			//  calculando quantos tokens sobraram

			$vars2 = $this->igualar( $this->tm->iterar($this->marcador_token, $this->totaltoken), $this->dm->iterar(0,$resto) );
			//                                   /\ pegando próximos tokens                 /\ reiniciando desaps
			$token2 = $vars2[0];
			$desap2 = $vars2[1];

			new DemarcadorDeFluxo( $resto, "token" ); //demarcando onde parou o token
			new DemarcadorDeFluxo( 0     , "desap" );

			$count2 = count( $desap2 ) - 1;

			for( $i = 0; $i <= $count2; $i++ )
			{
				$this->service->conectar( $token2[ $i ], $desap2[ $i ] );
			}
			//echo "HEREEEEE1";
			// /\ conectando o resto dos tokens
		}
		else
		{
			/*/ 	debugging purposes
			echo "<br />Marcador Desap: ",$this->marcador_desap, "<br />";
			echo "Total de Tokens: ", $this->totaltoken, "<br />";
			echo "Todos os Tokens: ", $this->todostokens, "<br />"; //*/
			// nesse caso, não sobram tokens, é como se estivesse no desap 10/70 com 30 tokens. Vai simplesmente pegar na lógica e parar no desap 40.
			$vars = $this->igualar( $this->dm->iterar( $this->marcador_desap, $this->marcador_desap + $this->totaltoken ), $this->todostokens );
			//                                    /\ pegando desap                                              /\ pegando tokens 

			$desap = $vars[0];
			$token = $vars[1];
			$count = count( $desap ) - 1;

			new DemarcadorDeFluxo( $this->marcador_desap + $this->totaltoken, "desap" );
			new DemarcadorDeFluxo(                 0                        , "token" );
			// sinalizando marcador

			for( $i = 0; $i <= $count; $i++ )
			{
				$this->service->conectar( $token[$i], $desap[$i] );
				
			}
			//echo "HEREEE2"; debugging purposes
			// /\ conectando token a desap
		}
	}

	private function maisToken( )
	{
		// nessa (ótima) situação, existem mais tokens do que desaps
		// logo, vai rodando todos os desaps n vezes até que todos os tokens sejam usados
		// mas muito provavelmente n nao vai ser inteiro, por exemplo 75 tokens e 30 desaps, vai rodar 2 vezes e sobrar 15 tokens.
		// no final, uma lógica é usada para também usar esse 'resto' de token, os 15 que sobraram

		$pags = ceil( $this->totaltoken / $this->totaldesap );
		// calculando numero de iterações inteiras		
		$i = 1;

		while( $i != $pags ) // enquanto nao chegar na última iteração
		{
			$vars = $this->igualar($this->tm->iterar( ($i - 1)*$this->totaldesap, $i*$this->totaldesap ), $this->dm->retornarTodos() );
			//			/\ pegar tokens da atual iteração                                      /\ pegar todos os desaps

			$token = $vars[0];
			$desap = $vars[1];

			$count = count( $desap ) - 1;

			for( $i = 0; $i <= $count; $i++ )
			{
				$this->service->conectar( $token[ $i ], $desap[ $i ] );
			}

			$i += 1;
		}

		$vars = $this->igualar( $this->tm->iterar($this->totaldesap,$this->totaltoken),$this->dm->iterar(0,$this->totaltoken-$this->totaldesap));
		// pegando resto de desap
		$restoToken = $vars[0];
		$restoDesap = $vars[1];

		$count = count( $restoDesap ) - 1;

		for( $i = 0; $i <= $count; $i++ )
		{
			$this->service->conectar( $restoToken[ $i ], $restoDesap[ $i ] );
		}
	}
	
	private function igual( ) // caso ocorra o curioso caso do número de tokens ser igual ao de desaps, só iterar todos com todos
	{
		$vars  = $this->igualar( $this->todostokens, $this->todosdesap );

		$token = $vars[0];
		$desap = $vars[1];

		$count = count( $desap ) - 1;

		for( $i = 0; $i <= $count; $i++ )
		{
			$this->service->conectar( $token[ $i ], $desap[ $i ] );
		}
	}
}
$cerebro = new Cerebro();
$cerebro->pensar();
