<div id="reg-succ-container">
    <div class="d-flex flex-column">
        <?php
        if (isset($_GET['reg'])) {
            if ($_GET['reg'] == 'success') {
                echo '<p class="success-message">Your registration was successful.</p>';
            }
        } else if (isset($_GET['pwdreset'])) {
            if ($_GET['pwdreset'] == 'success') {
                echo '<p class="success-message">Your password has been updated. You may now login with your new password.</p>';
            }
        }
        ?>
        <button onclick="location.href='index.php'" type="button" class="btn btn-primary" id="proceed-btn">Login to Your Account</button>
    </div>
</div>