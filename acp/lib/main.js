var tipid = 1;

$(document).ready(function()
{
	defaultURL = window.location.href;
	menuselect(defaultURL);
	linkajax('body');

	$( document )
		.ajaxError(function(){
			tip('خطایی رخ داده است. ممکن است با بارگذاری دوباره صفحه مشکل حل شود.');
		})
		.ajaxSuccess(function(event, xhr, settings){
			if( xhr.responseText=='403' )
				tip('نشست فعلی شما منقظی شده است. لطفا در صفحه‌ی باز شده دوباره وارد حساب کاربری خود شوید و سپس دوباره امتحان کنید.');
			else if( xhr.responseText=='-1' )
				tip('خطای داخلی سمت سرور رخ داده است');
			else
				menuselect(event.target.URL);
		});

	window.onpopstate = function(e){
		if(e.state!=null)
			var url = e.state.url;
		else
			var url = defaultURL;

		$.post(url,{A:'A'}).done(function(d){
			$('.main').html(d);
			linkajax();
		})
	};

	$('.side span').click(function(){
		var now = $(this);
		var ifst = now.hasClass('hover');
		var old = $('.side span.hover');

		old.removeClass('hover')
		.next('ul').animate({height: "hide"}, 500,function(){
			$(this).removeClass('show');
		});

		if( ifst )
			return;

		now.addClass('hover')
		.next('ul').animate({height: "show"}, 500,function(){
			$(this).addClass('show');
		});
	});
});

function menuselect(url)
{
	$(".side a.active").removeClass('active');
	var splturl = url.split('/');
	var filename = splturl[splturl.length-1];
	$(".side a[href*='"+filename+"']:first").addClass('active')
		.parent('ul').animate({height: 'show'},500,function(){
				$(this).addClass('show');
			})
		.prev('span').addClass('hover');
}

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
		.done(function(rspns){
			window.history.pushState({'url':dir+url},null,dir+url);
			$('.main').html(rspns);
			linkajax();
		});
}


function mod_post(type=0)
{
	var id = $('.form #postid').val();
	var title = $('.form #title').val();
	var url = $('.form #url').val();
	var text  = $('.form #text').val();
	var cat = $('.form #cat').val();
	var tags = $('.form #tags').val();

	$.post("post.php?ID="+id,{A:'A',title:title,url:url,text:text,cat:cat,tags:tags,type:type})
		.done(function(r){
			switch (r) {
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
				case '4':
					tip('عنوان و متن نمیتوانند خالی باشند.');
					break;
				case '200':
					tip('اطلاعات با موفقیت ذخیره شد.','green');
					redirect('posts.php');
					break;
			}
		});
}

function dltpost(pid){
	$.get('post.php?ID='+pid+'&DLT&A')
		.done(function(r){
			if( r=='201' )
			{
				tip('مطلب مورد نظر حذف شد.','green');
				redirect('posts.php');
			}
		});
}




function mod_cat()
{
	var id = $('.form #catid').val();
	var name = $('.form #name').val();

	$.get("category.php?ID="+id+'&name='+name+'&A')
		.done(function(r){
			switch (r) {
				case '0':
					tip('اطلاعات ارسال شده ناقص است.');
					break;
				case '1':
					tip('دسته مورد نظر پیدا نشد.');
					break;
				case '2':
					tip('تعداد کاراکتر مجاز برای نام دسته حداقل ۱ و حداکثر ۳۰ میباشد.');
					break;
				case '200':
					tip('اطلاعات با موفقیت ذخیره شد.','green');
					redirect('categories.php');
					break;
			}
		});
}


function dltcat(catid){
	$.get('category.php?ID='+catid+'&DLT&A')
		.done(function(r){
			if( r=='201' )
			{
				tip('دسته مورد نظر حذف شد.','green');
				redirect('categories.php');
			}
		});
}

function tip(text='',cls="red")
{
	var t = ++tipid;

	$('.tips').append('<div class="'+cls+'" id="tip'+t+'">'+text+'<span class="fa-close" onclick="$(this).parent(\'div\').removeClass(\'tip\');"></span></div>');
	setTimeout(function(){
		$('.tips > div#tip'+t).addClass('tip');
			setTimeout(function(){
				$('.tips > div#tip'+t).removeClass('tip');
			},5500);
		},100);

	setTimeout(function(){
		$('.tips > div#tip'+t).remove();
	},7000)
}


function logout(){
	$.get('../login.php?OUT').done(function(){
		window.location = '../';
	});
}
