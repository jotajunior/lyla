<?php
include( "config.php" );
$func = get_defined_functions();
if( !in_array("__autoload",  $func['user']) )
{
	function __autoload( $class )
	{
		switch( $class )
		{
			case "Connection":
				include( "Model/conn.class.php" );
			break;
			case "DesapModel":
			case "DesapVO":
			case "DesapDAO":
				include( "Model/desapModel.class.php" );
			break;
			case "VoluntarioModel":
			case "VoluntarioVO":
			case "VoluntarioDAO":
				include( "Model/voluntarioModel.class.php" );
			break;
			case "LoginModel":
			case "LoginVO":
			case "LoginDAO":
				include( "Model/loginModel.class.php" );
			break;
			case "Sessao":
				include( "Controller/sessao.class.php" );
			break;
			case "TokenModel":
			case "TokenVO":
			case "TokenDAO":
				include( "Model/tokenModel.class.php" );
			break;
			case "AdminVO":
			case "AdminDAO":
			case "AdminModel":
				include( "Model/adminModel.class.php" );
			break;
			case "LoginVoluntarioModel":
				include( "Model/loginVoluntarioModel.class.php");
			break;
			case "LoginDesapModel":
				include( "Model/loginDesapModel.class.php" );
			break;
			case "LoginAdminModel":
				include( "Model/loginAdminModel.class.php" );
			break;
			case "DemarcadorDeFluxo":
				include( "Model/demarcadordefluxo.class.php" );
			break;
			case "DAO":
				include( "Model/dao.class.php" );
			break;
			case "FotoVO":
			case "FotoDAO":
			case "FotoModel":
				include( "Model/fotoModel.class.php" );
			break;
			case "SocialService":
				include( "lib/socialservice.class.php" );
			break;
			case "tmhOAuth":
				include( "lib/tmhOAuth.php" );
			break;
			case "tmhUtilities":
				include( "lib/tmhUtilities.php" );
			break;
			case "LoginView":
				include( "View/loginView.class.php" );
			break;
			case "LoginAdminView":
				include( "View/loginAdminView.class.php" );
			break;
			case "LoginDesapView":
				include( "View/loginDesapView.class.php" );
			break;
			case "LoginVoluntarioView":
				include( "View/loginVoluntarioView.class.php" );
			break;
			case "DesapView":
				include( "View/desapView.class.php" );
			break;
			case "DesapController":
				include( "Controller/desapController.class.php" );
			break;
			case "VoluntarioView":
				include( "View/voluntarioView.class.php" );
			break;
			case "AdminView":
				include( "View/adminView.class.php" );
			break;
			case "View":
				include( "View/view.class.php" );
			break;
			case "Upload":
				include( "lib/upload.class.php" );
			break;
			case "VoluntarioController":
				include( "Controller/voluntarioController.class.php" );
			break;
			case "LoginController":
				include( "Controller/loginController.class.php" );
			break;
			case "AdminController":
				include( "Controller/adminController.class.php" );
			break;
			default:
				throw new Exception( "Classe $class n«ªo encontrada." );
			break;
		}
	}
}
?>
