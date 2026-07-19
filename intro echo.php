<?php
$i = 10;
$x = 10;
$y = 20;
$color = "hotpink";
$title = "My website Title PHP";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
</head>

<body>
    <?php
    $title = "Document Title PHP";
    echo $title;
    echo "<br>";
    echo "Hello PHP";
    echo 123;
    echo "<br>";
    echo "123" . "hello PHP";
    echo "<h1 style='color:" . $color . "'>Hello PHP</h1>";
    echo "<h1 style='color:$color'>Hello PHP</h1>";

    ?>
    <!-- use this style to print the string with tags HTML -->
    <h1 style='color:<?php echo $color; ?>'>
        <?php echo "Hello PHP"; ?>
    </h1>

    <?php
    $box = "My Box";
    echo $box;
    echo "<br>";
    ?>
    <?php
    echo $i;
    $i = 100;
    echo "<br>";
    echo $i + $y;
    echo "<br>";
    ?>

    
</body>

</html>