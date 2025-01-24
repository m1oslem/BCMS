<?php
session_start();

// التحقق من الجلسة والصلاحيات
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.html?error=4"); // إعادة التوجيه إلى صفحة تسجيل الدخول مع رسالة خطأ
    exit();
}

// تفعيل عرض الأخطاء للتصحيح
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("خطأ في الاتصال: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = intval($_POST['id']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // التحقق من الحقول المطلوبة
    if (empty($username) || empty($password) || empty($role)) {
        $error = "جميع الحقول مطلوبة.";
    } else {
        // تشفير كلمة المرور
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // استعلام لتحديث المستخدم
        $sql = "UPDATE users SET username = ?, password = ?, role = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $hashed_password, $role, $userId);

        if ($stmt->execute()) {
            header("Location: admin.php?success=تم تحديث بيانات المستخدم بنجاح.");
            exit();
        } else {
            $error = "حدث خطأ أثناء تحديث البيانات.";
        }

        $stmt->close();
    }
}

if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);
    $sql = "SELECT id, username, role FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($id, $username, $role);
    $stmt->fetch();
    $stmt->close();
} else {
    header("Location: admin.php?error=معرف المستخدم غير صالح.");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل المستخدم</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Tajawal', Arial, sans-serif;
            background: url('images/background.jpg') no-repeat center center/cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .container {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
            max-width: 400px;
            width: 90%;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input, select, button {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 1rem;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        button {
            background: rgba(0, 123, 255, 0.8);
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: rgba(0, 123, 255, 1);
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>تعديل بيانات المستخدم</h1>

        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="text" name="username" placeholder="اسم المستخدم" value="<?php echo htmlspecialchars($username); ?>" required>
            <input type="password" name="password" placeholder="كلمة المرور" required>
            <select name="role" required>
                <option value="admin" <?php echo $role === 'admin' ? 'selected' : ''; ?>>مدير نظام</option>
                <option value="manager" <?php echo $role === 'manager' ? 'selected' : ''; ?>>مجلس إدارة</option>
                <option value="user" <?php echo $role === 'user' ? 'selected' : ''; ?>>مدير إدارة فروع</option>
                <option value="employ" <?php echo $role === 'employ' ? 'selected' : ''; ?>>موظف إدارة فروع</option>
            </select>
            <button type="submit">تحديث</button>
        </form>

        <a href="admin.php" class="back-link">عودة إلى لوحة الإدارة</a>
    </div>
</body>
</html>
