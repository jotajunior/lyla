<?php

/*
#
* @author Jota Vicente <jotavrj at gmail dot com>
#
*
#
*/
include('autoload.php');

class Connection extends PDO {

	public $handle = null;

	function __construct( ) {
		try {
			if ( $this->handle == null ) {
				$dbh = parent::__construct( "mysql:dbname=jotaj896_lyla;host=127.0.0.1" , 'jotaj896_lyla' , 'eita9898HHjas@&h_' );
				$this->handle = $dbh;
				return $this->handle;
			}
		}
		catch ( PDOException $e ) {
			echo 'Connection failed: ' . $e->getMessage( );
			return false;
		}
	}

}

