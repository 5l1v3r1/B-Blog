<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="initial-scale=1, width=device-width, height=device-height" />
	<title><?php echo $CONF['SITE_TITLE']; ?></title>
	<link rel="stylesheet" type="text/css" href="lib/main.css" />
	<script type="text/javascript" src="lib/jquery.min.js"></script>
	<script type="text/javascript" src="lib/main.js"></script>
</head>
<body>
	<ul class="top-nav">
		<li>| | |</li>
		<a href="index.php"><li>صفحه اصلی</li></a>
		<a href="posts.php"><li>مطالب</li></a>
		<a href="categories.php"><li>موضوعات</li></a>
		<a href="comments.php"><li>دیدگاه ها</li></a>
		<a href="users.php"><li>کاربران</li></a>
		<a href="settings.php"><li>تنظیمات</li></a>
	</ul>

	<div class="side">
		<span>مطالب</span>
		<ul>
			<a href="posts.php?Q=all"><li>لیست مطالب</li></a>
			<a href="posts_new.php"><li>ارسال مطلب جدید</li></a>
			<a href="posts.php?Q=published"><li>مطالب منتشر شده</li></a>
			<a href="posts.php?Q=wait"><li>در انتظار تائید</li></a>
			<a href="posts.php?Q=rejected"><li>مطالب رد شده</li></a>
			<a href="posts_drafts.php"><li>پیشنویس ها</li></a>
		</ul>
		<span>موضوعات</span>
		<ul>
			<a href="categories.php"><li>لیست موضوعات</li></a>
			<a href="categories_new.php"><li>موضوع جدید</li></a>
		</ul>
		<span>دیدگاه ها</span>
		<ul>
			<a href="comments.php"><li>لیست کامل</li></a>
			<a href="comments_accepted.php"><li>تائید شده</li></a>
			<a href="comments_wait.php"><li>در انتظار تائید</li></a>
			<a href="comments_rejected.php"><li>دیدگاه های رد شده</li></a>
		</ul>
		<span>کاربران</span>
		<ul>
			<a href="users.php"><li>لیست کاربران</li></a>
			<a href="users_new.php"><li>کاربر جدید</li></a>
			<a href=""><li>نوسندگان</li></a>
		</ul>
		<span>بیشتر</span>
		<ul>
			<a href=""><li>برچسب ها</li></a>
			<a href=""><li></li></a>
			<a href=""><li></li></a>
			<a href=""><li></li></a>
			<a href=""><li></li></a>
		</ul>
	</div>


	<div class="main">
