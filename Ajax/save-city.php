<?php
$cn = new mysqli("localhost", "root", "", "review-php");
$id = $_POST['txt-id'];
$name = $cn->real_escape_string(trim($_POST['txt-name']));
$des=trim($_POST['txt-des']);
$des = str_replace("\n", "<br>", $des);
$des= $cn->real_escape_string($des);
$img = "123.jpg";
$status = $_POST['txt-status'];

// check name duplicate
$sql = 'SELECT * FROM tbl_city WHERE name_city="$name" || id!="$id"';
$result = $cn->query($sql);
if ($result->num_rows > 0) {
    $msg['dpl'] = true;
} else {
    $msg['dpl'] = false;


    $sql = "INSERT INTO tbl_city values(null,'$name','$des','$img','$status')";
    $cn->query($sql);
    $last_id = $cn->insert_id;
    $msg['id'] = $last_id;
}
header('Content-Type: application/json');
echo json_encode($msg);

// header('Content-Type: application/json');
// if ($cn->query($sql)) {
//     echo json_encode(["status" => "success"]);
// } else {
//     echo json_encode(["status" => "error", "message" => $cn->error]);
// }
