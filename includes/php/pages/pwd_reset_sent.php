<?php
$_SESSION['page'] = 'pwdresetsent';
?>

<div class="container">
    <div class="row">
        <div class="d-flex flex-column justify-content-center align-items-center col-md-6 col-md-offset-3">

            <?php
            require '../includes/php/handlers/error_handler.php';
            ?>

            <p class="text-center">An email with instructions to reset your password was sent to the provided email. Please check your email to reset your password.</p>
            <p class="text-center">If you do not see your password reset email, please check your spam folder.</p>
            <a href="index.php" class="btn btn-primary">Back to Login</a>
        </div>
    </div>
</div>