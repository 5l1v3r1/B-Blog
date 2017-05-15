<?php
	/**
	*	Edit/New post
	*	@param @$_GET['DLT']		Delete category
	*	@param $_GET['ID']		category id {-1=New / -1<edit}
	*	@param $_GET['name']		category name
	*	return values
	*	@return	0	invalid data
	*	@return	1	category not exist
	*	@return	2	name len error
	*	@return	200	Data saved
	*	@return	201	category Deleted
	*	@return	-1		INTERNAL ERROR
	*/

	require_once('../includes/functions.php');
	checkadmin();

	if( !isset($_POST['A']) AND !isset($_GET['A']) )
		require_once('header.php');
/////////////////////////////////
	$CATID = -1;
	$TITLE = 'افزودن دسته جدید';

	if( isset($_GET['ID']) AND (int)$_GET['ID']>=0 )
	{
		$CATS = $SQL->query("SELECT ID,NAME FROM CATS WHERE ID='".scape($_GET['ID'])."';");
		if( $CATS!==FALSE )
		{
			if( $CATS->num_rows==1 ){
				$CAT = $CATS->fetch_assoc();
				$CATID = $CAT['ID'];
				$TITLE = "ویرایش دسته";
			}
		}
	}


	// Delete post
	if( isset($_GET['DLT']) )
	{
		if( $CATID>0 )
		{
			$deletecat = $SQL->query("DELETE FROM CATS WHERE ID='".scape($CATID)."';");
			if( $deletecat!==FALSE AND $SQL->affected_rows>0 )
				die('201');	// Successfull Deleted
			else
				die('-1');
		}
		else
			die('1');
	}


	if( isset($_GET['name']) ) // if form submited
	{
		$name = $_GET['name'];

		// cat not exist
		if( (int)$_GET['ID']>=0 AND $CATID==-1)
			die('1');

		// name len error
		if( !strlenchk($name,1,30) )
			die('2');


		if($CATID==-1){
			$MCAT = $SQL->query("INSERT INTO CATS (NAME) VALUES ('".scape($name)."');");
		}else{
			$MCAT = $SQL->query("UPDATE CATS SET NAME='".scape($name)."' WHERE ID='".scape($CATID)."';");
		}

		if( $MCAT!==FALSE )
			die('200');	// OK, Saved
		else
			die('-1');	// Internal error
	}

?>

<div class="form">
	<input id="catid" name="catid" type="hidden" value="<?php echo $CATID; ?>" />
	<h3><?php echo $TITLE ?></h3>
	<div> <input id="name" name="name" type="text" value="<?php eecho(@$CAT['NAME']); ?>" placeholder="نام دسته" /> </div>

	<button class="fa-send" onclick="mod_cat();">ذخیره</button>
	<?php if($CATID>0){ ?><button class="fa-trash red" onclick="dltcat(<?php echo $CATID; ?>);">حذف</button><?php } ?>
</div>

<?php
////////////////////////////////
	if( !isset($_POST['A']) AND !isset($_GET['A']) )
		require_once('footer.php');
 ?>
