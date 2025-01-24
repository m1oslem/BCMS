<?php
session_start();

// التحقق من الجلسة
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: index.html?error=4"); // إعادة التوجيه إلى صفحة تسجيل الدخول مع رسالة خطأ
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التحقق - الصفحة العامة </title>
    <style>
        /* تصميم عام */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Cairo', Arial, sans-serif;
            background: url('images/background.jpg') no-repeat center center/cover; /* تعديل الرابط إلى الصورة المحلية */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        /* الحاوية الرئيسية */
        .container {
            text-align: center;
            background: rgba(0, 0, 0, 0.6);
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
            max-width: 500px;
            width: 90%;
        }

      
        /* الإدخال */
        input {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            margin-bottom: 20px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* الزر */
        button {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            color: #fff;
            background: rgba(0, 123, 255, 0.8);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        button:hover {
            background: rgba(0, 123, 255, 1);
        }

        /* رسالة التحذير */
        .error {
            color: red;
            font-size: 0.9rem;
            display: none;
            margin-top: 10px;
        }

        /* الدروب ليست */
        .dropdown {
            margin-top: 20px;
        }

        select {
            width: 100%;
            padding: 15px;
            font-size: 1.1rem;
            color: #333;
            background: linear-gradient(145deg, #f5f7fa, #e4e9f0);
            border: 2px solid #bbb;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        select:hover {
            background: linear-gradient(145deg, #e4e9f0, #f5f7fa);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        select:focus {
            outline: none;
            border: 2px solid #007bff;
            background: #fff;
        }

        /* تعديل زر الاختيار */
        option {
            padding: 15px;
            background-color: #f5f7fa;
        }

        option:hover {
            background-color: #e4e9f0;
        }

        /* حواف ناعمة */
        .dropdown select, .dropdown button {
            border-radius: 10px;
            transition: all 0.3s ease;
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


    <div class="container" >
        <!-- الصفحة الرئيسية مع الفروع -->
        <h1>مرحبًا بك في نظام مراقبة ادارة الفروع</h1>
        <p>يرجى اختيار الفرع الذي تريد متابعة كاميراته:</p>

        <!-- قائمة منسدلة -->
        <div class="dropdown">
            <select id="branchSelect">
                <option value="" disabled selected>اختر الفرع</option>
                <option value="404.html">فرع الرئيسي</option>
                <option value="404.html">فرع فلسطين</option>
                <option value="404.html">فرع الكرادة</option>
                <option value="404.html">فرع الحلة</option>
                <option value="404.html">فرع النجف</option>
                <option value="404.html">فرع كربلاء</option>
                <option value="404.html">فرع العمارة</option>
                <option value="404.html">فرع البصرة</option>
                <option value="404.html">فرع الكوت</option>
                <option value="404.html">فرع بعقوبة</option>
                <option value="404.html">فرع الموصل</option>
                <option value="404.html">فرع كركوك</option>
                <option value="404.html">فرع دهوك</option>
                <option value="404.html">فرع سليمانية</option>
                <option value="404.html">فرع أربيل</option>


            </select>
            <p></p>
            <button onclick="goToBranch()">زيارة الفرع</button>
            <p>
            </p>
            <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="back-link">عودة إلى الصفحة السابقة</a>

        </div>
    </div>

    <script>
        function goToBranch() {
            const branchSelect = document.getElementById("branchSelect");
            const selectedBranch = branchSelect.value;
            if (selectedBranch) {
                window.open(selectedBranch, "_blank");
            } else {
                alert("يرجى اختيار فرع من القائمة.");
            }
        }
    </script>


    <!-- Footer Section -->
    <footer>
        <p>Powered by <strong><a href="https://www.m1oslem.com" target="_blank">Eng Muslim Al-Shamary</a></strong></p>
    </footer>
    <!-- Debug Section -->
<script>
    document.addEventListener("contextmenu", (event) => {
        event.preventDefault();
        alert("النقر بزر الفأرة الأيمن معطل.");
    });
</script>
<script>
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
