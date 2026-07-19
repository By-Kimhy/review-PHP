<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Condition</title>
</head>

<body>
    <!-- condition -->
    <?php
    $x = 12;
    if ($x > 10) {
        echo "x is greater than 10";
    } else {
        echo "x is less than 10";
    }
    ?>
    <!-- use other style to print the string with tags HTML -->
    <?php
    $x = 5;
    if ($x > 10) {
    ?>

        <h1>x is greater than 10</h1>
    <?php
    } else {
    ?>
        <h1>x is less than 10</h1>
    <?php
    }
    ?>
    <!-- condition if elseif else -->
    <?php
    if ($x > 10) {
        echo "x is greater than 10";
    } elseif ($x < 10) {
        echo "x is less than 10";
    } else {
        echo "x is equal to 10";
    }
    ?>
</body>

</html>