<?php 
require_once( 'autoload.php' );

   if( !isset( $_SESSION ) )
   {
   	session_start();
   }
   
   $app_id = "241602605864512";
   $app_secret = "";
   $my_url = "http://localhost/lyla/lib/auth_fb.php";
   

   $code = $_REQUEST["code"];

   if(empty($code)) {
     $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
     $dialog_url = "http://www.facebook.com/dialog/oauth?client_id=" 
       . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
       . $_SESSION['state'];

     echo("<script> top.location.href='" . $dialog_url . "'</script>");
   }

   if($_REQUEST['state'] == $_SESSION['state']) {
     $token_url = "https://graph.facebook.com/oauth/access_token?"
       . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
       . "&client_secret=" . $app_secret . "&code=" . $code;

     $response = file_get_contents($token_url);
     $params = null;
     parse_str($response, $params);

     $graph_url = "https://graph.facebook.com/me?access_token=" 
       . $params['access_token'];

     $user = json_decode(file_get_contents($graph_url));
     // registrar o $user->id no campo identificador do token

	$v                = new TokenVO();
	$v->id_voluntario = Sessao::pegarDado("id", "voluntarios");
	$v->token         = serialize( $params['access_token'] );
	$v->nome          = $user->id;
	$v->servico       = 'facebook';

	$m = new TokenModel( $v );
	$m->registrar();
   }
   else {
     echo("The state does not match. You may be a victim of CSRF.");
   }

 ?>
