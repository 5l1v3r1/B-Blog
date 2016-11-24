<?php
	require_once('../includes/functions.php');
	checkadmin();

	if( !isset($_POST['A']) )
		require_once('header.php');
/////////////////////////////////

	if ( isset($_GET['Q']) )
	{
		switch ($_GET['Q']) {
			case 'rejected':
			$TYPE = ' AND TYPE=0 ';
			$TITLE = 'مطالب رد شده';
			break;
			case 'published':
				$TYPE = ' AND TYPE=1 ';
				$TITLE = 'مطالب منتشر شده';
				break;
			case 'wait':
				$TYPE = ' AND TYPE=2 ';
				$TITLE = 'مطالب در انتظار تائید';
				break;
			case 'draft':
				$TYPE = ' AND TYPE=3 ';
				$TITLE = 'پیش نویس ها';
				break;
			default:
				$TYPE = '';
				$TITLE = 'همه مطالب';
				break;
		}
	}
	else
	{
		$TYPE = '';
		$TITLE = 'همه مطالب';
	}

	$POSTS = $SQL->query("SELECT P.ID AS PID,P.TITLE,P.STEXT,P.TIME,U.NAME AS AUTHOR,C.NAME AS CAT FROM POSTS AS P, USERS AS U, CATS AS C WHERE P.AUTHOR=U.ID AND P.CAT=C.ID".scape($TYPE));

	if( $POSTS!==FALSE )
	{
		echo '<div class="table"><span>'.$TITLE.'</span>';

		if ( $POSTS->num_rows>0 )
		{
			echo '<table>
					<tr>
						<th width="10%">#</th>
						<th width="20%">عنوان</th>
						<th width="20%">نویسنده</th>
						<th width="20%">دسته</th>
						<th width="20%">تاریخ</th>
						<th width="10%">عملیات</th>
					</tr>';

			while ( $POST = $POSTS->fetch_assoc() )
			{
				ECHO "<tr>
							<td>".$POST['PID']."</td>
							<td>".$POST['TITLE']."</td>
							<td>".$POST['AUTHOR']."</td>
							<td>".$POST['CAT']."</td>
							<td>".mds_date("j F Y",$P['TIME'])."</td>
							<td>+ - *</td>
						</tr>";
			}
			echo "</table>";
		}
		else {
			echo 'موردی برای نمایش یافت نشد.';
		}

		echo '</div>';
	}
	else
	{
		die("خطایی رخ داده است...");
	}
////////////////////////////////
	if( !isset($_POST['A']) )
		require_once('footer.php');
 ?>
