<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PHP Array</title>
</head>

<body>
    <h2>Index Array</h2>
    <!-- Note: Index array use to store data with index -->
    <h1>
        <?php
        $city = array("Phnom Penh", "Siem Reap", "Cambodia");
        echo $city[0] . "<br>";
        foreach ($city as $myCity) {
        ?>

            <div class="box">
                <?php echo $myCity; ?>
            </div>
        <?php
        }
        ?>
    </h1>


    <h2>Associative Array</h2>
    <!-- Note: Associative array use to store data with key and value -->
    <?php
    $year = array("php" => "1995", "asp" => "2002", "jsp" => "1999");
    ?>
    <h2> <?php echo $year["php"]; ?></h2>
    <?php
    foreach ($year as $key => $value) {
    ?>
        <div class="box">
            <?php echo $key . ": " . $value; ?>
        </div>
    <?php
    }
    ?>

    <h2>Multidimensional Array</h2>
    <!-- Note: Multidimensional array use to store data with more than one dimension -->
    <?php
    $menu = array(
        array("name" => "Breakfast", "price" => "100", "color" => "red"),
        array("name" => "Lunch", "price" => "200", "color" => "blue"),
        array("name" => "Dinner", "price" => "300", "color" => "green")
    );

    ?>
    <h2> <?php echo $menu[1]["name"] . ":" . $menu[1]["price"]; ?></h2>
    <?php
    foreach ($menu as $key => $value) {
    ?>
        <div class="box" style="background-color:<?php echo $value["color"]; ?>">
            <?php echo $value["name"] . ": " . $value["price"]; ?>
        </div>
    <?php
    }
    ?>


</body>

</html>