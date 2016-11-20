<?php
	/**
	*	Login/Logout page
	*	@param $_POST['USER']	Username
	*	@param $_POST['PASS']	User password
	*	@param $_GET['OUT']		Logout user
	*	return values
	*	@return	0	invalid data
	*	@return	1	Loged out
	*	@return	2	User/pass is wrong
	*	@return	200	OK, Loged in
	*/
	require_once('includes/functions.php');

	$R = 0;

	if( !logedin() AND ISSET($_POST['USER'],$_POST['PASS']) )
	{
		$USER = $_POST['USER'];
		$PASS = $_POST['PASS'];

		if( strlenchk($USER,5,24) AND strlenchk($PASS,8,32) )
		{
			$PASS = mkhash($PASS);

			$GET_USER = $SQL->query("SELECT ID,USER,NAME,EMAIL,WEB,GRP FROM USERS WHERE USER='".scape($USER)."' AND PASS='".scape($PASS)."'");

			if( $GET_USER!==FALSE && $GET_USER->num_rows==1 )
			{
				$USER = $GET_USER->fetch_assoc();

				foreach ($USER as $key => $value) {
					$_SESSION[$key] = $value;
				}

				$R = 200;
			}
			else {
				$R = 2;
			}
		}
		else {
			$R = 2;
		}
	}
	else {
		if( ISSET($_GET['OUT']) )
		{
			session_destroy();
			session_start();
			$R = 1;
		}
	}

	if( !isset($_POST['A']) )
		header("Location: index.php");

	echo $R;
?>
