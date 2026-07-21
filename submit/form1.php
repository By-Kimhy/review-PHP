<?php
$cn = new mysqli("localhost", "root", "", "review-php");
if ($cn->connect_error) {
    die("Connection failed: " . $cn->connect_error);
}
// Insert Data
if (isset($_POST['submit'])) {
    $name = $_POST['txt-name'];
    $price = $_POST['txt-price'];
    $sql = "INSERT INTO `review-php`.`tbl_test` (`name`,`price`) VALUES ('$name','$price')";
    $cn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form1</title>
    <link rel="stylesheet" href="formstyle.css">
</head>

<body>
    <div class="form-page">
        <form class="modern-form" action="form1.php" method="post">
            <h1>Product Entry</h1>
            <!-- <div class="form-group">
                <label for="txt-id">ID</label>
                <input type="text" name="txt-id" id="txt-id" placeholder="Enter product ID">
            </div> -->
            <div class="form-group">
                <label for="txt-name">Name</label>
                <input type="text" name="txt-name" id="txt-name" placeholder="Enter product name">
            </div>
            <div class="form-group">
                <label for="txt-price">Price</label>
                <input type="text" name="txt-price" id="txt-price" placeholder="Enter product price">
            </div>
            <input class="submit-button" type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>

</html>