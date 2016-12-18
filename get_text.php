<?php
	require_once('includes/functions.php');

	if( !isset($_GET['A']) )
	  header("Location: index.php");

	echo get_text();
?>
