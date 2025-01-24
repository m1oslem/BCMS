<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONVIF Live Stream</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        video {
            max-width: 90%;
            max-height: 90%;
            border: 2px solid #333;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <video controls autoplay>
        <source src="rtsp://admin:H!k@itb25@172.19.51.6:554/Streaming/Channels/2/" type="video/mp4">
        Your browser does not support this video format.
    </video>
</body>
</html>
