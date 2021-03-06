$(document).ready(function() {
    $("#jquery_jplayer_1").jPlayer({
        ready: function(event) {
            console.log($(this).jPlayer("setMedia", {
                title: "NITW LAN Radio ",
                mp3: "http://172.30.152.34:8000/stream/1/"
            }));
	 		Indicator(true);
        },
        waiting: function(event) {
            Indicator(false);
        },
        error: function (event) {
            Indicator(false);
        },
        errorAlerts: true,
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

// var uiBlocked = false;

// window.onload = Indicator(false);

// function checkServer() {
//     $.ajax({
//         cache: false,
//         type: 'GET',
//         url: url,
//         timeout: 1000,
//         success: function(data, textStatus, XMLHttpRequest) {
//             if (data != '') {
//                 if (uiBlocked == false) {
//                     uiBlocked = true;
//                     Indicator(true);
//                 }
//             } else {
//                 if (uiBlocked == true) {
//                     uiBlocked = false;
//                     Indicator(false)
//                 }
//             }
//         },
//         error: function(XMLHttpRequest, textStatus, errorThrown) {
//             Indicator(false);
//         }
//     })

// };

function Indicator(show) {
    if (show)
        $('#online-indicator').removeClass('label-danger').addClass('label-success').html('ON AIR');
    else
        $('#online-indicator').addClass('label-danger').removeClass('label-success').html('OFFLINE');
}
