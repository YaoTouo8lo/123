<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>主頁</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* 用於 png 或 gif 背景圖像 */
        #hero {
            background-image: url('video/mp4/background-color.mp4'); /* 更改 path_to_your_image.png是你想要的文件*/
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        /* 背景影片 */
        #hero video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .hero-content {
            z-index: 1;
        }

        .hero-content h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 24px;
            margin-bottom: 40px;
        }

        .hero-content .btn {
            padding: 10px 20px;
            background-color: white;
            color: #4CAF50;
            text-decoration: none;
            border-radius: 5px;
        }

        .hero-content .btn:hover {
            background-color: #45a049;
            color: white;
        }

        /* 改進下面的部分 */
        #features, #catalog, #contact {
            background-color: black;
            color: white;
            padding: 20px 20px;
            text-align: center;
        }

        #features h2, #catalog h2, #contact h2 {
            margin-bottom: 40px;
            color: white;
        }

        .feature, .product {
            margin-bottom: 20px;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <section id="hero">
        <!-- 用於背景影片 -->
        <video autoplay muted loop>
            <source src="background-color.mp4" type="video/mp4"> <!-- 更改 path_to_your_video.mp4是你想要的檔案 -->
        </video>

        <!-- 對於 png 或 gif 背景圖片，註解上面的 <video> 標籤 -->

        <div class="hero-content">
            <h1>Origin RC</h1>
            <p>免費線上賽車MMORPG（大型多人角色扮演線上遊戲）</p>
            <a href="signup.php" class="btn">註冊</a>
			<a href="download.php" class="btn">下載</a>
        </div>
		<?php include 'footer.php'; ?>
    </section>
</body>
</html>
