<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="initial-scale=1, width=device-width, height=device-height" />
	<title><?php echo $CONF['SITE_TITLE']; ?></title>
	<link rel="stylesheet" type="text/css" href="lib/main.css" />
	<link rel="stylesheet" type="text/css" href="../lib/font-awesome.css" />
	<script type="text/javascript" src="../lib/jquery.min.js"></script>
	<script type="text/javascript" src="../lib/jquery-ui.min.js"></script>
	<script type="text/javascript" src="lib/main.js"></script>
</head>
<body>
	<ul class="top-nav">
		<li class="fa-bars"></li>
		<a href="../" na><li class="fa-home">نمایش سایت</li></a>
		<a href="index.php"><li class="fa-tachometer">داشبورد</li></a>
		<a href="settings.php"><li class="fa-cog">تنظیمات</li></a>
		<a href="" na onClick="logout();return false;"><li style="float:left;" class="fa-sign-out">خروج</li></a>
	</ul>

	<div class="side">
		<span class="fa-book">مطالب</span>
		<ul>
			<a href="post.php"><li>ارسال مطلب جدید</li></a>
			<a href="posts.php?Q=all"><li>لیست مطالب</li></a>
			<a href="posts.php?Q=published"><li>مطالب منتشر شده</li></a>
			<a href="posts.php?Q=wait"><li>در انتظار تائید</li></a>
			<a href="posts.php?Q=rejected"><li>مطالب رد شده</li></a>
			<a href="posts.php?Q=draft"><li>پیش نویس ها</li></a>
		</ul>
		<span class="fa-list">دسته ها</span>
		<ul>
			<a href="categories.php"><li>لیست دسته ها</li></a>
			<a href="category.php"><li>افزودن دسته جدید</li></a>
		</ul>
		<span class="fa-comments">دیدگاه ها</span>
		<ul>
			<a href="comments.php"><li>همه دیدگاه ها</li></a>
			<a href="comments.php?Q=accepted"><li>تائید شده</li></a>
			<a href="comments.php?Q=wait"><li>در انتظار تائید</li></a>
			<a href="comments.php?Q=rejected"><li>دیدگاه های رد شده</li></a>
		</ul>
		<span class="fa-users">کاربران</span>
		<ul>
			<a href="users.php"><li>لیست کاربران</li></a>
			<a href="user.php"><li>کاربر جدید</li></a>
		</ul>
		<span class="fa-cog">بیشتر</span>
		<ul>
			<a href=""><li>...</li></a>
		</ul>
	</div>

	<div class="main">
