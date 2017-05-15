<?php
/**
*	New comment
*	@param $_POST['PID']	post id
*	@param $_POST['NAME']	user name
*	@param $_POST['EMAIL']	user email address
*	@param $_POST['WEB']		user website address
*	@param $_POST['CMT']		comment text
*
*	@return	0	invalid data
*	@return	1	post not exist
*	@return	2	name len error
*	@return	3	invalid email entered
*	@return	4	invalid web address
*	@return	5	comment len error
*	@return	200	comment saved
*	@return	-1		INTERNAL ERROR
*/
	require_once('includes/functions.php');

	if( !isset($_POST['A']) AND !isset($_GET['A']) )
		header("Location: ./");

	if( isset($_POST['PID'],$_POST['NAME'],$_POST['EMAIL'],$_POST['WEB'],$_POST['CMT']) )
	{
		$PID = (int)$_POST['PID'];

		// check post is exist
		$CHECK_POST = $SQL->query("SELECT ID,TITLE FROM POSTS WHERE ID='".scape($PID)."';");
		if( $CHECK_POST!==false )
		{
			if( $CHECK_POST->num_rows==1 )
				$POST = $CHECK_POST->fetch_assoc();
			else
				die('1');
		}
		else
			die('-1');

		// check and set data
		if( isset($_SESSION['ID'],$_SESSION['USER'],$_SESSION['NAME'],$_SESSION['EMAIL'],$_SESSION['WEB']) )
		{
			$UID = $_SESSION['ID'];
			$UNAME = $_SESSION['NAME'];
			$UMAIL = $_SESSION['EMAIL'];
			$UWEB = $_SESSION['WEB'];
		}
		else
		{
			$UID = 0;
			$UNAME = $_POST['NAME'];
			$UMAIL = $_POST['EMAIL'];
			$UWEB =	$_POST['WEB'];

			if( !strlenchk($UNAME,3,50) )
				die('2');

			if( !filter_var($UMAIL, FILTER_VALIDATE_EMAIL) )
				die('3');

			if( $UWEB!='' AND !filter_var($UWEB, FILTER_VALIDATE_URL) )
				die('4');
		}


		if( !strlenchk($_POST['CMT'],3,1000) )
			die('5');

		$SENDCMT = $SQL->query("INSERT INTO COMMENTS (TYPE,SENDER,POST,NAME,EMAIL,WEB,TXT,TIME)".
		"VALUES (2,".$UID.",'".scape($PID)."','".scape($UNAME)."','".scape($UMAIL)."','".scape($UWEB)."','".scape($_POST['CMT'])."','".time()."');");

		if( $SENDCMT!==false )
		{
			if( $SQL->affected_rows==1 )
				die('200');
			else
				die('-1');
		}
		else
			die('-1');
	}
	else
		die('0');

?>
