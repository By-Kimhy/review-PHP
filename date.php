<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date</title>
</head>
<body>
    <h1>
        <!-- 
            d-day of the month, 2 digits with leading zeros
            m-month, numeric (01..12)
            Y-year, numeric, 4 digits
            H-hour (00..23)
            i-minute, numeric (00..59)
            s-second, numeric (00..59)
            l-day of the week (0..6) where 0 is Sunday and 6 is Saturday
            F-month, numeric (1..12)
            j-day of the month, numeric (001..31) 
        -->
        <?php
            // we need to set the timezone if not set default timezone is not Asia/Phnom_Penh
            date_default_timezone_set("Asia/Phnom_Penh");
            echo "Today is " . date("Y/m/d")."<br>";
            echo "Today is " . date("Y-m-d")."<br>";
            echo "Today is " . date("Y-M-d")."<br>";
            echo "Today is " . date("Y-m-d")."<br>";
            echo "Today is " . date("Y-m-d H:i:s")."<br>";
            echo "Today is " . date("l, F j, Y")."<br>";
            echo "Today is " . date("l, F j, Y H:i:s")."<br>";
        ?>
    </h1>
</body>
</html>