<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه اصلی</title>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['user_id'])){
    echo "خوش آمدید! شما با نام کاربری " . $_SESSION['username'] . " وارد شده‌اید.";
    echo "<br><a href='auth.php?logout=true'>خروج</a>";
} else {
    echo "<a href='login.php'>ورود</a> | <a href='register.php'>ثبت نام</a>";
}
?>
</body>
</html>
