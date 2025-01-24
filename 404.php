<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الموقع تحت الصيانة</title>
    <link rel="icon" href="images/logo.svg">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Tajawal', Arial, sans-serif;
            background: url('images/background.jpg') no-repeat center center/cover; /* خلفية صورة صيانة */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
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
            width: 120px;
            height: 120px;
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
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .maintenance-logo {
            width: 80px;
            height: 80px;
            margin: 20px auto;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .maintenance-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
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
    <div class="container">
        <!-- شعار المصرف -->
        <div class="logo">
            <img src="images/logo.png" alt="شعار مصرف الثقة الدولي"> <!-- استبدل بـ شعار المصرف -->
        </div>
        <h1>مصرف الثقة الدولي الاسلامي</h1>
        <p>نعتذر على الإزعاج! الموقع تحت الصيانة حاليًا.<br> يرجى العودة لاحقًا.</p>
        <!-- شعار الصيانة -->
        <div class="images/maintenance-logo">
            <img src="images/maintenance-icon.png" alt="شعار الصيانة"> <!-- استبدل بـ شعار الصيانة -->
        </div>
        
    </div>
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
