<?php
$cn = new mysqli("localhost", "root", "", "review-php");
//get auto id
$sql = "SELECT MAX(id) FROM tbl_city";
$result = $cn->query($sql);
$row = $result->fetch_array();
$autoId = $row[0] + 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ajax.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/4.0.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>City</title>
</head>

<body>
    <h1>City List</h1>
    <div class="frm">
        <form class="upl">
            <label for="">ID</label>
            <input type="text" name="txt-id" id="txt-id" value="<?php echo $autoId; ?>" readonly>
            <label for="">City Name</label>
            <input type="text" name="txt-name" id="txt-name">
            <label for="">Description</label>
            <textarea name="txt-des" id="txt-des" cols="30" rows="10"></textarea>
            <label for="">Status</label>
            <select name="txt-status" id="txt-status">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            <label for="">Photo</label>
            <div class="img-box">
                <input type="file" name="txt-file" id="txt-file" class="txt-file">
                <input type="text" name="txt-img-name" id="txt-img-name">
            </div>
            <a class="submit-btn">
                Post
            </a>
        </form>
    </div>

</body>

<script>
    $(document).ready(function() {
        var loading = "<div class='loading'></div>";
        $(".submit-btn").click(function() {
            var eThis = $(this);
            var Parent = eThis.closest("form.upl");
            var idInput = Parent.find('#txt-id');
            var nameInput = Parent.find('#txt-name');
            var desInput = Parent.find('#txt-des');
            var fileInput = Parent.find('#txt-file');
            var imgBox = Parent.find('.img-box');
            var photo = Parent.find('#txt-img-name');
            var name = nameInput.val();
            var des = desInput.val();

            if (name === '') {
                alert("Please enter city name");
                nameInput.focus();
                return;
            }
            if (des === '') {
                alert("Please enter city description");
                desInput.focus();
                return;
            }


            var frm = eThis.closest("form.upl");
            var frm_data = new FormData(frm[0]);
            $.ajax({
                url: "save-city.php",
                type: "POST",
                data: frm_data,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    if (data.error) {
                        Swal.fire({
                            title: "Error",
                            text: data.error,
                            icon: "error"
                        });
                        return;
                    }

                    if (data.dpl === true) {
                        Swal.fire({
                            title: "City Name Already Exists",
                            text: "Please enter a unique name.",
                            icon: "error"
                        }).then(() => {
                            nameInput.val("");
                            nameInput.focus();
                        });
                    } else {
                        Swal.fire({
                            title: "Success!",
                            text: "City added successfully",
                            icon: "success",
                        }).then(() => {
                            nameInput.val("");
                            desInput.val("");
                            fileInput.val("");
                            // reset preview box back to default
                            imgBox.css({
                                'background-image': 'url(../img/bg-img.png)'
                            });
                            photo.val("");
                            idInput.val(data.id + 1);
                            nameInput.focus();
                        });
                    }
                },
                error: function(xhr, status, err) {
                    console.error("Ajax error:", status, err, xhr.responseText);
                    Swal.fire({
                        title: "Request failed",
                        text: "Check browser console and server response.",
                        icon: "error"
                    });
                }
            });
        });

        $(".txt-file").change(function() {
            var eThis = $(this);
            var Parent = eThis.closest('.frm');
            var imgBox = Parent.find('.img-box');
            var photo = Parent.find('#txt-img-name');
            var frm = eThis.closest("form.upl");
            var frm_data = new FormData(frm[0]);
            $.ajax({
                url: "upl-img.php",
                type: "POST",
                data: frm_data,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function() {
                    // imgBox.html(loading);
                    imgBox.append(loading);
                },
                success: function(data) {
                    imgBox.css({
                        'background-image': 'url(../img/' + data.imgName + ')'
                    });
                    // imgBox.html("");
                    imgBox.find(".loading").remove();
                    photo.val(data.imgName);
                }
            });
        });
    });
</script>

</html>