


<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCMS - عرض الكاميرا</title>
    <link rel="icon" href="images/logo.svg">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Tajawal', Arial, sans-serif;
            background: url('images/background.jpg') no-repeat center center/cover;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .container {
            width: 95%;
            max-width: 1200px;
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        h1, h2 {
            margin: 10px 0;
        }

        .camera-frame {
            position: relative;
            width: 100%;
            max-width: 960px;
            aspect-ratio: 16 / 9;
            margin: 20px auto;
            border: 5px solid rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        }

        .camera-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .camera-frame .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .camera-frame:hover .overlay {
            opacity: 1;
        }

        .overlay button {
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            background: rgba(0, 123, 255, 0.8);
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .overlay button:hover {
            background: rgba(0, 123, 255, 1);
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
<body>

    <div class="container">

        <h2>عرض الكاميرا المباشرة</h2>

        <div class="camera-frame" id="cameraFrame">
            <img src="http://172.16.19.202/camera_9/mjpeg-stream" alt="اتصال ضعيف">
            <div class="overlay">
                <button onclick="toggleFullscreen()">تكبير الشاشة</button>
            </div>
        </div>

    </div>
    <footer>
        
    </footer>

    <script>

    
        // وظيفة تكبير الشاشة
        function toggleFullscreen() {
            const cameraFrame = document.getElementById('cameraFrame');
            const button = document.querySelector('.overlay button');
            
            if (cameraFrame.requestFullscreen) {
                cameraFrame.requestFullscreen();
                button.style.display = 'none'; // أخفاء الزر عند التوسع
            } else if (cameraFrame.webkitRequestFullscreen) { // Safari
                cameraFrame.webkitRequestFullscreen();
                button.style.display = 'none'; // أخفاء الزر عند التوسع
            } else if (cameraFrame.msRequestFullscreen) { // IE/Edge
                cameraFrame.msRequestFullscreen();
                button.style.display = 'none'; // أخفاء الزر عند التوسع
            }
            
            // إلغاء التوسع عند النقر مرتين
            cameraFrame.addEventListener('dblclick', function() {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) { // Safari
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) { // IE/Edge
                    document.msExitFullscreen();
                }
            });
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
        }
    </script>
</body>
</html>
