<?php
    $cn = new mysqli("localhost", "root", "", "review-php");
    // Insert Data
    $id = $_POST['txt-id'];
    $name = $_POST['txt-name'];
    $price = $_POST['txt-price'];
    
    $sql = "INSERT INTO `review-php`.`tbl_test` (`id`,`name`,`price`) VALUES ('$id','$name','$price')";
    $cn->query($sql);
?>