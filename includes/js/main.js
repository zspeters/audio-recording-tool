$(document).ready(function () {

    var respPlayer = document.getElementById('resp-player');

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

            // start recording
            var recChunks = [];

            navigator.mediaDevices.getUserMedia({ audio: true, video: false }).then(function (stream) {

                mediaRecorder = new MediaRecorder(stream, { mimeType: 'audio/webm' });

                mediaRecorder.ondataavailable = function (e) {
                    if (e.data.size > 0) {
                        recChunks.push(e.data);
                    }

                    if (mediaRecorder.state == 'inactive') {
                        const blob = new Blob(recChunks, { type: 'audio/webm' });
                        var url = URL.createObjectURL(blob);
                        $("#resp-player").attr('src', url);

                        if (qCounter < 4) {
                            console.log(qCounter);
                            $('#next-q').one("click", uploadResp('blob', blob));
                        } else {
                            console.log(qCounter);
                            uploadResp('blob', blob);
                        }
                    }
                }

                mediaRecorder.start(1000);

            });

            // update the buttons
            changeButtons('#rec-btn-icon', 'fa-stop', 'fa-circle');
            $("#rec-btn").prop("disabled", false);
        }
    });

    // navigate questions
    const qTextArr = [
        "How are you feeling today?",
        "How long have you felt this way?",
        "How are things going at work?",
        "Do you smoke cigarettes or cannabis, or drink alcohol? Are you on any medication or any illicit drugs?",
        "Are you married? Do you have any children? How is your social life?"
    ];
    let qCounter = 0;

    $('#next-q').on("click", function () {
        if ((4 > qCounter) && (qCounter >= 0)) {
            qCounter++;
            $('#q-body').text(qTextArr[qCounter]);
            $('#q-counter').text(`${qCounter + 1} of 5`);
            $('#q-num').text(`Question ${qCounter + 1}:`);
        }
    });

    $('#prev-q').on("click", function () {
        if ((5 > qCounter) && (qCounter > 0)) {
            qCounter--;
            $('#q-body').text(qTextArr[qCounter]);
            $('#q-counter').text(`${qCounter + 1} of 5`);
            $('#q-num').text(`Question ${qCounter + 1}:`);
        }
    });
    // end navigate questions

    // helper to upload responses
    function uploadResp(respName, respData) {
        let fd = new FormData();
        fd.append(respName, respData);

        fetch("includes/php/upload_handler.php", {
            method: 'post',
            body: fd
        }).catch(console.error);
    }
    // end helper - upload responses

    // helper to manage buttons after audio finishes playback passively
    respPlayer.onended = function () {
        respPlayer.load();
        recBtns.prop("disabled", false);
        recBtns.removeClass('active');
        changeButtons("#rec-play-btn-icon", 'fa-play', 'fa-pause');
    }
    // end helper - button management

    // helper to change button icons
    function changeButtons(btnID, add, remove) {
        $(btnID).addClass(add).removeClass(remove);
    }
    // end helper - icon change

});