<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
</head>
<body>
<h2>ثبت نام</h2>
<form action="auth.php" method="post">
    <input type="hidden" name="action" value="register">

    نام کاربری: <input type="text" name=":username" required><br>
    رمز عبور: <input type="password" name="password" required><br>
    <input type="submit" value="ثبت نام">
</form>
</body>
</html>

