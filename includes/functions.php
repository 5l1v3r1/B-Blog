<?php
	$CONF = array(
		'SITE_TITLE'	=>	'عنوان وبلاگ',
	);



	// Connection Variable
	$SQL = new mysqli("localhost","root","128a9390","blog");

	if ( mysqli_connect_errno() ) {
		log_error('!!!!--MYSQL ERROR: CONNECTION GOT ERROR='.mysqli_connect_error(),0);
		exit();
	}// Setting
	$SQL->set_charset("utf8");
	date_default_timezone_set('Asia/Tehran');



//	mysql_real_escape_string
	function scape($STR)
	{
		global $SQL;
		return $SQL->real_escape_string($STR);
	}


	function logedin(){
		if( ISSET($_SESSION['UID']) )
			return true;
		return false;
	}

	function get_text(){
		$text = array(
			'بهتر است روی پای خود بمیری تا روی زانو‌هایت زندگی کنی. (رودی)',
			'بر روی زمین چیزی بزرگتر از انسان نیست و در انسان چیزی بزرگتر از فکر او. (همیلتون)',
			'عمر آنقدر کوتاه است که نمی‌ارزد آدم حقیر و کوچک بماند. (دیزرائیلی)',
			'افراد شجاع فرصت می آفرینند .ترسوها و ضعفا منتظر فرصت می نشینند.(گوته)',
			'هر انسانی مرتکب اشتباه می شود ؛اما فقط انسان های احمق اشتباه خود را تکرار می کنند.(سیسرون)',
			'اگر در قدم اول موفقیت نصیب ما می شد، سعی و عمل دیگر معنایی نداشت.(موریس مترلینگ)',
			'کسی که شهامت قبول خطر را نداشته باشد، در زندگی به مقصود نخواهد رسید. (محمد علی كلی)',
			' آدمی ساخته‌ی افکار خویش است فردا همان خواهد شد که امروز می‌اندیشیده است. (مترلینگ)',
			'انسان همان چیزی است که باور دارد. (آنتوان چخوف)'
		);

		echo $text[ rand(0,8) ];
	}

 ?>
