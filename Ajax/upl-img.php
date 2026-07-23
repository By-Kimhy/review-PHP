<?php
header('Content-Type: application/json');
$msg = [];

if (!isset($_FILES["txt-file"]) || empty($_FILES["txt-file"]["name"])) {
    $msg['error'] = 'No file selected for upload.';
    echo json_encode($msg);
    exit;
}

$file = $_FILES["txt-file"];
$imgName = $file["name"];
$ext = pathinfo($imgName, PATHINFO_EXTENSION);
$newName = time();
$tmp = $file["tmp_name"];
$target = "../img/" . $newName . "." . $ext;

if (!move_uploaded_file($tmp, $target)) {
    $msg['error'] = 'Failed to save uploaded image.';
    echo json_encode($msg);
    exit;
}

$msg['imgName'] = $newName . "." . $ext;
echo json_encode($msg);
?>