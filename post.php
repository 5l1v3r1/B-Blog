<?php
	require_once('includes/functions.php');

	if( !isset($_POST['A']) )
		require_once('header.php');


	if( isset($_GET['id']) && (int)$_GET['id']>0 )
	{
		?>
			<div class="singlepost">
				سلااااام
			</div>




		<?php
	}


	if( !isset($_POST['A']) )
		require_once('footer.php');
?>
