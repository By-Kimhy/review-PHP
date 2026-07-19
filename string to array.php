<?php
 include "header.php";
?>
<body>
    <!-- Note: explode use to split the string -->
    <h1>
        <?php
            $str = "apple banana orange";
            $array = explode(" ", $str);
            // print_r($array);
            echo "<br>";
            echo $array[0];
        ?>
    </h1>
    <?php
        $strImg='1-1.webp,1-2.webp,2-1.webp,2-2.webp,3-1.webp,3-2.webp';
        $arrayImg = explode(",", $strImg);
        foreach ($arrayImg as $key => $img) {
            ?>
            <div class="img-box">
                <img src="img/<?php echo $img; ?>">
            </div>
        <?php
        }
    ?>
</body>

</html>