<?php 
require_once( 'autoload.php' );

   if( !isset( $_SESSION ) )
   {
   	session_start();
   }
   
   $app_id = "241602605864512";
   $app_secret = "";
   $my_url = "http://jotajunior.net/lyla/auth_fb_direct.php";
   

   session_start();
   $code = $_REQUEST["code"];

   if(empty($code)) {
     $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
     $dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" 
       . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
       . $_SESSION['state']."&scope=offline_access,publish_stream";

     echo("<script> top.location.href='" . $dialog_url . "'</script>");
   }

  
     $token_url = "https://graph.facebook.com/oauth/access_token?"
       . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
       . "&client_secret=" . $app_secret . "&code=" . $code;

     $response = file_get_contents($token_url);
     
     $params = null;
     parse_str($response, $params);
     

 	try 	
        {
 		$v                = new TokenVO();
 		$v->token         = serialize( $params['access_token'] );
 		$v->servico       = 'facebook';
 		$graph_url = "https://graph.facebook.com/me?access_token=" . $params['access_token'];

  		$a = json_decode(file_get_contents($graph_url));
     
 		$v->nome	  = $a->id;
  		$m = new TokenModel( $v );

 		if( $v->token != "N;" )
                {
                        $m->registrar();
                }
 		echo "<script>alert('Obrigado!');</script>";
 		LoginView::redirecionarPara("index.php");
 	} 	catch( Exception $e ) 	{
 		print_r( $e->getMessage() );
 	}
 
  
