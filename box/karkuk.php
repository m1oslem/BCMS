
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCMS - عرض الكاميرات</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Tajawal', Arial, sans-serif;
            background: url('images/background.jpg') no-repeat center center/cover;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #fff;
        }

        .container {
            width: 95%;
            max-width: 1200px;
            margin-top: 20px;
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        }

        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .thumbnails {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 10px;
        }

        .thumbnail {
            position: relative;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .thumbnail img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.3s ease;
        }

        .thumbnail img:hover {
            transform: scale(1.05);
        }

        .thumbnail .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 0.8rem;
        }

        .thumbnail:hover .overlay {
            opacity: 1;
        }

        .thumbnail button {
            padding: 5px 10px;
            font-size: 0.7rem;
            border: none;
            border-radius: 5px;
            background: rgba(0, 123, 255, 0.8);
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .thumbnail button:hover {
            background: rgba(0, 123, 255, 1);
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
            padding: 10px 0;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>مصرف الثقة الدولي الاسلامي</h1>
        <h2>عرض الكاميرات</h2>

        <div class="thumbnails">
            <!-- كاميرا 1 -->
            <div class="thumbnail">
                <img id="camera14" src="http://172.16.19.203/camera_8/mjpeg-stream" alt="اتصال ضعيف ">
                <div class="overlay">
                    <button onclick="toggleFullscreen('camera14')">تكبير</button>
                </div>
            </div>

            <!-- كاميرا 2 -->
            <div class="thumbnail">
                <img id="camera15" src="http://172.16.19.203/camera_9/mjpeg-stream" alt="اتصال ضعيف ">
                <div class="overlay">
                    <button onclick="toggleFullscreen('camera15')">تكبير</button>
                </div>
            </div>
        </div>
<p></p>

        </div>

         
    </div>

    <footer>
        <p>Powered by <strong><a href="https://www.m1oslem.com" target="_blank">Eng Muslim Al-Shamary</a></strong></p>
    </footer>

    <script>
        // تفعيل التكبير للكاميرا
        function toggleFullscreen(cameraId) {
            const cameraFrame = document.getElementById(cameraId);
            const button = cameraFrame.closest('.thumbnail').querySelector('.overlay button');
            
            if (cameraFrame.requestFullscreen) {
                cameraFrame.requestFullscreen();
                button.style.display = 'none'; // إخفاء الزر عند التكبير
            } else if (cameraFrame.webkitRequestFullscreen) { // Safari
                cameraFrame.webkitRequestFullscreen();
                button.style.display = 'none'; // إخفاء الزر عند التكبير
            } else if (cameraFrame.msRequestFullscreen) { // IE/Edge
                cameraFrame.msRequestFullscreen();
                button.style.display = 'none'; // إخفاء الزر عند التكبير
            }

            // إلغاء التكبير عند النقر مرتين
            cameraFrame.addEventListener('dblclick', function() {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) { // Safari
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) { // IE/Edge
                    document.msExitFullscreen();
                }
            });
        }
    </script>
</body>
</html>
