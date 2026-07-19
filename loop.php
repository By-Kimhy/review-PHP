<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loop</title>
</head>

<body>
    <!-- For loop -->
    <h1>
        <?php
        for ($i = 0; $i < 5; $i++) {
            echo $i . "<br>";
        }
        ?>
    </h1>
    <!-- while loop -->
     <h1>
        <?php
        $i = 0;
        while ($i < 5) {
            echo $i . "<br>";
            $i++;
        }
        ?>
    </h1>
    <!-- do while loop -->
     <h1>
        <?php
        $i = 0;
        do {
            echo $i . "<br>";
            $i++;
        } while ($i < 5);
        ?>
    </h1>
    <!-- foreach loop -->
     <!-- Note: foreach use to loop through the array -->
    <h1>
        <?php
        $array = array("PHP", "JavaScript", "HTML", "CSS");
        echo $array[1] . "<br>";

        foreach ($array as $value) {
            echo $value . "<br>";
        }
        ?>
    </h1>
</body>

</html>