<?php
	session_start();

	require_once('config.php');
	require_once("PersianCalendar.php");
	// Connection Variable
	$SQL = new mysqli($CONF['remoteurl'],$CONF['dbuser'],$CONF['dbpass'],$CONF['dbname']);

	if ($SQL->connect_error) {
    die("INTERNAL SERVER ERROR ACCOURED...");
	}

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
		if( ISSET($_SESSION['ID'],$_SESSION['USER'],$_SESSION['NAME'],$_SESSION['EMAIL'],$_SESSION['WEB']) )
			return true;
		return false;
	}

	function isadmin(){
		if( logedin() )
			if( $_SESSION['GRP']=='10' )
				return true;
		return false;
	}

	function get_text(){
		global $TEXTS;
		echo $TEXTS[ rand(0,count($TEXTS)-1) ];
	}

	// Echo HTML encoded text
	function eecho($str=''){
		echo htmlentities($str);
	}

	/**
	* Check string length match with limite
	* @param string @str
	* @param integer @min
	* @param integer @maax
	* @return boolean
	*/
	function strlenchk($str,$min,$max){
		$l = mb_strlen( trim($str), 'UTF-8');
		if( $l>=$min and $l<=$max )
			return true;
		return false;
	}

	function mkhash($str){
		return md5(md5($str.'oaiaduspojraj').'oueoijlchsa');
	}

	/***** Admin Controll Panel functions *****/


	/**
	*	if is not admin exit script
	*
	*/
	function checkadmin(){
		if( isadmin() )
			return true;
		else{
			if( isset($_POST['A']) OR isset($_GET['A']) )
				die('403');
			else{
				header("Location: ../index.php");
				exit();
			}
		}
	}
 ?>
