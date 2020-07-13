<?php
$_SESSION['page'] = 'pwdresetreq';
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <?php
            require '../includes/php/handlers/error_handler.php';
            ?>
            
            <form action="../includes/php/handlers/pwd_reset_req_handler.php" method="post" id="pwd-reset-req-form">
                <div class="d-flex flex-column align-items-center" id="pwd-reset-req-flex-col">
                    <p class="text-center">To reset your password, enter your email address below and click 'Get Password Reset Email'.
                        If your email address is registerd, an email will be sent to you with instructions and a key to reset your password.</p>

                    <h2 class="reg-head align">Email address:</h2>
                    <input type="email" name="pwd-reset-email" placeholder="someone@example.com">
                    <input type="submit" name="pwd-reset-submit" class="btn btn-primary" value="Get Password Reset Email" id="pwd-reset-submit">
                </div>
            </form>
        </div>
    </div>
</div>