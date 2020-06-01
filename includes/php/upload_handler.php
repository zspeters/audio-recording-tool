<?php

// if (isset($_POST['submit'])) {
//     $file = $_FILES['file'];

//     $fileName = $file['name'];
//     $fileTmpName = $file['tmp_name'];
//     $fileSize = $file['size'];
//     $fileError = $file['error'];
//     $fileType = $file['type'];

//     $fileExt = explode('.', $fileName);
//     $fileExtLwr = strtolower(end($fileExt));

//     if($fileError === 0) {
//         $fileNameNew = uniqid('', true).".".$fileExtLwr;
//         $fileDest = 'uploads/'.$fileNameNew;
//         move_uploaded_file($fileTmpName, $fileDest);
//         echo "You did it!";
//     } else {
//         echo "Upload error";
//     }

// }

// print_r(scandir('.'));

include 'ChromePhp.php';
ChromePhp::log($_FILES);
ChromePhp::log($_POST);

$qNum = $_POST['qNum']['name'];
$userEmail = sha1($_POST['userEmail']);
$targetDir = '../../audio/responses/' . $userEmail;
$target = $targetDir . '/' . basename($_FILES[$qNum]['name']) . '.webm';

mkdir($targetDir, 0777, true);
move_uploaded_file($_FILES[$qNum]['tmp_name'], $target);


?>