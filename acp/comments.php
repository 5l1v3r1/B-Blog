<?php
	require_once('../includes/functions.php');
	checkadmin();

	if( !isset($_POST['A']) AND !isset($_GET['A']) )
		require_once('header.php');
/////////////////////////////////
	$TYP = Array(
		'رد شده',
		'تایید شده',
		'در انتظار تائید');

	if ( isset($_GET['Q']) )
	{
		switch ($_GET['Q']) {
			case 'rejected':
			$TYPE = ' AND C.TYPE=0 ';
			$TITLE = 'دیدگاه های رد شده';
			break;
			case 'accepted':
				$TYPE = ' AND C.TYPE=1 ';
				$TITLE = 'دیدگاه های تایید شده';
				break;
			case 'wait':
				$TYPE = ' AND C.TYPE=2 ';
				$TITLE = 'دیدگاه های در انتظار تایید';
				break;
			default:
				$TYPE = '';
				$TITLE = 'همه دیدگاه ها';
				break;
		}
	}
	else
	{
		$TYPE = '';
		$TITLE = 'همه دیدگاه ها';
	}

	$COMMENTS = $SQL->query("SELECT C.ID,C.TYPE,C.SENDER,C.POST,C.NAME,C.EMAIL,C.TXT,C.TIME,U.NAME as UNAME,P.TITLE FROM COMMENTS AS C, USERS AS U, POSTS AS P WHERE C.SENDER=U.ID AND C.POST=P.ID".scape($TYPE));

	if( $COMMENTS!==FALSE )
	{
		echo '<div class="table"><h3>'.$TITLE.'</h3>';

		if ( $COMMENTS->num_rows>0 )
		{
			echo '<table>
					<tr>
						<th width="15%">فرستنده</th>
						<th width="15%">مطلب</th>
						<th width="35%">دیدگاه</th>
						<th width="15%">تاریخ</th>
						<th width="20%">عملیات</th>
					</tr>';

			while ( $COMMENT = $COMMENTS->fetch_assoc() )
			{
				ECHO '<tr>
							<td>';
								if( $COMMENT['SENDER']==0 )
									echo '<span>'.$COMMENT['NAME'].'<br />'.$COMMENT['EMAIL'].'</span>';
								else
									echo '<a href="user.php?ID='.$COMMENT['SENDER'].'"><span>'.$COMMENT['UNAME'].'</span></a>';
				ECHO		'</td>
							<td><a href="../post.php?id='.$COMMENT['POST'].'" na target="_blank">'.$COMMENT['TITLE'].'</a></td>
							<td><span class="comment-text">'.htmlentities($COMMENT['TXT']).'</span></td>
							<td>
								<span>'.$TYP[$COMMENT['TYPE']].'</span>
								<span>'.mds_date("j/F/Y",$COMMENT['TIME']).'</span>
							</td>
							<td>'.
								( ($COMMENT['TYPE']==2) ? '<span class="hover"><a class="fa-check accept" href="../post.php?id='.$COMMENT['POST'].'" na target="_blank"></a></span>' : '' )
								.'<span class="hover">
									<a class="fa-eye" '.( ($COMMENT['TYPE']!=1) ? 'style="display:none"' : '' ).' href="../post.php?id='.$COMMENT['POST'].'" na target="_blank"></a>
									<a class="fa-pencil" href="comment.php?ID='.$COMMENT['ID'].'"></a>
									<a class="fa-trash" onclick="dltcomment('.$COMMENT['ID'].');" na></a>
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
