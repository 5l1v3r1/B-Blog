<?php
	require_once('../includes/functions.php');
	checkadmin();

	if( !isset($_POST['A']) AND !isset($_GET['A']) )
		require_once('header.php');
/////////////////////////////////
	$POSTS = $SQL->query("SELECT C.ID,C.NAME,COUNT(P.ID) AS CNT FROM CATS AS C LEFT JOIN POSTS AS P ON C.ID=P.CAT GROUP BY C.ID");

	if( $POSTS!==FALSE )
	{
		echo '<div class="table"><h3>'.$TITLE.'</h3>';

		if ( $POSTS->num_rows>0 )
		{
			echo '<table>
					<tr>
						<th width="10%">#</th>
						<th width="50%">نام دسته</th>
						<th width="10%">تعداد مطالب</th>
						<th width="30%">عملیات</th>
					</tr>';

			while ( $POST = $POSTS->fetch_assoc() )
			{
				ECHO '<tr>
							<td>'.$POST['ID'].'</td>
							<td>
								<span>'.$POST['NAME'].'</span
							</td>
							<td>'.$POST['CNT'].'</td>
							<td>
							<span class="hover">
								<a class="fa-eye" href="../index.php?CAT='.$POST['ID'].'" na target="_blank"></a>
								<a class="fa-pencil" href=""></a>
								<a class="fa-trash" onclick="" na></a>
							</span></td>
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
