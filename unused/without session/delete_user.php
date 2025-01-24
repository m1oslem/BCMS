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

// معالجة الحذف
if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);

    // استعلام لحذف المستخدم
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        header("Location: admin_page.php?success=تم حذف المستخدم بنجاح.");
        exit();
    } else {
        header("Location: admin_page.php?error=حدث خطأ أثناء حذف المستخدم.");
        exit();
    }

    $stmt->close();
} else {
    header("Location: admin_page.php?error=معرف المستخدم غير صالح.");
    exit();
}

$conn->close();
?>
