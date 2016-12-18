<?php
	require_once('includes/functions.php');

	if( !isset($_POST['A']) AND !isset($_GET['A']) )
		require_once('header.php');

	if( isset($_GET['CAT']) )
	{
		$CATEGORY = " AND C.ID='".scape((int)$_GET['CAT'])."'";
		$CATNAME = $SQL->query("SELECT NAME FROM CATS WHERE ID='".scape((int)$_GET['CAT'])."';");
		if( $CATNAME!==FALSE && $CATNAME->num_rows!=0 )
		{
			$CATNAME = $CATNAME->fetch_assoc();
			echo '<h1>دسته : ';
			eecho($CATNAME['NAME']);
			echo '</h1>';
		}
	}

	$POSTS = $SQL->query("SELECT P.ID,P.TITLE,P.STEXT,P.TIME,U.NAME AS AUTHOR,C.ID AS CID,C.NAME AS CNAME FROM POSTS AS P, USERS AS U, CATS AS C WHERE P.TYPE=1 AND P.AUTHOR=U.ID AND P.CAT=C.ID".@$CATEGORY." ORDER BY P.TIME DESC;");

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

			<div class="adh">
				<img src="lib/adh<?php echo rand(1,4); ?>.png" />
			</div>

			<?php
		}
	}
	else {
		echo '<h1>محتوایی برای نمایش پیدا نشد.</h1>';
	}

  if( !isset($_POST['A']) AND !isset($_GET['A']) )
    require_once('footer.php');
?>
