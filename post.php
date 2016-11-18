<?php
	require_once('includes/functions.php');

	if( !isset($_POST['A']) )
		require_once('header.php');


	if( isset($_GET['id']) && (int)$_GET['id']>0 )
	{
		$GET_POST = $SQL->query("SELECT P.ID,P.TITLE,P.STEXT,P.FTEXT,P.TIME,P.TAGS,U.USER,U.NAME,C.ID,C.NAME FROM POSTS AS P, USERS AS U, CATS AS C WHERE P.POSTER=U.ID AND P.CAT=C.ID AND P.ID=".scape($_GET['id']).";");

		if( $GET_POST!==FALSE AND $GET_POST->num_rows==1 )
		{
			$P = $GET_POST->fetch_assoc();
		?>
			<div class="singlepost">
				<div class="postsec">
					<h3><?php eecho($P['TITLE']); ?></h3>
					<div><p class="post-text"><?php eecho($P['STEXT']); ?></p></div>
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
	<?php } ?>

				<div class="comments">
					<h3>دیدگاه ها</h3>
					<div>
							<div class="cmt" id="cmt">
								<div>
									<span>تاریخ ارسال</span>
									<strong>نام کاربر</strong>
								</div>
								<div>
									متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود
								</div>
							</div>
							<div class="cmt" id="cmt">
								<div>
									<span>تاریخ ارسال</span>
									<strong>نام کاربر</strong>
								</div>
								<div>
									متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود
								</div>
							</div>
							<div class="cmt" id="cmt">
								<div>
									<span>تاریخ ارسال</span>
									<strong>نام کاربر</strong>
								</div>
								<div>
									متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود
								</div>
							</div>
							<div class="cmt" id="cmt">
								<div>
									<span>تاریخ ارسال</span>
									<strong>نام کاربر</strong>
								</div>
								<div>
									متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود متن دیدگاه اینجا نمایان میشود
								</div>
							</div>
					</div>
				</div>

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
	}


	if( !isset($_POST['A']) )
		require_once('footer.php');
?>
