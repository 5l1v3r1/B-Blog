$(document).ready(function()
{
	defaultHTML = $('.main').html();

	linkajax('body');

	$( document ).ajaxError(function(){
			alert('خطایی رخ داده است. ممکن است با بارگذاری دوباره صفحه مشکل حل شود.');
	});

	window.onpopstate = function(e){
	    if(e.state!=null){
	        $('.main').html(e.state.html);
	    }
		 else {
		 	$('.main').html(defaultHTML);
		 }
	};

});


function linkajax(slct='.main')
{
	$(slct+' a:not([na])').click(function(e){
		e.preventDefault();

		$.post($(this)[0].href,{A:'A'})
			.success(function( event, xhr, settings ){
				window.history.pushState({"html":xhr.responseText,"pageTitle":document.title},null, settings.url);
				$('.main').html(xhr.responseText);
				linkajax();
			})
			.error(function(){

			});
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
			console.log(d);
		});
	})
}
