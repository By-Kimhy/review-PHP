<?php
$cn = new mysqli("localhost", "root", "", "review-php");
$sql = "SELECT * FROM tbl_city ORDER BY id DESC";
$result = $cn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_array()) {
        echo "<tr>";
        echo "<td>{$row[0]}</td>";
        echo "<td>{$row[1]}</td>";
        echo "<td>{$row[2]}</td>";
        echo "<td><img src='../img/{$row[3]}' style='width:100px;height:100px;'></td>";
        echo "<td>{$row[4]}</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5' style='text-align:center;color:red;font-weight:bold;'>No Data</td></tr>";
}
?>
