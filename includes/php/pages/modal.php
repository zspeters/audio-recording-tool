<div class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog fullscreen" role="document">
        <div class="modal-content fullscreen" id="modal-content">
            <div class="d-flex flex-column justify-content-center" id="modal-flex">
                <div class="modal-header">
                    <h1 class="modal-title">CURAVoice</h1>
                </div>
                <div class="modal-body" id="modal-body-content">

                    <?php

                    if (isset($_GET['reg'])) {
                        if ($_GET['reg'] == 'show') {
                            require 'reg.php';
                        } else if ($_GET['reg'] == 'success') {
                            require 'success.php';
                        }
                    } else if (isset($_GET['forgotpwd'])) {
                        if ($_GET['forgotpwd'] == 'req') {
                            require 'pwd_reset_req.php';
                        } else if ($_GET['forgotpwd'] == 'sent') {
                            require 'pwd_reset_sent.php';
                        } else if ($_GET['forgotpwd'] == 'reset') {
                            require 'pwd_reset.php';
                        } else if ($_GET['forgotpwd'] == 'failed') {
                            require 'pwd_reset_req.php';
                        }
                    } else if (isset($_GET['pwdreset'])) {
                        if ($_GET['pwdreset'] == 'success') {
                            require 'success.php';
                        }
                    } else {
                        require 'login.php';
                    }

                    ?>

                </div>
            </div>
        </div>
    </div>
</div>