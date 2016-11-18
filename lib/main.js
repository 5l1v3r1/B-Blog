$(document).ready(function()
{
	defaultHTML = $('.main').html();

	linkajax();

	$( document ).ajaxSuccess(function( event, xhr, settings ) {
		if( settings.data!='form' )
			window.history.pushState({"html":xhr.responseText,"pageTitle":document.title},null, settings.url);
	});

	window.onpopstate = function(e){
	    if(e.state!=null){
	        $('.main').html(e.state.html);
			  console.log(e.state);
	    }
		 else {
		 	$('.main').html(defaultHTML);
		 }
	};

});


function linkajax(type=0)
{
	var slc = (type==1) ? $('.main a[target!=_blank]') : $('a[target!=_blank]') ;

	slc.click(function(e){
		e.preventDefault();

		$.post($(this)[0].href,{A:'A'})
			.success(function(d){
				$('.main').html( d );
				linkajax(1);
			})
			.error(function(){

			});
	});
}
