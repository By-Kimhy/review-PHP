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
                <input type="text" name="txt-edit-id" id="txt-edit-id" value="0" hidden>
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
                    <input type="hidden" name="txt-img-name" id="txt-img-name">
                </div>
                <a class="submit-btn">
                    Post
                </a>
            </form>
        </div>
        <table id="tblData" class=".table">
            <thead>
                <tr>
                    <th width="10%">ID</th>
                    <th width="20%">Name</th>
                    <th width="30%">Description</th>
                    <th width="10%">Photo</th>
                    <th width="10%">Status</th>
                    <th width="10%">Action</th>
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
                            <td width="10%"><?php echo $row[0]; ?></td>
                            <td width="15%"><?php echo $row[1]; ?></td>
                            <td width="30%"><?php echo $row[2]; ?></td>
                            <td width="10%">
                                <img src="../img/<?php echo $row[3]; ?>" alt="<?php echo $row[3]; ?>" style="width: 100px; height: 100px;">
                            </td>
                            <td width="10%">
                                <!-- if status=1 show active else inactive -->
                                <?php if ($row[4] == 1) { ?>
                                    <span data-status="1">Active</span>
                                <?php } else { ?>
                                    <span data-status="0">Inactive</span>
                                <?php } ?>
                            </td>
                            <td width="15%">
                                <input type="button" class="action-btn edit-btn" value="Edit" onclick="editCity(<?php echo $row[0]; ?>)">
                                <input type="button" class="action-btn delete-btn" value="Delete" onclick="deleteCity(<?php echo $row[0]; ?>)">
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6" style="text-align: center; color: red;font-weight: bold;">No Data</td>
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
                var tbl = $("#tblData");
                var loading = "<div class='loading'></div>";
                var ind;
                // edit city
                tbl.on("click", ".edit-btn", function() {
                    var eThis = $(this);
                    var tr = eThis.parents("tr");
                    var id = tr.find("td:eq(0)").text();
                    var name = tr.find("td:eq(1)").text();
                    var des = tr.find("td:eq(2)").text();
                    var photo = tr.find("td:eq(3)").find("img").attr("src");
                    var status = tr.find("td:eq(4) span").data("status");
                    var imgFileName = photo ? photo.split('/').pop() : "";

                    $("#txt-id").val(id);
                    $("#txt-name").val(name);
                    $("#txt-des").val(des);
                    $("#txt-status").val(status);
                    $("#txt-file").val("");
                    $("#txt-img-name").val(imgFileName);
                    $(".img-box").css({
                        'background-image': 'url(' + photo + ')'
                    });
                    $("#txt-edit-id").val(id);
                    ind = tr.index();
                });
                $(".submit-btn").click(function() {
                        var eThis = $(this);
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
                                        if (data.edit == true) {
                                            tbl.find("tbody tr:eq(" + ind + ")").find("td:eq(1)").text(name);
                                            tbl.find("tbody tr:eq(" + ind + ")").find("td:eq(2)").text(des);
                                            var imgName = photo.val();
                                            if (imgName) {
                                                tbl.find("tbody tr:eq(" + ind + ")").find("td:eq(3)").find("img").attr("src", "../img/" + imgName);
                                            }
                                            var statusText = status == 1 ? "Active" : "Inactive";
                                            tbl.find("tbody tr:eq(" + ind + ")").find("td:eq(4) span").text(statusText).attr("data-status", status);
                                            Swal.fire({
                                                title: "Success!",
                                                text: "City updated successfully",
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
                                                const statusBadge = status == 1 ?
                                                    `<span data-status="1">Active</span>` :
                                                    `<span data-status="0">Inactive</span>`;
                                                var tr = `<tr>
                                            <td>${data.id}</td>
                                            <td>${name}</td>
                                            <td>${des}</td>
                                            <td><img src="../img/${photo.val()}" style="width:100px;height:100px;"></td>
                                            <td>
                                                ${statusBadge}
                                            </td>
                                            <td>
                                                <input type="button" class="action-btn edit-btn" value="Edit" onclick="editCity(${data.id})">
                                                <input type="button" class="action-btn delete-btn" value="Delete" onclick="deleteCity(${data.id})">
                                            </td>
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

                                            });
                                        }
                                        eThis.html("Post");
                                        eThis.css({
                                            "pointer-events": "auto"
                                        });
                                    }

                                }
                        });
                    })

                    $(".txt-file").change(function() {
                        var eThis = $(this);
                        var Parent = eThis.closest('.frm');
                        var imgBox = Parent.find('.img-box');
                        var photo = Parent.find('#txt-img-name');
                        var frm = eThis.closest("form.upl");
                        var frm_data = new FormData(frm[0]);
                        var file = eThis[0].files[0];

                        if (file) {
                            var reader = new FileReader();
                            reader.onload = function(event) {
                                imgBox.css({
                                    'background-image': 'url(' + event.target.result + ')'
                                });
                            };
                            reader.readAsDataURL(file);
                        }

                        imgBox.find(".loading").remove();
                        imgBox.append(loading);

                        $.ajax({
                            url: "upl-img.php",
                            type: "POST",
                            data: frm_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            dataType: "json",
                            success: function(data) {
                                imgBox.find(".loading").remove();
                                if (data.imgName) {
                                    imgBox.css({
                                        'background-image': 'url(../img/' + data.imgName + ')'
                                    });
                                    photo.val(data.imgName);
                                } else if (data.error) {
                                    Swal.fire({
                                        title: "Upload failed",
                                        text: data.error,
                                        icon: "error"
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                imgBox.find(".loading").remove();
                                Swal.fire({
                                    title: "Upload error",
                                    text: error || "Unable to upload image.",
                                    icon: "error"
                                });
                            }
                        });
                    });
                });
</script>

</html>