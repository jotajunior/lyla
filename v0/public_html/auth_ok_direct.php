<?php
/*
 * Copyright 2010 - Robson Dantas <biu.dantas@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
require_once('../globals.php');
require_once('autoload.php');


$orkutApi = new Orkut($config['userOrkut'], $config['senhaOrkut']);

// start session, it it's not already done
if(!isset($_SESSION))
	session_start();


unset($_SESSION['oauth_token'] );
// gets the script name
$script = $_SERVER["SCRIPT_NAME"];

// check if we are asking for an authorization, or including a file with authorization
if(strstr($script,"auth_ok_direct.php")=="") {
	if(!isset($_SESSION['oauth_token']) || $_SESSION['oauth_token']=='')
		GenericError::stop(1, 'Not authenticated');
}
else{

	try {
		$orkutApi->login(); /* AQUI ESTÁ O PROCESSO DE AUTENTICAÇÃO INTEIRO. */
	}
	catch(Exception $e) {
		//print_r($e);
		$_SESSION['oauth_token']='';
		GenericError::stop(1,'Cant authenticate on Orkut. Message: '.$e->getMessage());
	}
}

class GetOrkutUserInfo {

	private $profileFields = array(
					'displayName',
					'currentLocation',
					'thumbnailUrl',
					'gender',
					'name'
					);
	private $orkutApi;
	
	public function __construct($orkut) {
	
		$this->orkutApi = $orkut;
		$this->fetchMe();
	}
	  
	private function fetchMe() {
	
		// myself call
		$me = array('method' => 'people.get', 
			'params' => array('userId' => array('@me'), 'groupId' => '@self', 'fields' => $this->profileFields),
			);
		
		// add current user to the batch
		$this->orkutApi->addRequest($me,'self');
		
	}
	
	private function fetchUsers() {
		
		$friends = array('method' => 'people.get', 
						 'params' => array('userId' => array('@me'), 'groupId' => '@friends', 
						 'fields' => $this->profileFields,
						 'count' => $this->friendCount),
			);
		
		// add friends request to the batch
		$this->orkutApi->addRequest($friends, 'friends');
	}
	
	public function execute() {
		
		// try to execute the request, and stop sending an error (if we get one)
		$exec = $this->orkutApi->execute();

		if(isset($exec['self']['error']))
			GenericError::stop(1,$exec['self']['error']['message']);
		
		$result = array();
		$result[] = array('id'=>'0','message'=>'ok');
		$result[] = $exec;

		return $result[1]['self']['data']['id'];
	
	}
	
}

try
{
	$b = new GetOrkutUserInfo( $orkutApi );

	$v                = new TokenVO();
	$v->id_voluntario = 0;
	$v->token         = $_SESSION['oauth_token'];
	$v->nome          = $b->execute();
	$v->servico       = 'orkut';

	$m = new TokenModel( $v );
	$m->registrar();
	echo "<script>alert('Obrigado!');</script>";
	LoginView::redirecionarPara("index.php");
}
catch( Exception $e )
{
	echo $e->getMessage()."<br />";
}
?>
