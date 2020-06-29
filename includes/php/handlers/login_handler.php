<?php

if (isset($_POST['login-submit'])) {

    require 'db_handler.php';

    $email = $_POST['login-email'];
    $pwd = $_POST['login-pwd'];
    $headerLoc = "Location: ../../../www/index.php"; // edit this if index directory changes

    if (empty($email) || empty($pwd)) {
        // error empty fields
        $headerLocEmptyField = $headerLoc . "?error=emptyfield";
        $emailGet = "&mail=$email";
        if ($emailGet != "&mail=") {
            $headerLocEmptyField .= $emailGet;
        }
        header($headerLocEmptyField);
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE emailUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../../../www/index.php?error=sqlerror&logmail=" . $email);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdHash = hash('sha256', $pwd);
                if ($pwdHash !== $row['pwdUsers']) {
                    header("Location: ../../../www/index.php?error=badpwd&logmail=" . $email);
                    exit();
                } else if ($pwdHash === $row['pwdUsers']) {
                    session_name('curavoice');
                    session_start();
                    $_SESSION['id'] = $row['idUsers'];
                    $_SESSION['email'] = $row['emailUsers'];
                    $_SESSION['fn'] = $row['firstUsers'];
                    $_SESSION['ln'] = $row['lastUsers'];
                    header("Location: ../../../www/index.php");
                    exit();
                } else {
                    header("Location: ../../../www/index.php?error=badpwd&logmail=" . $email);
                    exit();
                }
            } else {
                header("Location: ../../../www/index.php?error=noreg");
                exit();
            }
        }
    }

} else {
    header("Location: ../../../www/index.php");
    exit();
}