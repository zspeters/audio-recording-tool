$(document).ready(function () {

    var player = document.getElementById('player');

    var recBtns = $("#container-rec-btns").find(".btn");

    $("#q-play-btn").on("click", function () {


        if ($("#q-play-btn-icon").hasClass("fa-pause")) {
            $("#q-play-btn-icon").addClass("fa-play").removeClass("fa-pause");
            $("#q-play-btn").blur();

        } else {
            $("#q-play-btn-icon").removeClass("fa-play").addClass("fa-pause");

            // play question

            $("#q-play-btn").blur();
        }
    });

    $("#rec-btn").on("click", function () {
        var container = $("#container-rec-btns");

        if ($("#rec-btn-icon").hasClass("fa-stop")) {
            container.find(".btn").prop("disabled", false);
            $("#rec-btn-icon").addClass("fa-circle").removeClass("fa-stop");
            $("#rec-btn").blur();

            //stop recording
            if (mediaRecorder.state == "recording") {
                mediaRecorder.stop();
            }
            
        } else {

            // disable all buttons
            container.find(".btn").prop("disabled", true);

            // function to start recording

            var recChunks = [];

            navigator.mediaDevices.getUserMedia({ audio: true, video: false }).then(function (stream) {

                mediaRecorder = new MediaRecorder(stream, { mimeType: 'audio/webm' });

                mediaRecorder.ondataavailable = function (e) {
                    if (e.data.size > 0) {
                        recChunks.push(e.data);
                        console.log('pushin');
                    }

                    if (mediaRecorder.state == 'inactive') {
                        const blob = new Blob(recChunks, { type: 'audio/' });
                        var url = URL.createObjectURL(blob);
                        $("#player").attr('src', url);
                    }
                }

                mediaRecorder.start(1000);

            });

            // update the buttons
            changeButtons('#rec-btn-icon', 'fa-stop', 'fa-circle');
            $("#rec-btn").prop("disabled", false);

        }



    });

    $("#rec-play-btn").on("click", function () {
        if ($("#rec-play-btn-icon").hasClass("fa-pause")) {
            recBtns.prop("disabled", false);
            changeButtons("#rec-play-btn-icon", 'fa-play', 'fa-pause');
            player.pause();
            $("#rec-play-btn").blur();

        } else {
            recBtns.prop("disabled", true);
            changeButtons("#rec-play-btn-icon", 'fa-pause', 'fa-play');
            $('#rec-play-btn').prop("disabled", false);
            player.play();
        }
    });

    player.onended = function () {
        player.load();
        recBtns.prop("disabled", false);
        recBtns.removeClass('active');
        changeButtons("#rec-play-btn-icon", 'fa-play', 'fa-pause');
    }

    function changeButtons(btnID, add, remove) {
        $(btnID).addClass(add).removeClass(remove);
    }

});