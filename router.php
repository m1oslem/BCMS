<?php
session_start();

// تحقق من الجلسة
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: index.html?error=6"); // إعادة توجيه إلى صفحة تسجيل الدخول
    exit();
}

// تحديث وقت النشاط الأخير
$_SESSION['last_activity'] = time();

// توجيه المستخدم بناءً على الدور
switch ($_SESSION['role']) {
    case 'admin':
        $defaultPage = 'admin_page.php';
        break;
    case 'manager':
        $defaultPage = 'bod.php';
        break;
    case 'user':
        $defaultPage = 'mbm.php';
        break;
    case 'employ':
        $defaultPage = 'bm.php';
        break;
    default:
        header("Location: index.html?error=3"); // دور غير معروف
        exit();
}

// الحصول على المسار المطلوب
$requestUri = trim($_SERVER['REQUEST_URI'], '/');
$filePath = __DIR__ . '/' . $requestUri;

// إذا كان المستخدم يحاول الوصول إلى صفحة مباشرة
if ($requestUri !== '' && file_exists($filePath) && is_file($filePath)) {
    include $filePath;
} else {
    // إذا لم يحدد أي صفحة أو حاول الوصول لصفحة غير موجودة، قم بتوجيهه للصفحة الافتراضية
    header("Location: $defaultPage");
    exit();
}
?>
