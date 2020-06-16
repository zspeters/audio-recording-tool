$(document).ready(function() {

    let userEmail = '';
    let qPlayer = $('#q-player');
    let recordingNow = false;
    let recBtns = $("#container-rec-btns").find(".btn");
    let recBtn = $('#rec-btn');
    let recStopBtn = $('#rec-stop-btn');
    let recPauseBtn = $('#rec-pause-btn');
    let respPlayer = $('#resp-player');
    let respPlayerSrcArr = Array.apply(null, Array(5));
    let prevQBtn = $('#prev-q');
    let qCounter = 0;
    let nextQBtn = $('#next-q');

    const qTextArr = [
        "How are you feeling today?",
        "How long have you felt this way?",
        "How are things going at work?",
        "Do you smoke cigarettes or cannabis, or drink alcohol? Are you on any medication or any illicit drugs?",
        "Are you married? Do you have any children? How is your social life?"
    ];
    const qPlayerSrcArr = [];
    for (let i = 1; i < 6; i++) {
        qPlayerSrcArr.push('audio/questions/q' + i.toString() + '.mp3');
    }

    $('.modal').modal('show');

    $('#user-email-form').submit(function(event) {
        event.preventDefault();
        userEmail = $("#user-email-form :input").serializeArray()[0]['value'];
        if (!userEmail) {
            alert('Your email address was not recorded. Please refresh the page.');
        } else {
            $('.modal').modal('hide');
            qPlayer.trigger('play');
        }
    });

    // handle response recording
    recBtn.on("click", function() {
        //start recording
        if (!recordingNow) {
            recordingNow = true;
            let recChunks = [];
            recBtn.attr('disabled', true);
            recPauseBtn.attr('disabled', false);
            recStopBtn.attr('disabled', false);

            navigator.mediaDevices.getUserMedia({ audio: true, video: false }).then(function(stream) {
                mediaRecorder = new MediaRecorder(stream, { mimeType: 'audio/webm' });

                mediaRecorder.ondataavailable = function(e) {
                    if (e.data.size > 0) {
                        recChunks.push(e.data);
                    }

                    if (mediaRecorder.state == 'inactive') {
                        const blob = new Blob(recChunks, { type: 'audio/webm' });
                        let url = URL.createObjectURL(blob);
                        respPlayerSrcArr[qCounter] = url;
                        respPlayer.attr('src', url);

                        // upload on navigation to next question if Q1-Q4
                        if (qCounter < 4) {
                            nextQBtn.on("click", function(event) {
                                uploadResp(qCounter, blob);
                            });
                            // upload immediately after recording Q5
                        } else {
                            uploadResp(qCounter + 1, blob);
                        }

                        recordingNow = false;
                        recBtn.attr('disabled', false);
                    }
                }

                recPauseBtn.on('click', function() {
                    // pause recording
                    if (mediaRecorder.state == 'recording') {
                        mediaRecorder.pause();
                        recPauseBtn.addClass('active');

                        // resume recording
                    } else if (mediaRecorder.state == 'paused') {
                        mediaRecorder.resume();
                        recPauseBtn.removeClass('active');
                    }
                });

                recStopBtn.on('click', function(event) {
                    // stop recording
                    if (mediaRecorder.state !== 'inactive') {
                        mediaRecorder.stop();
                        recStopBtn.attr('disabled', true);
                        recPauseBtn.attr('disabled', true);
                        if (recPauseBtn.hasClass('active')) {
                            recPauseBtn.removeClass('active');
                        };
                        recBtn.attr('disabled', false);
                    }
                    recPauseBtn.off('click');
                    $('this').off(event);
                });

                mediaRecorder.start(1000);
            }).catch(alert);
        }
    });
    // end handle response recording

    // navigate questions
    nextQBtn.on("click", function() {
        // enable 'Previous Question' button when not on Q1
        if (0 == qCounter) {
            prevQBtn.attr('disabled', false);
            prevQBtn.removeClass('no-click');
        }
        if ((4 > qCounter) && (qCounter >= 0)) {
            qCounter++;
            changeSrc();
            // change nav button text
            $('#q-body').text(qTextArr[qCounter]);
            $('#q-counter').text(`${qCounter + 1} of 5`);
            $('#q-num').text(`Question ${qCounter + 1}:`);
        }
        if (4 == qCounter) {
            // change 'Next Question >' text to 'Finish and Upload' on last question
            nextQBtn.text('Finish and Upload');
        }
    });

    prevQBtn.on("click", function() {
        // disable '< Previous Question' button on Q1
        if (1 == qCounter) {
            prevQBtn.attr('disabled', true);
            prevQBtn.addClass('no-click');
        }
        if ((5 > qCounter) && (qCounter > 0)) {
            qCounter--;
            changeSrc();
            // change nav button text
            $('#q-body').text(qTextArr[qCounter]);
            $('#q-counter').text(`${qCounter + 1} of 5`);
            $('#q-num').text(`Question ${qCounter + 1}:`);
        }
        if (3 == qCounter) {
            // change 'Finish and Upload' text back to 'Next Question >'
            nextQBtn.html('Next Question <i class="fa fa-chevron-right"></i>');
        }
    });
    // end navigate questions

    // helper to upload responses
    function uploadResp(qNum, respData) {
        let fd = new FormData();
        fd.append(qNum, respData, 'q' + qNum + 'response');
        fd.append('userEmail', userEmail);
        fd.append('qNum', qNum);

        fetch("includes/php/upload_handler.php", {
            method: 'post',
            body: fd
        }).catch(console.error);
    }
    // end helper - upload responses

    // helper to change player audio source
    function changeSrc() {
        // change question audio source
        qPlayer.attr('src', qPlayerSrcArr[qCounter]);
        // change response audio source
        if (typeof respPlayerSrcArr[qCounter] == 'string') {
            respPlayer.attr('src', respPlayerSrcArr[qCounter]);
        } else {
            respPlayer.attr('src', '#');
        }
    };
    // end helper - player src change

    // helper to manage buttons after response audio finishes playback passively
    respPlayer.onended = function() {
        respPlayer.load();
        recBtns.prop("disabled", false);
        recBtns.removeClass('active');
        changeButtons("#rec-play-btn-icon", 'fa-play', 'fa-pause');
    };
    // end helper - button management

    // helper to change button icons
    function changeButtons(btnID, add, remove) {
        $(btnID).addClass(add).removeClass(remove);
    };
    // end helper - icon change

});