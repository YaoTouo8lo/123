<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>下載遊戲</title>
    <Link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            margin-bottom: 30px; /* 增加標題與內容之間的空間 */
        }
        .container {
            max-width: 800px;
            padding: 10px;
            margin: 0 auto;
            text-align: center;
        }
        h1 {
            font-size: 38px;
            margin-bottom: 20px;
        }
        .specs-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 50px;
            gap: 20px; /* 增加最小規格和建議規格之間的距離 */
        }
        .specs-box {
            background-color: #444;
            padding: 30px;
            border-radius: 8px;
            width: 45%;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        p {
            font-size: 18px;
            margin-bottom: 10px;
            text-align: left;
        }
        .btn-download {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }
        .btn-download:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>下載客戶端</h1>
        <div class="specs-container">
            <div class="specs-box">
                <h2>最低系統需求</h2>
                <p>
                    作業系統: Windows 7<br>
                    處理器: Intel Core i3-2100 or AMD equivalent<br>
                    記憶體: 4 GB RAM<br>
                    顯示卡: NVIDIA GTX 650 / AMD HD 7750 or better<br>
                    DirectX: Version 11<br>
                    儲存空間: 20 GB available space
                </p>
            </div>
            <div class="specs-box">
                <h2>推薦系​​統需求</h2>
                <p>
                    作業系統: Windows 10<br>
                    處理器: Intel Core i5-8400 or AMD equivalent<br>
                    記憶體: 8 GB RAM<br>
                    顯示卡: NVIDIA GTX 1060 / AMD RX 580 or better<br>
                    DirectX: Version 11<br>
                    儲存空間: 20 GB available space
                </p>
            </div>
        </div>
        <a href="path_to_your_download_file.zip" class="btn-download">Google Drive 連結 1</a>
		<a href="path_to_your_download_file.zip" class="btn-download">Google Drive 連結 2</a>
		<a href="path_to_your_download_file.zip" class="btn-download">Google Drive 連結 3</a>
		<a href="path_to_your_download_file.zip" class="btn-download">CND SERVER</a>
    </div>
</body>
</html>
