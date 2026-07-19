<?php
$myMenu = array(
    array("name" => "apple", "color" => "red","url"=>"https://www.apple.com/"),
    array("name" => "meta", "color" => "blue","url"=>"https://www.meta.com/"),
    array("name" => "microsoft", "color" => "green","url"=>"https://www.microsoft.com/en-us"),
    array("name" => "google", "color" => "yellow","url"=>"https://www.google.com/"),
);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PHP Array</title>
</head>

<body>
    <div class="menu-bar">
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <?php
            foreach ($myMenu as $key => $menu) {
                ?>
                <li>
                    <a href="<?php echo $menu["url"]; ?> " style="color:<?php echo $menu["color"]; ?>">
                        <?php echo $menu["name"]; ?>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>

</body>

</html>