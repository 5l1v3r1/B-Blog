<?php
	require_once('includes/functions.php');

	if( !isset($_POST['A']) AND !isset($_GET['A']) )
		require_once('header.php');


	if( isset($_GET['id']) OR isset($_GET['p']) )
	{
		if( isset($_GET['p']) AND strlen($_GET['p'])>0 )
			$WHERE = "P.URL='".scape( substr($_GET['p'],0,255) )."'";
		elseif( (int)$_GET['id']>0 )
			$WHERE = "P.ID='".scape( (int)$_GET['id'] )."'";
		else
			$WHERE = "p.ID='0'";

		$GET_POST = $SQL->query("SELECT P.ID AS PID,P.TITLE,P.STEXT,P.FTEXT,P.TIME,P.TAGS,U.ID AS UID,U.USER,U.NAME AS AUTHOR,C.ID AS CID,C.NAME AS CNAME FROM POSTS AS P, USERS AS U, CATS AS C WHERE P.AUTHOR=U.ID AND P.CAT=C.ID AND P.TYPE=1 AND ".$WHERE);

		if( $GET_POST!==FALSE AND $GET_POST->num_rows==1 )
		{
			$POST = $GET_POST->fetch_assoc();
		?>
			<div class="singlepost">
				<div class="post">
					<h3><?php eecho($POST['TITLE']); ?></h3>
					<p class="post-text"><?php eecho($POST['STEXT']); ?></p>
					<p class="post-text"><?php eecho($POST['FTEXT']); ?></p>
					<div class="postfooter">
						<span class="fa-calendar"><strong>تاریخ ارسال : </strong><?php echo mds_date("l  j F Y",$POST['TIME']); ?></span>
						<span class="fa-user"><strong>نویسنده : </strong><?php eecho($POST['AUTHOR']); ?></span>
						<span class="fa-list"><strong>دسته : </strong><a href="index.php?CAT=<?php echo $POST['CID']; ?>"><?php eecho($POST['CNAME']); ?></a></span>
						<?php if(isadmin()){ echo '<a na href="acp/post.php?ID='.$POST['PID'].'"><span class="fa-pencil">ویرایش مطلب</span></a>'; } ?>
					</div>
				</div>

			<?php if( $POST['TAGS']!=='' )
			{	?>
				<div class="tags">
					<h3 class="fa-hashtag">برچسب ها</h3>
					<div><ul>
						<?php
							$TAGS = explode('+', $POST['TAGS']);
							foreach ($TAGS as $TAG)
							{
								echo '<a href="index.php?tag='.$TAG.'"><li>'.$TAG.'</li></a>';
							}	?>
					</ul></div>
				</div>
	<?php }

			$GET_CMNT = $SQL->query("SELECT C.ID AS CID,C.SENDER,C.NAME,C.WEB,C.TXT,C.TIME,U.ID AS UID,U.NAME AS UNAME,U.WEB AS UWEB FROM COMMENTS AS C, USERS AS U WHERE C.SENDER=U.ID AND C.TYPE=1 AND C.POST='".$POST['PID']."';");

			if( $GET_CMNT!==FALSE AND $GET_CMNT->num_rows>0 ){	?>
				<div class="comments">
					<h3 class="fa-comments">دیدگاه ها</h3>
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
										$cmtname = '<a href="'.$CM['WEB'].'" na target="_blank" rel="nofollow">'.$cmtname.'</a>';
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
					<h3 class="fa-paper-plane">ارسال دیدگاه</h3>
					<div>
						<div<?php echo (logedin())?' style="display:none"':''; ?>>
							<label>نام :</label>
							<input id="name" type="text" placeholder="نام شما" value="" />
						</div>
						<div<?php echo (logedin())?' style="display:none"':''; ?>>
							<label>ایمیل :</label>
							<input id="email" type="text" placeholder="mail@gmail.com" value="" />
						</div>
						<div<?php echo (logedin())?' style="display:none"':''; ?>>
							<label>آدرس وبسایت :</label>
							<input id="website" type="text" placeholder="http://address.com" value="" />
						</div>
						<div>
							<label>متن دیدگاه :</label>
							<textarea id="comment_text" placeholder="دیدگاه تان را بنویسید..."></textarea>
						</div>
						<div><button class="fa-paper-plane" onclick="sendcmt(<?php echo $POST['PID']; ?>);">ارسال دیدگاه</button></div>
					</div>
				</div>
			</div>
		<?php
		}
		else
		{
			echo '<h3 class="ntfnd">محتوایی برای نمایش پیدا نشد...</h3>';
		}
	} ?>

<?php	if( !isset($_POST['A']) AND !isset($_GET['A']) )
		require_once('footer.php');
?>
