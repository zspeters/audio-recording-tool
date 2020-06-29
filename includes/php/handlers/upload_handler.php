<?php

if (!isset($_POST['qNum']) || !isset($_POST['userEmail'])) {
    // error getting data from main.js
    
} else {
    $qNum = $_POST['qNum']['name'];
    $userEmail = sha1($_POST['userEmail']);
    $targetDir = '../../../audio/responses/' . $userEmail;
    $target = $targetDir . '/' . basename($_FILES[$qNum]['name']) . '.webm';

    mkdir($targetDir, 0777, true);
    move_uploaded_file($_FILES[$qNum]['tmp_name'], $target);
}
