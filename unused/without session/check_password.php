<?php
session_start();

// الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("خطأ في الاتصال: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        header("Location: index.html?error=حقول فارغةد");
        exit();
    }

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            switch ($user['role']) {
                case 'admin':
                    header("Location: admin_page.php");
                    break;
                case 'manager':
                    header("Location: editor_page.php");
                    break;
                case 'user':
                    header("Location: viewer_page.php");
                    break;
                case 'employ':
                    header("Location: bm.html");
                    break;
                default:
                {header("Location: index.html?error=ليس لديك صلاحية");
                    
                    break;}
                    
            }
            exit();
        } else {
            header("Location: index.html?error=كلمة مرور خاطئة");
            exit();
        }
    } else {
        header("Location: index.html?error=مستخدم غير موجود");

        exit();
    }
}

$conn->close();
?>
