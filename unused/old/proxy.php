<?php
// تحقق إذا كانت هناك معلمات في URL
if (isset($_GET['path'])) {
    $path = $_GET['path'];

    // توجيه الطلبات إلى السيرفر الخارجي مع الحفاظ على الرابط
    $redirectUrl = "http://172.16.19.201/$path";
    header("Location: $redirectUrl");
    exit();
} else {
    // عرض خطأ إذا لم يكن هناك معلمات
    header("HTTP/1.1 400 Bad Request");
    echo "Bad Request: Path not specified.";
}
