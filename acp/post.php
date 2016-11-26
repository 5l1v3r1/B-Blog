<?php
	require_once('../includes/functions.php');
	checkadmin();

	if( !isset($_POST['A']) )
		require_once('header.php');
/////////////////////////////////
	if( isset($_GET['ID']) AND (int)$_GET['ID']>0 ){
		$POSTS = $SQL->query("SELECT ID,TITLE,STEXT,FTEXT,CAT,TAGS FROM POSTS WHERE ID='".scape($_GET['ID'])."';");
		if( $POSTS!==FALSE )
			if( $POSTS->num_rows==1 )
				$POST = $POSTS->fetch_assoc();
	}

	if( isset($POST) )
		$TITLE = "ویرایش مطلب";
	else
		$TITLE = "ارسال مطلب جدید";
?>

	<div class="form">
		<h3><?php echo $TITLE ?></h3>
		<div> <input id="title" name="title" type="text" value="<?php echo eecho(@$POST['TITLE']); ?>" placeholder="عنوان مطلب" /> </div>
		<div> <textarea id="text" name="text" placeholder="متن را اینجا وارد کنید...
!!---!!
ادامه مطلب"><?php if(isset($POST[STEXT])){echo eecho($POST['STEXT']."\n!!---!!\n".$POST['FTEXT']);} ?></textarea></div>
		<div class="tip">برای ادامه مطلب از <span class="code">!!---!!</span> استفاده کنید.</div>
		<div> <input id="tags" name="tags" type="text" value="<?php echo eecho(@$POST['TAGS']); ?>" placeholder="برچسب ها را با + جدا کنید..." /> </div>


		<div></div>
		<h4>انتحاب دسته</h4>
			<select id="cat" name="cat">
<?php
	$CATS = $SQL->query("SELECT ID,NAME FROM CATS;");

	if ( $CATS!==false AND $CATS->num_rows>0 )
	{
		while ( $CAT = $CATS->fetch_assoc() ) {
			echo '<option value="'.$CAT[ID].'"'.( (@$POST['CAT']==$CAT[ID])?' selected="selected"':'' ).'>'.$CAT['NAME'].'</option>';
		}
	}

 ?>

			</select>
		<div></div>

		<button onclick="">انتشار</button>
		<button class="none" onclick="">ذخیره پیشنویس</button>
	</div>




<?php
////////////////////////////////
	if( !isset($_POST['A']) )
		require_once('footer.php');
 ?>
