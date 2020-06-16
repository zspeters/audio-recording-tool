<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap 4.4.1 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Bootstrap 3.4.1 jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap 4.4.1 JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- FontAwesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="Images/mic-favicon.svg">
    <link rel="stylesheet" type="text/css" href="includes/css/main.css">
    <script type="text/javascript" charset="utf-8" src="includes/js/main.js"></script>

    <title>CURAVoice</title>

</head>

<body>
    <div class="container">
        <div class="jumbotron text-center pre-break">
            <h1>CURAVoice</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin accumsan mauris neque, eu tincidunt tortor blandit aliquet. Sed malesuada varius nibh vitae finibus. Aliquam augue ex, accumsan convallis iaculis at, malesuada a felis. Ut auctor
                ultricies mattis. Pellentesque at arcu finibus, lacinia sem at, tincidunt mauris. Integer volutpat in eros mollis tempus. Vestibulum eu sem est.</p>
        </div>
        <!-- end pre-break-->
        <!-- begin post-break-->
        <div class="container post-break">
            <div class="container" id="main-content">
                <div class="container-fluid">
                    <!-- begin question-->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 id="q-num">Question 1:</h2>
                            </div>
                            <div class="col-12 text-center align-self-center">
                                <p id="q-body">How are you feeling today?</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <audio controls autoplay src="audio/questions/q1.mp3" id="q-player"></audio>
                            </div>
                        </div>
                    </div>
                    <!-- end question-->
                    <!-- begin response-->
                    <div class="container-fluid" id="container-rec">
                        <div class="row">
                            <div class="col text-center">
                                <h2>Your Response:</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-center align-items-center">
                            <div class="btn-group" role="group" id="container-rec-btns" aria-label="Voice recording buttons">
                                <button type="button" class="btn btn-primary rec-btns" onclick="this.blur();" id="rec-btn"><i class="fa fa-circle"
                                        id="rec-btn-icon"></i></button>
                                <button type="button" class="btn btn-primary rec-btns" onclick="this.blur();" disabled="true" id="rec-pause-btn"><i class="fa fa-pause"
                                        id="rec-pause-btn-icon"></i></button>
                                <button type="button" class="btn btn-primary rec-btns" onclick="this.blur();" disabled="true" id="rec-stop-btn"><i class="fa fa-stop"
                                        id="rec-stop-btn-icon"></i></button>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <audio controls id="resp-player"></audio>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container" id="container-q-nav">
                <div class="d-flex flex-row justify-content-center">
                    <div class="btn-group btn-group-toggle" role="group" id="q-nav">
                        <label>
                            <button class="btn btn-primary no-click" disabled="true" onclick="this.blur();" id="prev-q"><i class="fa fa-chevron-left"></i> Previous
                                Question</button>
                        </label>
                        <label>
                            <button class="btn btn-primary no-click" id="q-counter">1 of 5</button>
                        </label>
                        <label>
                            <button class="btn btn-primary" onclick="this.blur();" id="next-q">Next Question <i class="fa fa-chevron-right"></i>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <!-- end response-->
    </div>
    <!-- end post-break-->
    <!-- begin modal -->
    <div class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog fullscreen" role="document">
            <div class="modal-content fullscreen">
                <div class="d-flex flex-column justify-content-center" id="#modal-flex">
                    <div class="modal-header">
                        <h1 class="modal-title">CURAVoice</h1>
                    </div>
                    <div class="modal-body">
                        <form id="user-email-form">
                            <label for="user-email">Please enter your email address:&nbsp;</label>
                            <input type="email" name="user-email" placeholder="someone@example.com">
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Continue">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
</body>

<footer>

</footer>

</html>