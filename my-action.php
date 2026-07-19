<h1>
    <!-- 
    more info about the file upload at w3schools
    https://www.w3schools.com/php/php_file_upload.asp
     -->
    
    <?php
    if (isset($_POST["txt-name"])) {
        $myName = $_POST["txt-name"];
        $file = $_FILES["txt-file"];
        echo $file["name"];
        echo $file["size"];
        echo $file["type"];
        echo $file["tmp_name"];

        $imgName = $file["name"];
        echo $imgName;
        echo "<br>";
        $ext=pathinfo($imgName, PATHINFO_EXTENSION);
        echo $ext;
        echo "<br>";
        $newName=time();
        echo $newName;
        $tmp = $file["tmp_name"];
        // move the file to the folder
        move_uploaded_file($tmp, "img/" . $newName .".". $ext);
    }else{
        echo "No action";
    }
    ?>
</h1>