window.onload = function(){
	$("body").append('<div id="player-div" style="width: 100vw;height: 100vh; position: fixed; top: 0; background: rgba(0, 0, 0, 0.5);z-index: 999"><span id="closeplayer" style="position:absolute;right: 0;margin: 50px;cursor: pointer;font-size: 50px; color: #fd3c3c;">&times;</span><div style="width: 50vw;height: 50vh; margin: 25vh auto;"><video id="player" src="/static/video/004tRDdojx078hZAFpHq01040100t30E0k01.mp4"></video></div></div>');
	var video = document.getElementById("player");
	video.play();
	$("#closeplayer").on("click",function(){
		video.pause();
		$("#player-div").remove();
	});
};