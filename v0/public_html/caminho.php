<?php 
$image_folder = '/home/jotaj896/public_html/imagens/';
// caminho.php?pic=sjgsdkufgiw4gfgjh.jpg
if (isset($_GET['pic']) && basename($_GET['pic']) == $_GET['pic']) { 
	$pic = $image_folder.$_GET['pic']; 
	if (file_exists($pic) && is_readable($pic)) { 
		$ext = substr($pic, -3);
		switch ($ext) { 
			case 'jpg':
			case 'jpeg': 
				$mime = 'image/jpeg'; 
			break; 
			case 'gif': 
				$mime = 'image/gif'; 
			break; 
			case 'png': 
				$mime = 'image/png'; 
			break; 
			default: 
				$mime = false; 
		} 
		if ($mime) { 
			header('Content-type: '.$mime); 
			header('Content-length: '.filesize($pic)); 
			$file = @ fopen($pic, 'rb'); 
			if ($file) { 
				fpassthru($file); 
				exit; 
			} 
		} 
	
	} 
} 
?>
