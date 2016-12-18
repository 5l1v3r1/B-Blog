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
			get_text();
			linkajax();
		})
	};

});

function get_text(){
	$.get('get_text.php?A').success(function(d){
		$('.toptext>span').html(d);
	});
}

function linkajax(slct='.main')
{
	$(slct+' a:not([na])').click(function(e){
		e.preventDefault();

		$.post($(this)[0].href,{A:'A'})
			.success(function(rspns){
				window.history.pushState({'url':this.url},null,this.url);
				$('.main').html(rspns);
				get_text();
				linkajax();
			})
	});
}

function login(){
	var user = $('.logreg #user').val();
	var pass = $('.logreg #pass').val();

	$.post('login.php',{USER:user,PASS:pass})
		.success(function(d){
			switch (d) {
				case '200':
					$.get(window.location.href).success(function(d){
						$('body').html( d.split('<body>')[1].split('</body')[0] );
						linkajax('body');
					});
					break;
				case '2':
					alert('نام کاربری یا گذرواژه نادرست است');
					break;
				default:
					alert('مشکلی پیش آمده');
			}
		});
}

function logout(){
	$.get('login.php?OUT').success(function(){
		$.get(window.location.href).success(function(d){
			$('body').html( d.split('<body>')[1].split('</body')[0] );
			linkajax('body');
		});
	})
}
