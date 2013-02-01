<?php

/*
#
* @author Jota Vicente <jotavrj at gmail dot com>
#
*
#
*/
include(\APP.'autoload.php');

class Connection extends PDO 
{

	public $handle = null;

	function __construct( ) 
	{
		try 
		{
			if ( $this->handle == null ) 
			{
                                $settings = $this->retrieveSettings();
				$dbh = parent::__construct( 
                                    $settings->dbhost , 
                                    $settings->dbuser , 
                                    $settings->dbpass 
                                );
				$this->handle = $dbh;
			}
			return $this->handle;
			
		}
		catch ( PDOException $e ) 
		{
			echo 'Connection failed: ' . $e->getMessage( );
			return false;
		}
	}
        
        protected function retrieveSettings()
        {
            $settingsFile = \APP.'lyla.ini';
            if(file_exists('/etc/lyla/lyla.ini')){
                $settingsFile = '/etc/lyla/lyla.ini';
            }
            return (object) parse_ini_file($settingsFile,true);
        }
}
