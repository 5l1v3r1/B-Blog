<!DOCTYPE html>
<html dir="{S_CONTENT_DIRECTION}" lang="{S_USER_LANG}">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="initial-scale=1, width=device-width, height=device-height" />
	<title><?php echo $CONF['SITE_TITLE']; ?></title>
	<link rel="stylesheet" type="text/css" href="lib/main.css" />
	<script type="text/javascript" src="lib/jquery.min.js"></script>
	<script type="text/javascript" src="lib/main.js"></script>
</head>
<body>
	<div class="loading" style="display:none;"></div>
	<div class="nav">
		<ul>
			<a href="index.php"><li>صفحه اصلی</li></a>
			<a href="cats.php"><li>موضوعات</li></a>
			<a href="posts.php?N=about"><li>درباره</li></a>
			<a href="posts.php?N=contact"><li>ارتباط</li></a>
			<?php if( logedin() ){ ?>
				<a href=""><li></li></a>
			<?php }else{ ?>
				<a href=""><li></li></a>
				<a href=""><li></li></a>
			<?php } ?>
		</ul>
	</div>
	<div class="header"><span><?php echo $CONF['SITE_TITLE']; ?></span></div>
	<div class="toptext"><span>سخن بزرگان : </span><?php get_text(); ?></div>

	<div class="body">
		<div class="menu">

			<?php if( !logedin() ){ ?><div class="logreg">
				<h3>ورود / عضویت</h3>
				<div>
					<input id="user" type="text" value="" placeholder="نام کاربری" />
					<input id="pass" type="password" value="" placeholder="گذرواژه" />
					<button id="login">ورود</button>
					<a href="register.php"><button id="login">عضو نیستم</button></a>
				</div>
			</div><?php } ?>

			<div class="cats">
				<h3>موضوعات</h3>
				<ul>
					<?php
						$CATS = $SQL->query('SELECT ID,NAME FROM CATS;');

						while ($CAT=$CATS->fetch_assoc() )
						{
							echo '<a href="cat.php?ID='.$CAT['ID'].'"><li>'.$CAT['NAME'].'</li></a>'.PHP_EOL;
						}
					 ?>
				</ul>
			</div>
		</div>

		<div class="main">
