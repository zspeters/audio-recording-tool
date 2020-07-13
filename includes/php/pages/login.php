<?php
$_SESSION['page'] = 'login';
?>

<form action="../includes/php/handlers/login_handler.php" method="post" id="login-form">
    <div class="d-flex flex-column align-items-stretch" id="login-flex-col">

        <?php
        require '../includes/php/handlers/error_handler.php'; // edit this if index directory changes

        if (isset($_GET['mail'])) {
            echo '<input type="email" name="login-email" id="login-email" Value="' . $_GET['mail'] . '">';
        } else {
            echo '<input type="email" name="login-email" id="login-email" placeholder="Email">';
        }
        ?>

        <input type="password" name="login-pwd" placeholder="Password">
        <a href="?forgotpwd=req" class="align-self-center">Forgot your password?</a>
        <input type="submit" name="login-submit" class="btn btn-primary" value="Login">
        <div class="align-self-center">Don't have an account? <a href="?reg=show" id="reg-link">Register here</a></div>
    </div>
</form>