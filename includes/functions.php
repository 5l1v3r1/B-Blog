<?php
	require_once('config.php');
	// Connection Variable
	$SQL = new mysqli($CONF['location'],$CONF['dbuser'],$CONF['dbpass'],$CONF['dbname']);

	if ( mysqli_connect_errno() ) {
		log_error('!!!!--MYSQL ERROR: CONNECTION GOT ERROR='.mysqli_connect_error(),0);
		exit();
	}// Setting
	$SQL->set_charset("utf8");
	date_default_timezone_set('Asia/Tehran');



	function scape($STR)
	{
		global $SQL;
		return $SQL->real_escape_string($STR);
	}


	function logedin(){
		if( ISSET($_SESSION['UID']) )
			return true;
		return false;
	}

	function get_text(){
		global $TEXTS;
		echo $TEXTS[ rand(0,count($TEXTS)-1) ];
	}

 ?>
