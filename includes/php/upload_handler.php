<?php

$qNum = $_POST['qNum']['name'];
$targetDir = '../../audio/responses/' . $_POST['userDir'];
$target = $targetDir . '/' . basename($_FILES[$qNum]['name']) . '.webm';

mkdir($targetDir, 0777, true);
move_uploaded_file($_FILES[$qNum]['tmp_name'], $target);


?>