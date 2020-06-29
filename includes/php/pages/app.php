<?php
$_SESSION['page'] = 'app';
?>

<div class="d-flex" id="app-wrapper">
    <!-- begin sidebar -->
    <div class="border-right" id="sidebar-wrapper">
        <?php
        echo '<div id="sidebar-heading">Hi, ' . $_SESSION['fn'] .
            '&nbsp;<form action="../includes/php/handlers/logout_handler.php" method="post">
            <button type="submit" name="logout-submit" class="btn btn-outline-primary btn-sm">Logout</button>
            </form></div>';
        ?>
        <div class="list-group list-group-flush">
            <div class="list-group-item" id="past-recordings-heading">Past recordings</div>
            <a href="#" class="list-group-item list-group-item-action">Placeholder</a>
            <a href="#" class="list-group-item list-group-item-action">Placeholder</a>
            <a href="#" class="list-group-item list-group-item-action">Placeholder</a>
        </div>
    </div>
    <!-- end sidebar -->
    <!-- begin pre-break -->
    <div class="container">
        <div class="jumbotron text-center pre-break">
            <h1>CURAVoice</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin accumsan mauris neque, eu tincidunt tortor blandit aliquet. Sed malesuada varius nibh vitae finibus. Aliquam augue ex, accumsan convallis iaculis at, malesuada a felis. Ut auctor
                ultricies mattis. Pellentesque at arcu finibus, lacinia sem at, tincidunt mauris. Integer volutpat in eros mollis tempus. Vestibulum eu sem est.</p>
        </div>
        <!-- end pre-break-->
        <!-- begin post-break-->
        <div class="container" id="post-break">
            <div class="container" id="main-content">
                <div class="container-fluid">
                    <!-- begin question-->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class="h2-main" id="q-num">Question 1:</h2>
                            </div>
                            <div class="col-12 text-center align-self-center">
                                <p id="q-body">How are you feeling today?</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <!-- invisible, silent iframe allows autoplay in Chrome -->
                                <iframe src="../audio/silence.mp3" type="audio/mp3" allow="autoplay" style="display: none;"></iframe>
                                <audio controls autoplay src="../audio/questions/q1.mp3" id="q-player"></audio>
                            </div>
                        </div>
                    </div>
                    <!-- end question-->
                    <hr>
                    <!-- begin response-->
                    <div class="container-fluid" id="container-rec">
                        <div class="row">
                            <div class="col text-center">
                                <h2 class="h2-main">Your Response:</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-center align-items-center">
                            <div class="btn-group" role="group" id="container-rec-btns" aria-label="Voice recording buttons">
                                <button type="button" class="btn btn-primary rec-btns" onclick="this.blur();" id="rec-btn"><i class="fa fa-circle" id="rec-btn-icon"></i></button>
                                <button type="button" class="btn btn-primary rec-btns" onclick="this.blur();" disabled="true" id="rec-pause-btn"><i class="fa fa-pause" id="rec-pause-btn-icon"></i></button>
                                <button type="button" class="btn btn-primary rec-btns" onclick="this.blur();" disabled="true" id="rec-stop-btn"><i class="fa fa-stop" id="rec-stop-btn-icon"></i></button>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <audio controls id="resp-player"></audio>
                            <?php
                                require '../includes/php/handlers/error_handler.php';
                            ?>
                        </div>
                    </div>
                    <!-- end response-->
                </div>
            </div>
            <!-- begin nav-->
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
            <!-- end nav-->
        </div>
    </div>
    <!-- end post-break-->
</div>