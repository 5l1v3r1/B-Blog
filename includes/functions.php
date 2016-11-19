<?php
	require_once('config.php');
	require_once("PersianCalendar.php");
	// Connection Variable
	$SQL = new mysqli($CONF['location'],$CONF['dbuser'],$CONF['dbpass'],$CONF['dbname']);

	if ( mysqli_connect_errno() ) {
		log_error('!!!!--MYSQL ERROR: CONNECTION GOT ERROR='.mysqli_connect_error(),0);
		exit();
	}// Setting
	$SQL->set_charset("utf8");
	date_default_timezone_set('Asia/Tehran');


	/**
	*	@param string $str
	*/
	function scape($str)
	{
		global $SQL;
		return $SQL->real_escape_string($str);
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

	// Echo HTML encoded text
	function eecho($str){
		echo htmlentities($str);
	}
 ?>
