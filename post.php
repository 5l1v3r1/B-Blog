<?php
	require_once('includes/functions.php');

	if( !isset($_POST['A']) )
		require_once('header.php');


	if( isset($_GET['id']) && (int)$_GET['id']>0 )
	{
		$POSTID = scape((int)$_GET['id']);
		$GET_POST = $SQL->query("SELECT P.ID,P.TITLE,P.STEXT,P.FTEXT,P.TIME,P.TAGS,U.USER,U.NAME AS AUTHOR,C.ID,C.NAME AS CNAME FROM POSTS AS P, USERS AS U, CATS AS C WHERE P.AUTHOR=U.ID AND P.CAT=C.ID AND P.TYPE=1 AND P.ID=".$POSTID.";");

		if( $GET_POST!==FALSE AND $GET_POST->num_rows==1 )
		{
			$P = $GET_POST->fetch_assoc();
		?>
			<div class="singlepost">
				<div class="postsec">
					<h3><?php eecho($P['TITLE']); ?></h3>
					<div>
						<p class="post-text"><?php eecho($P['STEXT']); ?></p>
						<div class="postfooter">
							<span><strong>تاریخ ارسال : </strong><?php echo mds_date("l  j F Y",$P['TIME']); ?></span>
							<span><strong>نویسنده : </strong><?php eecho($P['AUTHOR']); ?></span>
							<span><strong>دسته : </strong><?php eecho($P['CNAME']); ?></span>
						</div>
					</div>
				</div>
			<?php if( $P['TAGS']!=='' )
			{	?>
				<div class="tags">
					<h3>برچسب ها</h3>
					<div><ul>
						<?php
							$TAGS = explode('+', $P['TAGS']);
							foreach ($TAGS as $TAG)
							{
								echo '<a href="tags.php?N='.$TAG.'"><li>'.$TAG.'</li></a>';
							}	?>
					</ul></div>
				</div>
	<?php }

			$GET_CMNT = $SQL->query("SELECT C.ID AS CID,C.SENDER,C.NAME,C.WEB,C.TXT,C.TIME,U.ID AS UID,U.NAME AS UNAME,U.WEB AS UWEB FROM COMMENTS AS C, USERS AS U WHERE C.SENDER=U.ID AND C.TYPE=1 AND C.POST='".$POSTID."';");

			if( $GET_CMNT!==FALSE AND $GET_CMNT->num_rows>0 ){	?>
				<div class="comments">
					<h3>دیدگاه ها</h3>
					<div>
						<?php while ( $CM=$GET_CMNT->fetch_assoc() ){
							if( $CM['SENDER']!=='0' ){
								$CM['NAME'] = $CM['UNAME'];
								$CM['WEB'] = $CM['UWEB'];
							} ?>
						<div class="cmt" id="cmt<?php echo $CM['CID']; ?>">
							<div>
								<span><?php echo mds_date("l  j F Y",$CM['TIME']); ?></span>
								<?php
									$cmtname = '<strong>'.htmlentities($CM['NAME']).'</strong>';
									if( !empty($CM['WEB']) )
										$cmtname = '<a href="'.$CM['WEB'].'" target="_blank" rel="nofollow">'.$cmtname.'</a>';
									echo $cmtname;
								?>
							</div>
							<div><?php eecho($CM['TXT']); ?></div>
						</div>
						<?php } ?>
					</div>
				</div>
	<?php } ?>

				<div class="sendcmt">
					<h3>ارسال دیدگاه</h3>
					<div>
						<div>
							<label>نام :</label>
							<input id="name" type="text" placeholder="نام شما" value="" />
						</div>
						<div>
							<label>ایمیل :</label>
							<input id="email" type="text" placeholder="mail@gmail.com" value="" />
						</div>
						<div>
							<label>آدرس وبسایت :</label>
							<input id="website" type="text" placeholder="address.com" value="" />
						</div>
						<div>
							<label>متن دیدگاه :</label>
							<textarea id="comment_text" placeholder="دیدگاه تان را بنویسید..."></textarea>
						</div>
						<div><button>ارسال دیدگاه</button></div>
					</div>
				</div>
			</div>
		<?php
		}
		else
		{
			echo '<h3 class="ntfnd">محتوایی برای نمایش پیدا نشد...</h3>';
		}
	}


	if( !isset($_POST['A']) )
		require_once('footer.php');
?>
