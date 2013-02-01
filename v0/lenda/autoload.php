<?php
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
				include( "Model/desap.class.php" );
			break;
			case "VoluntarioModel":
			case "VoluntarioVO":
			case "VoluntarioDAO":
				include( "Model/voluntario.class.php" );
			break;
			case "LoginModel":
			case "LoginVO":
			case "LoginDAO":
				include( "Model/login.class.php" );
			break;
			case "Sessao":
				include( "Controller/sessao.class.php" );
			break;
			case "TokenModel":
			case "TokenVO":
			case "TokenDAO":
				include( "Model/token.class.php" );
			break;
			case "AdminVO":
			case "AdminDAO":
			case "AdminModel":
				include( "Model/admin.class.php" );
			break;
			case "LoginVoluntarioModel":
				include( "Model/loginVoluntario.class.php");
			break;
			case "LoginDesapModel":
				include( "Model/loginDesap.class.php" );
			break;
			case "LoginAdminModel":
				include( "Model/loginAdmin.class.php" );
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
				include( "Model/foto.class.php" );
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
				include( "View/login.class.php" );
			break;
			case "LoginAdminView":
				include( "View/loginAdmin.class.php" );
			break;
			case "LoginDesapView":
				include( "View/loginDesap.class.php" );
			break;
			case "LoginVoluntarioView":
				include( "View/loginVoluntario.class.php" );
			break;
			case "DesapView":
				include( "View/desap.class.php" );
			break;
			case "DesapController":
				include( "Controller/desap.class.php" );
			break;
			case "VoluntarioView":
				include( "View/voluntario.class.php" );
			break;
			case "AdminView":
				include( "View/admin.class.php" );
			break;
			case "View":
				include( "View/view.class.php" );
			break;
			case "Upload":
				include( "lib/upload.class.php" );
			break;
			case "VoluntarioController":
				include( "Controller/voluntario.class.php" );
			break;
			case "LoginController":
				include( "Controller/login.class.php" );
			break;
			case "AdminController":
				include( "Controller/admin.class.php" );
			break;
			default:
				throw new Exception( "Classe $class não encontrada." );
			break;
		}
	}
}
?>
