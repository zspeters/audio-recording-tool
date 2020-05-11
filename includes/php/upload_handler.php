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

$target = '../../audio/responses/' . basename($_FILES['blob']['name']) . '.webm';
move_uploaded_file($_FILES['blob']['tmp_name'], $target);

?>