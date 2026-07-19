<?php
include "header.php";
?>
<body>
    <form action="my-action.php" method="POST" enctype="multipart/form-data">
        <label for="">Student Name</label>
        <input type="text" name="txt-name" id="">
        <label for="">Upload Image</label>
        <input type="file" name="txt-file">
        <input type="submit" value="Post" name="txt-post">
    </form>
</body>
</html>