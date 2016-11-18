<?php
	require_once('includes/functions.php');

  if( !isset($_POST['A']) )
    require_once('header.php');


	$POSTS = $SQL->query('SELECT P.ID,P.TITLE,P.STEXT,P.TIME,U.NAME FROM POSTS AS P,USERS AS U WHERE P.TYPE=1 AND P.POSTER=U.ID;');

	if( $POSTS!==FALSE && $POSTS->num_rows!=0 )
	{
		while ( $POST=$POSTS->fetch_assoc() )
		{
			?>

			<div class="post">
				<a href="post.php?id=<?php echo $POST['ID']; ?>"><strong><?php eecho($POST['TITLE']); ?></strong></a>
				<span><?php eecho($POST['STEXT']); ?></span>
				<div>
					<a href="post.php?id=<?php echo $POST['ID']; ?>"><button>ادامه مطلب »</button></a>
					<span><strong>نویسنده: </strong><?php eecho($POST['NAME']); ?></span>
					<span><strong>تاریخ ارسال: </strong><?php echo $POST['TIME']; ?></span>
				</div>
			</div>

			<?php
		}
	}


?>

<?php
  if( !isset($_POST['A']) )
    require_once('footer.php');
?>
