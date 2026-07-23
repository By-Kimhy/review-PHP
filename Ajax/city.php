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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/4.0.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./ajax.css">
    <title>City</title>
</head>

<body>
    <div class="container">
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
        <table id="tblData">
            <tr>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM tbl_city order by id DESC";
                    $result = $cn->query($sql);
                    //num_rows use for get total row
                    $num = $result->num_rows;
                    if ($num > 0) {
                        while ($row = $result->fetch_array()) {
                    ?>
                            <tr>
                                <td><?php echo $row[0]; ?></td>
                                <td><?php echo $row[1]; ?></td>
                                <td><?php echo $row[2]; ?></td>
                                <td>
                                    <img src="../img/<?php echo $row[3]; ?>" alt="<?php echo $row[3]; ?>" style="width: 100px; height: 100px;">
                                </td>
                                <td><?php echo $row[4]; ?></td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5" style="text-align: center; color: red;font-weight: bold;">No Data</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
        </table>
    </div>

</body>

<script>
    $(document).ready(function() {
        var loading = "<div class='loading'></div>";
        $(".submit-btn").click(function() {
            var eThis = $(this);
            var tbl=$("#tblData");
            var Parent = eThis.closest("form.upl");
            var idInput = Parent.find('#txt-id');
            var nameInput = Parent.find('#txt-name');
            var desInput = Parent.find('#txt-des');
            var fileInput = Parent.find('#txt-file');
            var imgBox = Parent.find('.img-box');
            var photo = Parent.find('#txt-img-name');
            var statusInput = Parent.find('#txt-status');
            var status = statusInput.val();
            var name = nameInput.val();
            var des = desInput.val();

            if (name === '') {
                alert("Please enter city name");
                nameInput.focus();
                eThis.html("Post");
                eThis.css({
                    "pointer-events": "auto"
                });
                return;
            }
            if (des === '') {
                alert("Please enter city description");
                desInput.focus();
                eThis.html("Post");
                eThis.css({
                    "pointer-events": "auto"
                });
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
                beforeSend: function() {
                    eThis.html("Wait...");
                    eThis.css({
                        "pointer-events": "none"
                    });

                },
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
                            eThis.html("Post");
                            eThis.css({
                                "pointer-events": "auto"
                            });
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

                            var tr = `<tr>
                                            <td>${data.id}</td>
                                            <td>${name}</td>
                                            <td>${des}</td>
                                            <td><img src="../img/${photo.val()}" style="width:100px;height:100px;"></td>
                                            <td>${status}</td>
                                        </tr>`;
                            tbl.find("tr:eq(0)").after(tr);

                            // var $newRow = $(`
                            //                 <tr>
                            //                     <td>${data.id}</td>
                            //                     <td>${name}</td>
                            //                     <td>${des}</td>
                            //                     <td><img src="../img/${photo.val()}" style="width:100px;height:100px;"></td>
                            //                     <td>${status}</td>
                            //                 </tr>`);
                            // $("table tbody").prepend($newRow);
                            // $newRow.remove();
                            photo.val("");
                            idInput.val(data.id + 1);
                            nameInput.focus();
                            eThis.html("Post");
                            eThis.css({
                                "pointer-events": "auto"
                            });
                        });
                    }
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