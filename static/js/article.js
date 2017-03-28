$(document).ready(function(){
	$(document).bind("contextmenu",function(e){
		$.showImmortal();
		return false;
	});
});