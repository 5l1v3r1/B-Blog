<?php
	/**
	*	Edit/New post
	*	@param @$_GET['DLT']		Delete post
	*	@param $_GET['ID']		postid {0=New post / 0<edit post}
	*	@param $_POST['title']	post title
	*	@param $_POST['url']		post url
	*	@param $_POST['text']	post text
	*	@param $_POST['tags']	post tags
	*	@param $_POST['cat']		post categoriy id
	*	@param $_POST['type']	post type {-1=Delete / 0=draft / 1=publish}
	*	return values
	*	@return	0	invalid data
	*	@return	1	post not exist
	*	@return	2	title len error
	*	@return	3	category error
	*	@return	4	title or text are empty
	*	@return	200	Data saved
	*	@return	201	Post Deleted
	*	@return	-1		INTERNAL ERROR
	*/

	require_once('../includes/functions.php');
	checkadmin();

	if( !isset($_POST['A']) AND !isset($_GET['A']) )
		require_once('header.php');
/////////////////////////////////
	// Default new post
	$POSTID = 0;
	$TITLE = "ارسال مطلب جدید";

	if( isset($_GET['ID']) AND (int)$_GET['ID']>0 )
	{
		$POSTS = $SQL->query("SELECT ID,TITLE,URL,STEXT,FTEXT,CAT,TAGS FROM POSTS WHERE ID='".scape($_GET['ID'])."';");
		if( $POSTS!==FALSE )
		{
			if( $POSTS->num_rows==1 ){
				$POST = $POSTS->fetch_assoc();
				$POSTID = $POST['ID'];
				$TITLE = "ویرایش مطلب";
			}
		}
	}

	// Delete post
	if( isset($_GET['DLT']) )
	{
		if( $POSTID>0 )
		{
			$deletepost = $SQL->query("DELETE FROM POSTS WHERE POSTS.ID='".scape($POSTID)."';");
			if( $deletepost!==FALSE AND $SQL->affected_rows>0 )
				die('201');	// Successfull Deleted
			else
				die('-1');
		}
		else
			die('1');
	}

	if( isset($_POST['title']) ) // if form submited
	{
		if( isset($_POST['title'], $_POST['text'], $_POST['tags'], $_POST['cat'], $_POST['type']) )
		{
			$title = $_POST['title'];
			$url = $_POST['url'];
			$text = explode("!!---!!",$_POST['text'],2);
			$cat = (int)$_POST['cat'];
			$tags = trim($_POST['tags']);
			$type = ( (int)$_POST['type']==1 ) ? 1 : 3;

			// Post not exist
			if( (int)$_GET['ID']>0 AND $POSTID==0)
				die('1');

			// title is long
			if( strlen($title)>255 )
				die('2');

			// write title AND text
			if( trim($title)=='' OR trim($_POST['text'])=='' )
				die('4');

			if( $cat>0 )
			{
				$chkcatid = $SQL->query("SELECT ID FROM CATS WHERE ID='".scape($cat)."'");
				if( $chkcatid->num_rows!==1 )
					die('3');	// category not exist
			}

			if($POSTID==0){
				$MPOST = $SQL->query("INSERT INTO POSTS (TYPE,AUTHOR,TITLE,URL,STEXT,FTEXT,CAT,TAGS,TIME) VALUES ('".$type."',".$_SESSION['ID'].",'".scape($title)."','".scape($url)."','".scape($text[0])."','".scape(@$text[1])."','".scape($cat)."','".scape($tags)."','".time()."');");
			}else{
				$MPOST = $SQL->query("UPDATE POSTS SET TYPE='".$type."', TITLE='".scape($title)."', URL='".scape($url)."', STEXT='".scape($text[0])."', FTEXT='".scape($text[1])."', CAT='".scape($cat)."', TAGS='".scape($tags)."', TIME='".time()."' WHERE ID='".scape($POSTID)."';");
			}

			if( $MPOST!==FALSE AND $SQL->affected_rows>0 )
				die('200');	// OK, Saved
			else
				die('-1');	// Internal error
		}
		else
			die('0');	// Data not valid
	}

?>

	<div class="form">
		<input id="postid" name="postid" type="hidden" value="<?php echo $POSTID; ?>" />
		<h3><?php echo $TITLE ?></h3>
		<div> <input id="title" type="text" value="<?php eecho(@$POST['TITLE']); ?>" placeholder="عنوان مطلب" /> </div>

		<div> <input id="url" type="text" value="<?php eecho(@$POST['URL']); ?>" placeholder="پیوند یکتا" /> </div>
		<div class="tip" style="direction:ltr;color:#3d7ab3;"> <a id="purl" href="http://localhost/blog/post.php?p=پیوند یکتا" na target="_blank">http://localhost/blog/post.php?p=پیوند یکتا</a>  </div>

		<div> <textarea id="text" placeholder="متن را اینجا وارد کنید...
!!---!!
ادامه مطلب"><?php if(isset($POST['STEXT'])){eecho(@$POST['STEXT']."!!---!!".@$POST['FTEXT']);} ?></textarea></div>

		<div class="tip">برای ادامه مطلب از <span class="code">!!---!!</span> استفاده کنید.</div>
		<div> <input id="tags" type="text" value="<?php eecho(@$POST['TAGS']); ?>" placeholder="برچسب ها را با + جدا کنید..." /> </div>

		<div></div>
		<h4>انتحاب دسته</h4>
			<select id="cat">
				<?php
					$CATS = $SQL->query("SELECT ID,NAME FROM CATS;");

					if ( $CATS!==false AND $CATS->num_rows>0 )
					{
						while ( $CAT = $CATS->fetch_assoc() ) {
							echo '<option value="'.$CAT['ID'].'"'.( (@$POST['CAT']==$CAT['ID'])?' selected="selected"':'' ).'>'.$CAT['NAME'].'</option>';
						}
					}
				 ?>
			</select>
		<div></div>

		<button class="fa-send" onclick="mod_post(1);">انتشار</button>
		<button class="fa-thumb-tack none" onclick="mod_post(0);">ذخیره پیشنویس</button>
		<?php if($POSTID!=0){ ?><button class="fa-trash red" onclick="dltpost(<?php echo $POSTID; ?>);">حذف</button><?php } ?>
	</div>

	<script type="text/javascript">
		$('.form #url').on('keyup',function(){
			var loc = window.location.href;
			var arr = loc.split('/');
			arr.splice(arr.length-2,2);
			var url = arr.join('/') + "/post.php?p=";

			if( $('.form #url').val()=='' )
				var url = url+ 'پیوند یکتا';
			else
				var url = url+ $('.form #url').val();

			$('#purl').text( url ).attr('href',url);
			console.log(url);
		});
	</script>

<?php
////////////////////////////////
	if( !isset($_POST['A']) AND !isset($_GET['A']) )
		require_once('footer.php');
 ?>
