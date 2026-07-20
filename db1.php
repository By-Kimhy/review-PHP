<!-- 1- Connection -->
<?php
$cn = new mysqli("localhost", "root", "", "review-php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Datanase</title>
</head>

<body>
    <h1>PHP Datanase</h1>
    <h2>Insert Data</h2>
    <?php
    // $sql = "INSERT INTO `review-php`.`tbl_test` VALUES (null,'css',20)";
    // // $sql="INSERT INTO `review-php`.`tbl_test` (`id`,`name`,`price`) VALUES (1,'html',10)";
    // // if($cn->query($sql)){
    // //     echo "Data Inserted";
    // // }
    // // else{
    // //     echo "Data Not Inserted";
    // // }
    // $cn->query($sql);
    ?>

    <h2>Update Data</h2>
    <?php
    // $sql = "UPDATE `review-php`.`tbl_test` SET `name`='CSS' WHERE `id`=1";
    // $cn->query($sql);
    ?>

    <h2>Delete Data</h2>
    <?php
    $sql = "DELETE FROM `review-php`.`tbl_test` WHERE `id`=5";
    $cn->query($sql);
    ?>

    <h2>Select Data</h2>
    <table border="1" width="80%">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
        </tr>
        <?php
        $sql = "SELECT * FROM tbl_test order by id LIMIT 0,5";
        $result = $cn->query($sql);
        $total = 0;
        //num_rows use for get total row
        $num = $result->num_rows;
        if ($num > 0) {
            while ($row = $result->fetch_array()) {
                $total = $total + $row[2];
        ?>
                <tr>
                    <td><?php echo $row[0]; ?></td>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                </tr>
        <?php
            }
        } else {
            echo "No Data";
        }
        ?>


        <tr>
            <td colspan="2">Total</td>
            <td><?php echo $total; ?></td>
        </tr>
    </table>
</body>

</html>