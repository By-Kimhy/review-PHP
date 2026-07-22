<?php
$cn = new mysqli("localhost", "root", "", "review-php");
// $sql="INSERT INTO tbl_city values(null,'Phnom Penh','Phnom Penh Des','123.img','1');";
// $cn->query($sql);

// check name duplicate
$sql = "SELECT * FROM `review-php`.`tbl_city` WHERE `name_city`='" . $_POST['txt-name'] . "'";
$result = $cn->query($sql);
if ($result->num_rows > 0) {
    $msg['dpl'] = true;
} else {
    $msg['dpl'] = false;
    $name = $_POST['txt-name'];
    $des = $_POST['txt-des'];
    $img = "123.jpg";
    $status = $_POST['txt-status'];

    $sql = "INSERT INTO tbl_city values(null,'$name','$des','$img','$status')";
    $cn->query($sql);
    $last_id = $cn->insert_id;
    $msg['id'] = $last_id;
}
echo json_encode($msg);

// header('Content-Type: application/json');
// if ($cn->query($sql)) {
//     echo json_encode(["status" => "success"]);
// } else {
//     echo json_encode(["status" => "error", "message" => $cn->error]);
// }
