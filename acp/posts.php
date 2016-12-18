<?php
	require_once('../includes/functions.php');
	checkadmin();

	if( !isset($_POST['A']) AND !isset($_GET['A']) )
		require_once('header.php');
/////////////////////////////////
	$TYP = Array(
		'رد شده',
		'منتشر شده',
		'در انتظار تائید',
		'پیش نویس');

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

	$POSTS = $SQL->query("SELECT P.ID AS PID,P.TYPE,P.TITLE,P.STEXT,P.TIME,U.NAME AS AUTHOR,C.NAME AS CAT FROM POSTS AS P, USERS AS U, CATS AS C WHERE P.AUTHOR=U.ID AND P.CAT=C.ID".scape($TYPE));

	if( $POSTS!==FALSE )
	{
		echo '<div class="table"><h3>'.$TITLE.'</h3>';

		if ( $POSTS->num_rows>0 )
		{
			echo '<table>
					<tr>
						<th width="5%">#</th>
						<th width="30%">عنوان</th>
						<th width="15%">نویسنده</th>
						<th width="15%">دسته</th>
						<th width="15%">تاریخ</th>
						<th width="20%">عملیات</th>
					</tr>';

			while ( $POST = $POSTS->fetch_assoc() )
			{
				ECHO '<tr>
							<td>'.$POST['PID'].'</td>
							<td>
								<span>'.$POST['TITLE'].'</span>
							</td>
							<td>'.$POST['AUTHOR'].'</td>
							<td>'.$POST['CAT'].'</td>
							<td>
								<span>'.$TYP[$POST['TYPE']].'</span>
								<span>'.mds_date("j/F/Y",$POST['TIME']).'</span>
							</td>
							<td>
								<span class="hover">
									<a class="fa-eye" href="../post.php?id='.$POST['PID'].'" na target="_blank"></a>
									<a class="fa-pencil" href="post.php?ID='.$POST['PID'].'"></a>
									<a class="fa-trash" onclick="dltpost('.$POST['PID'].');" na></a>
								</span>
							</td>
						</tr>';
			}
			echo "</table>";
		}
		else {
			echo '<span>موردی برای نمایش یافت نشد.</span>';
		}

		echo '</div>';
	}
	else
	{
		die("خطایی رخ داده است...");
	}
////////////////////////////////
	if( !isset($_POST['A']) AND !isset($_GET['A']) )
		require_once('footer.php');
 ?>
