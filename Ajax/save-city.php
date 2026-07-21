<?php
$cn = new mysqli("localhost", "root", "", "review-php");
// $sql="INSERT INTO tbl_city values(null,'Phnom Penh','Phnom Penh Des','123.img','1');";
// $cn->query($sql);

$name = $_POST['txt-name'];
$des = $_POST['txt-des'];
$img = "123.jpg";
$status = $_POST['txt-status'];

$sql = "INSERT INTO tbl_city values(null,'$name','$des','$img','$status')";
header('Content-Type: application/json');
// $cn->query($sql);

if ($cn->query($sql)) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $cn->error]);
}

