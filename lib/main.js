$(document).ready(function()
{
	defaultHTML = $('.main').html();

	linkajax('body');

	$( document )
		.ajaxSuccess(function( event, xhr, settings ) {
			if( settings.data!='N=N' )
				window.history.pushState({"html":xhr.responseText,"pageTitle":document.title},null, settings.url);
		})
		.ajaxError(function(){
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
			.success(function(d){
				$('.main').html( d );
				linkajax();
			})
			.error(function(){

			});
	});
}

function login(){
	var user = $('.logreg #user').val();
	var pass = $('.logreg #pass').val();

	$.post('login.php',{N:'N',USER:user,PASS:pass})
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
	$.post('login.php?OUT',{N:'N'}).success(function(){
		$.get(window.location.href).success(function(d){
			$('body').html( d.split('<body>')[1].split('</body')[0] );
			console.log(d);
		});
	})
}
