<?php
session_start();

// التحقق من وجود جلسة
if (isset($_SESSION['username'])) {
    // إنهاء الجلسة
    session_unset();
    session_destroy();
}

// إعادة التوجيه إلى صفحة تسجيل الدخول
header("Location: index.html?success=تم تسجيل الخروج بنجاح.");
exit();
?>
