<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="initial-scale=1, width=device-width, height=device-height" />
	<title><?php echo $CONF['SITE_TITLE']; ?></title>
	<link rel="stylesheet" type="text/css" href="lib/main.css" />
	<link rel="stylesheet" type="text/css" href="lib/font-awesome.css" />
	<script type="text/javascript" src="lib/jquery.min.js"></script>
	<script type="text/javascript" src="lib/main.js"></script>
</head>
<body>
	<div class="nav">
		<ul>
			<a href="index.php"><li class="fa-home">صفحه اصلی</li></a>
			<a href="cats.php"><li class="fa-list">دسته ها</li></a>
			<a href="posts.php?N=about"><li class="fa-info">درباره</li></a>
			<a href="posts.php?N=contact"><li class="fa-envelope">ارتباط</li></a>
			<?php if( logedin() ){ ?><a href="" na onClick="logout();return false;"><li class="left fa-sign-out">خروج</li></a><?php } ?>
			<?php if( isadmin() ){ ?><a href="acp/" na class="hover"><li class="left fa-database">پنل مدیریت</li></a><?php } ?>
		</ul>
	</div>
	<div class="header"><span><?php echo $CONF['SITE_TITLE']; ?></span></div>
	<div class="toptext"><strong>سخن بزرگان : </strong><span><?php get_text(); ?></span></div>

	<div class="body">
		<div class="menu">

			<div class="cats">
				<h3>موضوعات</h3>
				<ul>
					<?php
						$CATS = $SQL->query('SELECT ID,NAME FROM CATS;');

						while ($CAT=$CATS->fetch_assoc() )
						{
							echo '<a href="index.php?CAT='.$CAT['ID'].'"><li>'.$CAT['NAME'].'</li></a>'.PHP_EOL;
						}
					 ?>
				</ul>
			</div>

			<?php if( !logedin() ){ ?>
			<div class="logreg">
				<h3>ورود / عضویت</h3>
				<div>
					<input id="user" type="text" placeholder="نام کاربری" />
					<input id="pass" type="password" placeholder="گذرواژه" />
					<button id="login" onclick="login();">ورود</button>
					<a href="register.php"><button id="login">عضو نیستم</button></a>
				</div>
			</div>	<?php } ?>

			<div class="adv">
				<h3>تبلیغات</h3>
				<div>
					<img src="lib/adv1.gif" />
					<img src="lib/adv2.gif" />
				</div>
			</div>
		</div>

		<div class="main">
