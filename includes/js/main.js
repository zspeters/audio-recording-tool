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
                    }

                    if (mediaRecorder.state == 'inactive') {
                        const blob = new Blob(recChunks, { type: 'audio/' });
                        var url = URL.createObjectURL(blob);
                        $("#player").attr('src', url);

                        const fd = new FormData();
                        fd.append('blob', blob);

                        fetch("includes/php/upload_handler.php", {
                            method: 'post',
                            body: fd
                        }).catch(console.error);

                    }
                }

                mediaRecorder.start(1000);

            });

            // update the buttons
            changeButtons('#rec-btn-icon', 'fa-stop', 'fa-circle');
            $("#rec-btn").prop("disabled", false);

        }



    });

    // helper to upload audio data to server
    // function uploadAudio(blob) {
    //     const fd = new FormData();
    //     fd.append('blob', blob);

    //     fetch("includes/php/upload_handler.php", {
    //         method: 'post',
    //         body: fd
    //     }).catch(console.error);

    //     var ffmpeg = require('ffmpeg');
    //     try {
    //         var process = new ffmpeg("../php/uploads/blob");
    //         process.then(function (audio) {
    //             audio.fnExtractSoundToMP3('../php/uploads/blob.mp3', function (error, file) {
    //                 if (!error)
    //                     console.log('Audio file:' + file);
    //             });
    //         }, function (err) {
    //             console.log('Error: ' + err);
    //         });
    //     } catch (e) {
    //         console.log(e.code);
    //         console.log(e.msg);
    //     };
    // };

    // helper to manage buttons after audio finishes playback passively
    player.onended = function () {
        player.load();
        recBtns.prop("disabled", false);
        recBtns.removeClass('active');
        changeButtons("#rec-play-btn-icon", 'fa-play', 'fa-pause');
    }

    // helper to change button icons
    function changeButtons(btnID, add, remove) {
        $(btnID).addClass(add).removeClass(remove);
    }

});