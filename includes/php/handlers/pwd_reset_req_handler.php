<?php

if (isset($_POST['pwd-reset-submit'])) {

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    // edit these if index directory changes
    $headerLoc = "Location: ../../../www/index.php";
    $url = 'localhost/curavoice/www/index.php?forgotpwd=reset&selector=' . $selector . 
    '&validator=' . bin2hex($token);

    $headerLocSqlError = $headerLoc . '?forgotpwd=req&error=sqlerror';

    $expires = date("U") + 3600;

    require 'db_handler.php';

    $userEmail = $_POST['pwd-reset-email'];

    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // error sql
        header($headerLocSqlError);
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, 's', $userEmail);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // error sql
        header($headerLocSqlError);
        exit();
    } else {
        $hashedToken = hash('sha256', $token);
        mysqli_stmt_bind_param($stmt, 'ssss', $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    // mysqli_close($conn);

    $to = $userEmail;

    $subject = 'CURAVoice Password Reset Request';

    $message = '<p>A password reset request was received for the CURAVoice account associated with this email. If you did not make this request, you may ignore this email. If you did make this request, click the link below or copy/paste the URL to reset your password.</p><p><a href="' . $url . '">Reset your password.</a><br>' . $url . '</p>';

    $headers = "From: CURAVoice <curavoicesmtp@gmail.com>\r\n";
    $headers .= "Reply-To: curavoicesmtp@gmail.com\r\n";
    $headers .= "Content-Type: text/html\r\n";

    if (mail($to, $subject, $message, $headers)) {
        $headerLocSentPwdEmail = $headerLoc . '?forgotpwd=sent';
        header($headerLocSentPwdEmail);
        exit();
    } else {
        // error sending mail
        $headerLocMailError = $headerLoc . '?forgotpwd=failed&error=sendmail';
        header($headerLocMailError);
        exit();
    }

} else {
    header("Location: ../../../www/index.php");
}