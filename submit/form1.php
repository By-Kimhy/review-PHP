<?php
$cn = new mysqli("localhost", "root", "", "review-php");
$alert = "";
// Insert Data
if (isset($_POST['submit'])) {
    // check name duplicate
    $sql = "SELECT * FROM `review-php`.`tbl_test` WHERE `name`='" . $_POST['txt-name'] . "'";
    $result = $cn->query($sql);
    if ($result->num_rows > 0) {
        $alert = "duplicate";
    } else {
        $name = $_POST['txt-name'];
        $price = $_POST['txt-price'];
        $sql = "INSERT INTO `review-php`.`tbl_test` (`name`,`price`) VALUES ('$name','$price')";
        $cn->query($sql);
        $alert = "success";
    }
}

// get last id
$sql = "SELECT MAX(id) FROM `review-php`.`tbl_test`";
$result = $cn->query($sql);
$row = $result->fetch_array();
$autoId = $row[0] + 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form1</title>
    <link rel="stylesheet" href="formstyle.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="form-page">
        <form class="modern-form" action="form1.php" method="post">
            <h1>Product Entry</h1>
            <div class="form-group">
                <label for="txt-id">ID</label>
                <input type="text" name="txt-id" id="txt-id" value="<?php echo $autoId; ?>" readonly>
            </div>
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
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
            </tr>
            <?php
            $sql = "SELECT * FROM tbl_test order by id DESC";
            $result = $cn->query($sql);
            //num_rows use for get total row
            $num = $result->num_rows;
            if ($num > 0) {
                while ($row = $result->fetch_array()) {
            ?>
                    <tr>
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[2]; ?></td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="3">No Data</td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>

</body>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    <?php if ($alert === "duplicate"): ?>
        Swal.fire({
            title: "Name Already Exist",
            text: "Please Enter Unique Name",
            icon: "error"
        });
    <?php elseif ($alert === "success"): ?>
        Swal.fire({
            title: "Success!",
            text: "Product added successfully",
            icon: "success"
        });
    <?php endif; ?>
</script>

</html>