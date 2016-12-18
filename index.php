<?php
	require_once('includes/functions.php');

  if( !isset($_POST['A']) )
    require_once('header.php');


	$POSTS = $SQL->query('SELECT P.ID,P.TITLE,P.STEXT,P.TIME,U.NAME AS AUTHOR,C.ID AS CID,C.NAME AS CNAME FROM POSTS AS P, USERS AS U, CATS AS C WHERE P.TYPE=1 AND P.AUTHOR=U.ID AND P.CAT=C.ID ORDER BY P.TIME DESC;');

	if( $POSTS!==FALSE && $POSTS->num_rows!=0 )
	{
		while ( $POST=$POSTS->fetch_assoc() )
		{
			?>

			<div class="post">
				<a href="post.php?id=<?php echo $POST['ID']; ?>"><h3><?php eecho($POST['TITLE']); ?></h3></a>
				<p><?php eecho($POST['STEXT']); ?></p>
				<div class="postfooter">
					<span><strong>تاریخ ارسال : </strong><?php echo mds_date("l  j F Y",$POST['TIME']); ?></span>
					<span><strong>نویسنده : </strong><?php eecho($POST['AUTHOR']); ?></span>
					<span><strong>دسته : </strong><?php eecho($POST['CNAME']); ?></span>
				</div>
			</div>

			<?php
		}
	}

  if( !isset($_POST['A']) )
    require_once('footer.php');
?>
