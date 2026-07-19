<h1>
    <?php
    if (isset($_POST["txt-name"])) {
        $myName = $_POST["txt-name"];
        $file = $_FILES["txt-file"];
        echo $file["name"];
        echo $file["size"];
        echo $file["type"];
        echo $file["tmp_name"];
        $tmp = $file["tmp_name"];
        // move the file to the folder
        move_uploaded_file($tmp, "img/" . $file["name"]);
    }else{
        echo "No action";
    }
    ?>
</h1>