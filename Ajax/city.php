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
            <input type="text" name="txt-id" id="txt-id">
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
            <input type="file" name="txt-file" id="txt-file">
            <a class="submit-btn">
                Post
            </a>
        </form>
    </div>

</body>

<script>
    $(document).ready(function() {
        $(".submit-btn").click(function() {
            var eThis = $(this);
            var Parent = eThis.closest("form.upl");
            var nameInput = Parent.find('#txt-name');
            var desInput = Parent.find('#txt-des');
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
                // dataType: "json",
                beforeSend: function() {
                    // work before success
                },
                success: function(data) {

                    Swal.fire({
                        title: "Success!",
                        text: "City added successfully",
                        icon: "success"
                    });
                }
            });
        });
    });
</script>

</html>