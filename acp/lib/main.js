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

		$.post($(this)[0].href,{A:'A'})
			.success(function(rspns){
				window.history.pushState({'url':this.url},null,this.url);
				$('.main').html(rspns);
				linkajax();
			})
	});
}
