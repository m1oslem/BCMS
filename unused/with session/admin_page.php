<?php
session_start();

// التحقق من الجلسة
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.html?error=4"); // إعادة التوجيه إلى صفحة تسجيل الدخول مع رسالة خطأ
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مراقبة فروع مصرف الثقة</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Tajawal', Arial, sans-serif;
            background: url('images/background.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            text-align: center;
            background: rgba(0, 0, 0, 0.6);
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
            max-width: 500px;
            width: 90%;
        }

        .logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .logo img {
            width: 80%;
            height: 80%;
            object-fit: contain;
        }

        h1, h2, p {
            color: #fff;
            margin-bottom: 20px;
        }

        button {
            width: 80%;
            padding: 15px;
            margin: 10px 0;
            font-size: 1.1rem;
            color: #fff;
            background: rgba(0, 123, 255, 0.8);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        button:hover {
            background: rgba(0, 123, 255, 1);
            transform: translateY(-3px);
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
        <div class="logo">
            <img src="images/logo.png" alt="شعار الشركة">
        </div>
        <h1>مصرف الثقة الدولي الإسلامي</h1>
        <h2>النظام الخاص بمراقبة الفروع</h2>
        <p>مرحباً، <?php echo htmlspecialchars($_SESSION['username']); ?>! اختر الصفحة التي ترغب في زيارتها:</p>
        <button onclick="window.location.href='bm.php'">الصفحة العامة لإدارة الفروع</button>
        <button onclick="window.location.href='manger.php'">الصفحة الخاصة بالمدراء</button>
        <button onclick="window.location.href='casher.php'">الصفحة الخاصة بالصناديق</button>
        <button onclick="window.location.href='admin.php'">إدارة المستخدمين</button>
        <button onclick="window.location.href='logout.php'">تسجيل الخروج</button>
    </div>

    <footer>
        <p>Powered by <strong><a href="https://www.m1oslem.com" target="_blank">Eng Muslim Al-Shamary</a></strong></p>
    </footer>

    <!-- تعطيل الوصول إلى أدوات المطور -->
    <script>
        document.addEventListener("contextmenu", (event) => {
            event.preventDefault();
            alert("النقر بزر الفأرة الأيمن معطل.");
        });
        document.addEventListener("keydown", (event) => {
            if (
                event.key === "F12" || 
                (event.ctrlKey && event.shiftKey && (event.key === "I" || event.key === "J" || event.key === "C")) ||
                (event.ctrlKey && event.key === "U")
            ) {
                event.preventDefault();
                alert("اختصار معطل!");
            }
        });
    </script>
</body>
</html>
