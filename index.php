<?php
	require_once('includes/functions.php');

	if( !isset($_POST['A']) AND !isset($_GET['A']) )
		require_once('header.php');

	if( isset($_GET['cat']) )
	{
		$CATEGORY = " AND C.ID='".scape((int)$_GET['cat'])."' ";
		$CATNAME = $SQL->query("SELECT NAME FROM CATS WHERE ID='".scape((int)$_GET['cat'])."';");
		if( $CATNAME!==FALSE && $CATNAME->num_rows!=0 )
		{
			$CATNAME = $CATNAME->fetch_assoc();
			echo '<h1>دسته : ';
			eecho($CATNAME['NAME']);
			echo '</h1>';
		}
	}

	if( isset($_GET['tag']) )
	{
		echo '<h1>برچسب : ';
		eecho($_GET['tag']);
		echo '</h1>';
	}

	// if search Tags...
	if( isset($_GET['tag']) AND !empty($_GET['tag']) )
		$TAG = " AND TAGS like '%".scape($_GET['tag'])."%' ";

	$POSTS = $SQL->query("SELECT P.ID,P.TITLE,P.STEXT,P.TIME,U.ID AS UID,U.NAME AS AUTHOR,C.ID AS CID,C.NAME AS CNAME FROM POSTS AS P, USERS AS U, CATS AS C WHERE P.TYPE=1 AND P.AUTHOR=U.ID AND P.CAT=C.ID".@$CATEGORY.@$TAG." ORDER BY P.TIME DESC;");

	if( $POSTS!==FALSE && $POSTS->num_rows!=0 )
	{


		while ( $POST=$POSTS->fetch_assoc() )
		{
			?>

			<div class="post">
				<a href="post?id=<?php echo $POST['ID']; ?>"><h3><?php eecho($POST['TITLE']); ?></h3></a>
				<p><?php eecho($POST['STEXT']); ?></p>
				<div class="postfooter">
					<span class="fa-calendar"><strong>تاریخ ارسال : </strong><?php echo mds_date("l  j F Y",$POST['TIME']); ?></span>
					<span class="fa-user"><strong>نویسنده : </strong><?php eecho($POST['AUTHOR']); ?></span>
					<span class="fa-list"><strong>دسته : </strong><a href="?cat=<?php echo $POST['CID']; ?>"><?php eecho($POST['CNAME']); ?></a></span>
					<?php if(isadmin()){ echo '<a na href="acp/post?ID='.$POST['ID'].'"><span class="fa-pencil">ویرایش مطلب</span></a>'; } ?>
				</div>
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
