<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flagctf";

// اتصال به دیتابیس
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // جستجوی کاربر در دیتابیس
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
    } else {
        echo "نام کاربری یا رمز عبور اشتباه است.";
    }
} elseif(isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
} else {
    echo "دسترسی غیر مجاز!";
}

$conn = null;
?>
<?php
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // هش کردن رمز عبور (بهتر است از bcrypt استفاده شود)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // اتصال به دیتابیس
    $servername = "localhost";
    $dbUsername = "نام‌کاربری-دیتابیس";
    $dbPassword = "رمز-عبور-دیتابیس";
    $dbname = "users";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbUsername, $dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // افزودن کاربر به دیتابیس
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES ($username, $password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();

        echo "کاربر با موفقیت ثبت نام شد.";
    } catch(PDOException $e) {
        echo "خطا: " . $e->getMessage();
    }

    $conn = null;
} else {
    echo "لطفا نام کاربری و رمز عبور را وارد کنید.";
}
?>

