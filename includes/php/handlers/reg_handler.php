<?php

if (isset($_POST['reg-submit'])) {

    require 'db_handler.php';

    $fName = $_POST['reg-first-name'];
    $lName = $_POST['reg-last-name'];
    $email = $_POST['reg-email'];
    $pwd = $_POST['reg-pwd'];
    $pwdConf = $_POST['reg-pwd-conf'];
    $headerLoc = "Location: ../../../www/index.php"; // edit this if index directory changes
    $headerLocSqlError = $headerLoc . "?reg=show&error=sqlerror";

    if (empty($fName) || empty($lName) || empty($email) || empty($pwd) || empty($pwdConf)) {
        // error empty fields
        $headerLocEmptyField = $headerLoc . "?reg=show&error=emptyfield";
        $fNameGet = "&fn=$fName";
        $lNameGet = "&ln=$lName";
        $emailGet = "&mail=$email";

        if ($fNameGet != "&fn=") {
            $headerLocEmptyField .= $fNameGet;
        }
        if ($lNameGet != "&ln=") {
            $headerLocEmptyField .= $lNameGet;
        }
        if ($emailGet != "&mail=") {
            $headerLocEmptyField .= $emailGet;
        }
        header($headerLocEmptyField);
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // error invalid email
        $headerLocBadMail = $headerLoc . "?reg=show&error=badmail&fn=$fName&ln=$lName";
        header($headerLocBadMail);
        exit();
    } else if (strlen($pwd) < 6) {
        // error password too short
        $headerLocPwdLen = $headerLoc . "?reg=show&error=pwdlen&fn=$fName&ln=$lName&mail=$email";
        header($headerLocPwdLen);
        exit();
    } else if ($pwd !== $pwdConf) {
        // error passwords do not match
        $headerLocPwdMatch = $headerLoc . "?reg=show&error=pwdmatch&fn=$fName&ln=$lName&mail=$email";
        header($headerLocPwdMatch);
        exit();
    } else {

        $sql = "SELECT emailUsers FROM users WHERE emailUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            // error sql
            header($headerLocSqlError);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                // error email already registered
                $headerLocRegd = $headerLoc . "?error=regd&fn=$fName&ln=$lName";
                header($headerLocRegd);
                exit();
            } else {
                $sql = "INSERT INTO users (emailUsers, firstUsers, lastUsers, pwdUsers) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    // error sql
                    header($headerLocSqlError);
                    exit();
                } else {
                    $pwdHash = hash('sha256', $pwd);
                    $headerLocRegSucc = $headerLoc . "?reg=success";

                    mysqli_stmt_bind_param($stmt, "ssss", $email, $fName, $lName, $pwdHash);
                    mysqli_stmt_execute($stmt);
                    header($headerLocRegSucc);
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../../../www/index.php?reg=show");
    exit();
}
