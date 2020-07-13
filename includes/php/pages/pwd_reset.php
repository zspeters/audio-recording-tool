<?php
$_SESSION['page'] = 'pwdreset';
$selector = '';
$validator = '';
if (isset($_GET['selector']) && isset($_GET['validator'])) {
    $selector = $_GET['selector'];
    $validator = $_GET['validator'];
}
?>

<form action="../includes/php/handlers/pwd_reset_handler.php" method="post" id="pwd-reset-form">
    <div class="d-flex flex-column align-items-center" id="pwd-reset-flex-col">
        <?php

        require '../includes/php/handlers/error_handler.php';

        if (empty($selector) || empty($validator)) {
            ?>

            <p class="error-message">Could not validate password reset.</p>
            <a href="index.php" class="btn btn-primary">Back to Login</a>
            
            <?php
        } else if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
        ?>
            <input type="hidden" name="selector" value="<?php echo $selector; ?>">
            <input type="hidden" name="validator" value="<?php echo $validator; ?>">
            <input type="password" name="pwd" placeholder="New password">
            <input type="password" name="pwd-conf" placeholder="Confirm new password">
            <button type="submit" class="btn btn-primary" name="reset-pwd-submit">Reset Password</button>
        <?php
        }
        ?>
    </div>
</form>