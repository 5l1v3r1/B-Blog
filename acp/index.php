<?php
	require_once('../includes/functions.php');
	checkadmin();
	$A = $_POST['A'];	// Load other pages without header and footer

	if( !isset($_POST['A']) )
		require_once('header.php');
/////////////////////////////////

	echo 'YOU HAS ACCESS TO ACP';

////////////////////////////////
	if( !isset($_POST['A']) )
		require_once('footer.php');
 ?>
