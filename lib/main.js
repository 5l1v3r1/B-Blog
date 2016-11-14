$(document).ready(function(){
	$('a').click(function(e){
		e.preventDefault();
		console.log($(this)[0].href);
	});
});
