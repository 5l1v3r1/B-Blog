<?php
	require_once('../includes/functions.php');
	checkadmin();

	if( !isset($_POST['A']) )
     require_once('header.php');


	  echo 'YOU HAS ACCESS TO ACP';

	  if( !isset($_POST['A']) )
	    require_once('footer.php');
 ?>
