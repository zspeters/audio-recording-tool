<?php
$_SESSION['page'] = 'reg';
?>

<form action="../includes/php/handlers/reg_handler.php" method="post" id="reg-form">

    <?php
        require '../includes/php/handlers/error_handler.php';
    ?>
    
    <div class="d-flex flex-column align-items-start" id="login-flex-col">
        <h2 class="reg-head">First and last name:</h2>
        <div class="d-flex flex-row">
            <?php
            if (isset($_GET['fn'])) {
                echo '<input type="text" name="reg-first-name" Value="' . $_GET['fn'] . '">';
            } else {
                echo '<input type="text" name="reg-first-name" placeholder="First name">';
            }

            if (isset($_GET['ln'])) {
                echo '<input type="text" name="reg-last-name" Value="' . $_GET['ln'] . '">';
            } else {
                echo '<input type="text" name="reg-last-name" placeholder="Last name">';
            }
            ?>
        </div>
        <h2 class="reg-head">Email address:</h2>
        <div class="d-flex flex-row">
            <?php
            if (isset($_GET['mail'])) {
                echo '<input type="email" name="reg-email" Value="' . $_GET['mail'] . '">';
            } else {
                echo '<input type="email" name="reg-email" placeholder="someone@example.com">';
            }
            ?>
        </div>
        <h2 class="reg-head">Password:</h2>
        <div class="d-flex flex-row">
            <input type="password" name="reg-pwd" placeholder="Password">
            <input type="password" name="reg-pwd-conf" placeholder="Confirm password">
        </div>
        <input type="submit" name="reg-submit" class="btn btn-primary align-self-center" value="Register" id="reg-btn">
    </div>
</form>