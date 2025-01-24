<?php
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

// معالجة إرسال النموذج
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // التحقق من الحقول المطلوبة
    if (empty($username) || empty($password) || empty($role)) {
        $error = "جميع الحقول مطلوبة.";
    } else {
        // تشفير كلمة المرور
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // إدخال البيانات في قاعدة البيانات
        $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $hashed_password, $role);

        if ($stmt->execute()) {
            header("Location: admin_page.php?success=تم إضافة المستخدم بنجاح.");
            exit();
        } else {
            $error = "حدث خطأ أثناء إضافة المستخدم.";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة مستخدم جديد</title>
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
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            padding: 1px 0;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>إضافة مستخدم جديد</h1>

        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="text" name="username" placeholder="اسم المستخدم" required>
            <input type="password" name="password" placeholder="كلمة المرور" required>
            <select name="role" required>
                <option value="">اختر الصلاحية</option>
                <option value="admin">مدير نظام</option>
                <option value="manager">مجسل ادارة</option>
                <option value="user">مدير ادارة فروع</option>
                <option value="employ">موظف ادارة فروع</option>
            </select>
            <button type="submit">إضافة</button>
        </form>

        <a href="admin.php" class="back-link">عودة إلى لوحة الإدارة</a>
    </div>
    
</body>
<footer>
    <p>Powered by <strong><a href="https://www.m1oslem.com" target="_blank">Eng Muslim Al-Shamary</a></strong></p>
</footer>

</script>
</html>
