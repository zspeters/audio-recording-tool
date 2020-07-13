<?php

if (isset($_POST['reset-pwd-submit'])) {

    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $pwd = $_POST['pwd'];
    $pwdConf = $_POST['pwd-conf'];
    $headerLoc = "Location: ../../../www/index.php"; // edit this if index directory changes
    $headerLocSqlError = $headerLoc . '?forgotpwd=reset&error=sqlerror';

    if (empty($pwd) || empty($pwdConf)) {
        // error empty fields
        $headerLocEmptyField = $headerLoc . '?forgotpwd=reset&error=emptyfield';
        header($headerLocEmptyField);
        exit();
    } else if ($pwd != $pwdConf) {
        // error passwords do not match
        $headerLocPwdMatch = $headerLoc . '?forgotpwd=reset&error=pwdmatch';
        header($headerLocPwdMatch);
        exit();
    }

    $currentDate = date("U");

    require 'db_handler.php';

    $sql = "SELECT * FROM pwdreset WHERE pwdResetSelector=? AND pwdResetExpires >= " . $currentDate;
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // error sql
        header($headerLocSqlError);
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, 's', $selector);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {
            // error sql
            header($headerLocSqlError);
            exit();
        } else {
            $tokenBin = hex2bin($validator);
            $tokenBinHash = hash('sha256', $tokenBin);
            $tokenCheck = false;
            if ($tokenBinHash === $row['pwdResetToken']) { $tokenCheck = true; }

            if ($tokenCheck === false) {
                // error token match
                $headerLocTokenMatch = $headerLoc . '?forgotpwd=failed&error=tokenmatch';
                header($headerLocTokenMatch);
                exit();
            } else if ($tokenCheck === true) {

                $tokenEmail = $row['pwdResetEmail'];

                $sql = "SELECT * FROM users WHERE emailUsers=?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    // error sql
                    header($headerLocSqlError);
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, 's', $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        // error sql
                        header($headerLocSqlError);
                        exit();
                    } else {

                        $sql = "UPDATE users SET pwdUsers=? WHERE emailUsers=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            // error sql
                            header($headerLocSqlError);
                            exit();
                        } else {
                            $newPwdHash = hash('sha256', $pwd);
                            mysqli_stmt_bind_param($stmt, 'ss', $newPwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                // error sql
                                header($headerLocSqlError);
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, 's', $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header($headerLoc . '?pwdreset=success');
                            }
                        }
                    }
                }
            }
        }
    }
} else {
    header("Location: ../../../www/index.php");
}
