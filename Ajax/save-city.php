<?php
$cn = new mysqli("localhost", "root", "", "review-php");
$id = $_POST['txt-id'];
$name = $cn->real_escape_string(trim($_POST['txt-name']));
$des=trim($_POST['txt-des']);
$des = str_replace("\n", "<br>", $des);
$des= $cn->real_escape_string($des);
$img = $_POST['txt-img-name'];
$status = $_POST['txt-status'];
$edit_id = $_POST['txt-edit-id'];
$msg["edit"] = false;
// if edit and no image name is provided, keep existing image filename
if ($edit_id != 0 && empty($img)) {
    $sql = "SELECT img FROM tbl_city WHERE id='$edit_id'";
    $result = $cn->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        $img = $row['img'];
    }
}

// check name duplicate, excluding current edit row
$sql = "SELECT * FROM tbl_city WHERE name_city='$name'";
if ($edit_id != 0) {
    $sql .= " AND id!='$edit_id'";
}
$result = $cn->query($sql);
if ($result->num_rows > 0) {
    $msg['dpl'] = true;
} else {
    $msg['dpl'] = false;
    if ($edit_id == 0) {
        $sql = "INSERT INTO tbl_city values(null,'$name','$des','$img','$status')";
        $cn->query($sql);
        $last_id = $cn->insert_id;
        $msg['id'] = $last_id;
    } else {
        $sql = "UPDATE tbl_city SET 
        name_city='$name', des_city='$des', img='$img',status='$status' 
        WHERE id='$edit_id'";
        $cn->query($sql);
        $last_id = $cn->insert_id;
        $msg["edit"] = true;
    }
}
header('Content-Type: application/json');
echo json_encode($msg);
