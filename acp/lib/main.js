var tipid = 1;

$(document).ready(function()
{
	defaultURL = window.location.href;

	linkajax('body');

	$( document ).ajaxError(function(){
			alert('خطایی رخ داده است. ممکن است با بارگذاری دوباره صفحه مشکل حل شود.');
	});

	window.onpopstate = function(e){
		if(e.state!=null)
			var url = e.state.url;
		else
			var url = defaultURL;

		$.post(url,{A:'A'}).success(function(d){
			$('.main').html(d);
			linkajax();
		})
	};

});


function linkajax(slct='.main')
{
	$(slct+' a:not([na])').click(function(e){
		e.preventDefault();
		redirect($(this).attr('href'));
	});
}

function redirect(url)
{
	var loc = window.location.origin+window.location.pathname;
	var dir = loc.substring(0, loc.lastIndexOf('/'))+'/';

	$.post(url,{A:'A'})
		.success(function(rspns){
			window.history.pushState({'url':dir+url},null,dir+url);
			$('.main').html(rspns);
			linkajax();
		});
}


function mod_post(type=0)
{
	var id = $('.form #postid').val();
	var title = $('.form #title').val();
	var text  = $('.form #text').val();
	var cat = $('.form #cat').val();
	var tags = $('.form #tags').val();

	$.post("post.php?ID="+id,{A:'A',title:title,text:text,cat:cat,tags:tags,type:type})
		.success(function(r){
			switch (r) {
				case '-1':
					tip('خطای داخلی سمت سرور رخ داده است');
					break;
				case '0':
					tip('اطلاعات ارسال شده ناقص است.');
					break;
				case '1':
					tip('مطلب مورد نظر پیدا نشد.');
					break;
				case '2':
					tip('حداکثر تعداد کاراکتر برای عنوان مطلب 255 کاراکتر می‌باشد.');
					break;
				case '3':
					tip('دسته مورد نظر پیدا نشد.');
					break;
				case '200':
					tip('اطلاعات با موفقیت ذخیره شد.');
					break;
			}
			redirect('posts.php');
		});
}

function tip(text='')
{
	$('.tips').append('<div id="'+(++tipid)+'">'+text+'</div>');
	setTimeout(function(){
		$('.tips > div#'+tipid).addClass('tip');
			setTimeout(function(){
				$('.tips > div#'+tipid).removeClass('tip');
			},5500);
		},100);
}
