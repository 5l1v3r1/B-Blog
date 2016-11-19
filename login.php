<?php
	require_once('includes/functions.php');

	// for test directly
	$_POST['A'] = 'testuser';
	$_POST['USER'] = 'testuser';
	$_POST['PASS'] = '12345678';

	$R = 0;	// something went wrong

	if( !logedin() AND ISSET($_POST['USER'],$_POST['PASS']) )
	{
		$USER = $_POST['USER'];
		$PASS = $_POST['PASS'];

		if( strlenchk($USER,5,24) AND strlenchk($PASS,8,32) )
		{
			$PASS = mkhash($PASS);

			$GET_USER = $SQL->query("SELECT ID,USER,NAME,EMAIL,WEB,GRP FROM USERS WHERE USER='".scape($USER)."' AND PASS='".scape($PASS)."'");
		}
		else {
			$R = 2; // Wrong user/pass
		}
	}
	else
	{
		if( ISSET($_GET['OUT']) )
		{
			session_destroy();
			session_start();
			$R = 1; // logouted
		}
	}

	if( !isset($_POST['A']) )
		//header("Location: index.php");

	echo $R;
?>
