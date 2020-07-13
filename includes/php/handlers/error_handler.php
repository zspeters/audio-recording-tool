<?php

if (isset($_SESSION['page'])) {
    if (isset($_GET['error'])) {
        switch ($_SESSION['page']) {
            case 'login':
                switch ($_GET['error']) {
                    case 'regd';
                        echo '<p class="error-message">That email address is already registered. Please login to your account.</p>';
                        break;
                    case 'emptyfield':
                        echo '<p class="error-message">Please fill in your email and password.</p>';
                        break;
                    case 'badpwd';
                        echo '<p class="error-message">Your password was incorrect. Please try again.</p>';
                        break;
                    case 'noreg';
                        echo '<p class="error-message">That email address has not been registered. Please register below to use CURAVoice.</p>';
                        break;
                    case 'sqlerror';
                        echo '<p class="error-message">There was a problem reaching the database. Please try again.</p>';
                        break;
                }
                break;
            case 'reg':
                switch ($_GET['error']) {
                    case 'emptyfield':
                        echo '<p class="error-message">Please fill in all fields.</p>';
                        break;
                    case 'badmail';
                        echo '<p class="error-message">Please provide a valid email address, e.g. someone@example.com</p>';
                        break;
                    case 'pwdlen':
                        echo '<p class="error-message">Your password must be at least 6 characters long.</p>';
                        break;
                    case 'pwdmatch';
                        echo '<p class="error-message">Your passwords did not match. Please try again.</p>';
                        break;
                    case 'sqlerror';
                        echo '<p class="error-message">There was a problem reaching the database. Please try again.</p>';
                        break;
                }
                break;
            case 'pwdresetreq':
                switch ($_GET['error']) {
                    case 'tokenmatch':
                        echo '<p class="error-message">Password reset request could not be validated. Please try an additional request.</p>';
                        break;
                    case 'sendmail':
                        echo '<p class="error-message">Password reset email could not be sent. Please try again.</p>';
                        break;
                }
                break;
            case 'pwdreset':
                switch ($_GET['error']) {
                    case 'emptyfield':
                        echo '<p class="error-message">Please fill in all fields.</p>';
                        break;
                    case 'pwdmatch';
                        echo '<p class="error-message">Your passwords did not match. Please try again.</p>';
                        break;
                    case 'sqlerror';
                        echo '<p class="error-message">There was a problem reaching the database. Please try again.</p>';
                        break;
                }
                break;
            case 'app':
                if ($_GET['error'] == 'upload') {
                    echo '<p class="error-message" id="upload-error">There was a problem uploading your response. Please contact the administrators or try again.</p>';
                }
        }
    }
}
