<?php
//include("../config.php");

class Upload {
	public $field, $acc, $maxsize, $width, $height;

	public function __construct( )
	{
		$this->dir = '/home/jotaj896/public_html/imagens/';
	}
	
	public function setTamanhoMaximo( $tam )
	{
		$this->maxsize = (int) $tam;
		return true;
	}

	public function setLarguraMaxima( $width )
	{
		$this->width = (int) $width;
		return true;
	}

	public function setAlturaMaxima( $height )
	{
		$this->height = (int) $height;
		return true;
	}

	function gerarMiniatura($img, $max_x, $max_y, $nome_foto) 
	{
	/*PADRAO de $nome_foto para miniatura será o nome da foto grande acrescentado de '_min' jksahf97tbfhb_min.jpg*/
		list($width, $height) = getimagesize($img);

		$original_x = $width;
		$original_y = $height;

		if($original_x > $original_y) 
		{
   			$porcentagem = (100 * $max_x) / $original_x;   
		} else 
		{
   			$porcentagem = (100 * $max_y) / $original_y;   
		}
			$tamanho_x = $original_x * ($porcentagem / 100);
			$tamanho_y = $original_y * ($porcentagem / 100);

			$image_p = imagecreatetruecolor($tamanho_x, $tamanho_y);
			$image   = imagecreatefromstring(file_get_contents($img));
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $tamanho_x, $tamanho_y, $width, $height);


			return imagejpeg($image_p, $nome_foto, 100);
	}
	
	public function subirFoto( $arquivo )
	{

			if( $arquivo["name"] !== "" )
			{
				if (!eregi("^image\/(jpg|pjpeg|jpeg|png|gif|bmp)$", $arquivo["type"])) 
				{
					throw new Exception( "O formato da imagem é inválido." );
				}
		
				if ($arquivo["size"] > $this->maxsize) 
				{
					throw new Exception( "Imagem muito pesada. Tamanho máximo de $this->maxsize bytes." );
				}
				     
		
				$tamanhos = getimagesize($arquivo["tmp_name"]);
		
		
				if ($tamanhos[0] > $this->width OR $tamanhos[1] > $this->height)
				{
					if ( eregi("^image\/(pjpeg|jpeg|png|jpg|gif|bmp)$", $arquivo["type"]) AND $arquivo["size"] < $this->maxsize)
					{
						$imagem_token = md5(uniqid(time()));
						$imagem_nome = $imagem_token.".jpg";
						$this->file_name = $imagem_token;

						$imagem_dir = $this->dir . $imagem_nome;
	
						if ( $this->gerarMiniatura($arquivo["tmp_name"], $this->width, $this->height, $imagem_dir) == false )
						{
							throw new Exception( "Houve um erro durante o redimensionamento da imagem." );
						}
					}
					return $imagem_nome;
				}
				else
				{
			
					preg_match("/\.(jpg|gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["name"], $ext);
		
					$imagem_token = md5(uniqid(time()));
					$imagem_nome = $imagem_token.".".$ext[1];
					$this->file_name = $imagem_token;
					$imagem_dir = $this->dir . $imagem_nome;
					if ( move_uploaded_file($arquivo["tmp_name"], $imagem_dir) == false )
					{
						throw new Exception( "Houve um erro durante a gravação da imagem no servidor AQUI" );		
					}
					return $imagem_nome;
				}
			}
	}

}
/* IT WORKS
$a = new Upload();
$a->setTamanhoMaximo( 2048000);
$a->setAlturaMaxima( 900 );
$a->setLarguraMaxima( 900 );
$i = 0;
$fotos = $_FILES['fotos'];
		$fotosb = array();
		$values = array_values( $fotos );
		$counter_files = count( $values[0] ) - 1;
		for( $i = 0; $i<=$counter_files; $i++ )
		{
			$fotosb[$i]["name"] = $fotos["name"][$i];
			$fotosb[$i]["type"] = $fotos["type"][$i];
			$fotosb[$i]["tmp_name"] = $fotos["tmp_name"][$i];
			$fotosb[$i]["error"] = $fotos["error"][$i];
			$fotosb[$i]["size"] = $fotos["size"][$i];
		}
$idc = 5;
foreach( $fotosb as $foto )
{
	$con = new Connection();
	$sql = "INSERT INTO fotos(id_carro, endereco) VALUES (:idc, :endereco)";
	$sth = $con->prepare( $sql );
	$b = $a->subirFoto( $foto );
	$sth->bindParam(":idc", $idc, PDO::PARAM_INT);
	$sth->bindParam(":endereco", $b, PDO::PARAM_STR);
	$sth->execute();

}*/
?>
