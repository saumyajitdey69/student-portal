$(document).ready(function(){

	$("#jquery_jplayer_1").jPlayer({
		ready: function (event) {
			$(this).jPlayer("setMedia", {
				title: "NITW LAN Radio - English ",
				mp3:"http://localhost/gitlab/student-portal/assets/js/jplayer/lanradio.wvx"
			});
		},
		swfPath: "",
		supplied: "mp3",
		wmode: "window",
		useStateClassSkin: true,
		autoBlur: false,
		smoothPlayBar: true,
		keyEnabled: true,
		remainingDuration: true,
		toggleDuration: true
	});
});