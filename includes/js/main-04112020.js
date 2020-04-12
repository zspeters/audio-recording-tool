$(document).ready(function() {

    $("#q-play-btn").on("click", function() {

        
        if ($("#q-play-btn-icon").hasClass("fa-pause")) {
            $("#q-play-btn-icon").addClass("fa-play").removeClass("fa-pause");
            $("#q-play-btn").blur();

        } else {
        $("#q-play-btn-icon").removeClass("fa-play").addClass("fa-pause");

        // play question

        $("#q-play-btn").blur();
        }
    });

    $("#rec-btn").on("click",function(){
        var container = $("#container-rec-btns");

        if ($("#rec-btn-icon").hasClass("fa-stop")) {
            container.find(".btn").prop("disabled", false);
            $("#rec-btn-icon").addClass("fa-circle").removeClass("fa-stop");
            $("#rec-btn").blur();
            //stop recording
        } else {
        // disable all buttons
        container.find(".btn").prop("disabled", true);
        // call your function to start recording

//APRIL 10TH CODE START

  let shouldStop = false;
  let stopped = false;
  const downloadLink = document.getElementById('download');
  const recButton = document.getElementById('rec-btn');

  recButton.addEventListener('click', function() {
    if(document.getElementById('rec-btn-icon').hasClass("fa-stop")) {
        console.log("should stop");
        shouldStop = true;
    };
  });

  const handleSuccess = function(stream) {
    const recChunks = [];
    const mediaRecorder = new MediaRecorder(stream, {mimeType: 'audio/webm'});

    mediaRecorder.addEventListener('dataavailable', function(e) {
      if (e.data.size > 0) {
        recChunks.push(e.data);
      }

      if(shouldStop === true && stopped === false) {
        mediaRecorder.stop();
        stopped = true;
      }
    });

    mediaRecorder.addEventListener('stop', function() {
      downloadLink.href = URL.createObjectURL(new Blob(recordedChunks));
      downloadLink.download = 'acetest.wav';
    });

    mediaRecorder.start();
  };

  navigator.mediaDevices.getUserMedia({ audio: true, video: false })
      .then(handleSuccess);

//navigator.permissions.query({name:'microphone'}).then(function(result) {
//     if (result.state == 'granted') {
        
//     } else if (result.state == 'prompt') {
  
//     } else if (result.state == 'denied') {
  
//     }
//     result.onchange = function() {
        
//     };
//   });

//APRIL 10TH CODE END

        // update the buttons
        $("#rec-btn-icon").removeClass("fa-circle").addClass("fa-stop");
        $("#rec-btn").prop("disabled", false);
        }
    });

    $("#rec-play-btn").on("click", function() {
        var container = $("#container-rec-btns");

        if ($("#rec-play-btn-icon").hasClass("fa-pause")) {
            container.find(".btn").prop("disabled", false);
            $("#rec-play-btn-icon").addClass("fa-play").removeClass("fa-pause");
            $("#rec-play-btn").blur();

        } else {
        container.find(".btn").prop("disabled", true);
        $("#rec-play-btn-icon").removeClass("fa-play").addClass("fa-pause");
        $("#rec-play-btn").prop("disabled", false);
        }
    });

    // $("#rec-play-btn").click(function(){
    //     var container = $("#container-rec-btns");
    //     // disable all buttons
    //     container.find(".btn").prop("disabled", true);
    //     // call your function to start recording
    //     // update the buttons
    //     $("#rec-play-btn-icon").removeClass("fa-play").addClass("fa-pause");
    //     // $("#btn-record-pause").addClass("warning").prop("disabled", false);
    //     // $("#btn-record-stop").addClass("danger").prop("disabled", false);
    // });

    // $("#container-record .btn-record-stop").click(function(){
    //     var container = $("#container-record-btns");
    //     // disable all buttons
    //     container.find(".btn").prop("disabled", true);
    //     // call your function to stop the recording
    //     // update the buttons
    //     $("#btn-record-start").removeClass("success").addClass("danger").prop("disabled", false);
    //     $("#btn-record-pause").removeClass("warning").prop("disabled", true);
    //     $("#btn-record-stop").removeClass("danger").prop("disabled", true);
    //     });
    });