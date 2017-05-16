<?php
	require_once('../includes/functions.php');
	checkadmin();

	if( isset($_GET['ID'], $_GET['TYPE']) )
	{
		$ID = (int)$_GET['ID'];
		switch ($_GET['TYPE']) {
			case 'delete':
				$QUERY = "DELETE FROM `COMMENTS` WHERE `COMMENTS`.`ID`=".scape($ID);
				break;

			case 'reject':
				$QUERY = "UPDATE `COMMENTS` SET `TYPE` = '0' WHERE `COMMENTS`.`ID`=".scape($ID);
				break;

			case 'accept':
				$QUERY = "UPDATE `COMMENTS` SET `TYPE` = '1' WHERE `COMMENTS`.`ID`=".scape($ID);
				break;

			default:
				die();
				break;
		}

		$RESULT = $SQL->query($QUERY);
		if( $RESULT!==false )
		{
			if( $SQL->affected_rows===1 )
				die('200');
			else
				die('404');
		}
		else
			die('500');
	}

 ?>
