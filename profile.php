<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'connect/config.php';

if (!isset($_SESSION['emailID'])) {
    header("Location: login.php");
    exit();
}

$emailID = $_SESSION['emailID'];
$conn = conn('GlobalAccount');

// 從 RC_Account 表中檢索數據
$sql = "SELECT AccountID, CashBalance FROM RC_Account WHERE EmailID = ?";
$params = array($emailID);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$accountID = $user['AccountID'];
$cashBalance = $user['CashBalance'];

// 從表格中取出數據使用 AccountID 的 RC_GetCharacterList
$sql = "SELECT CharacterName, CharacterMoney FROM RC_GetCharacterList WHERE AccountID = ?";
$params = array($accountID);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$characters = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $characters[] = $row;
}

// 管理圖片上傳
$uploadError = '';
$profileImage = "PlayerProfile/" . $emailID . ".png";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_image'])) {
    $targetDir = "PlayerProfile/";
    $targetFile = $targetDir . $emailID . ".png";
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // 確保圖像是 PNG
    if ($imageFileType != "png") {
        $uploadError = "僅允許 PNG 檔案。";
    } else {
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile)) {
            $uploadError = "檔案 ". htmlspecialchars(basename($_FILES["profile_image"]["name"])). " 已上傳。";
        } else {
            $uploadError = "抱歉，上傳您的文件時發生錯誤。";
        }
    }
}

// 檢查是否有個人資料圖片。
if (!file_exists($profileImage)) {
    $profileImage = "default_profile.png"; // 如果沒有上傳圖片，則使用預設的個人資料圖片。
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>個人資料</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .profile-container {
            display: flex;
            flex-direction: column;
            padding: 20px;
        }
        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            background-color: #333;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .profile-header h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        .profile-header img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .profile-header form {
            text-align: center;
        }
        .profile-header form input[type="file"] {
            margin-bottom: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .profile-header form input[type="file"]::file-selector-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 0px 20px;
            cursor: pointer;
            font-size: 16px;
        }
        .profile-header form input[type="file"]::file-selector-button:hover {
            background-color: #45a049;
        }
        .profile-header form button {
            padding: 11px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .profile-header form button:hover {
            background-color: #45a049;
        }
        .profile-sidebar {
            width: 300px;
            padding: 20px;
            background-color: #333;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-right: 20px;
        }
        .profile-sidebar h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        .profile-sidebar p {
            margin-bottom: 10px;
            font-size: 18px;
        }
        .profile-content {
            flex: 1;
            padding: 20px;
        }
        .profile-content h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .profile-content button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .profile-content button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="profile-container">
        <div class="profile-header">
            <h2>個人資料</h2>
            <img src="<?php echo htmlspecialchars($profileImage); ?>" alt="Profile Image">
            <form action="profile.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="profile_image" accept="image/png">
                <button type="submit">上傳</button>
            </form>
            <p style="color: red;"><?php echo htmlspecialchars($uploadError); ?></p>
        </div>
        <div class="profile-content">
            <h2>歡迎, <?php echo htmlspecialchars($emailID); ?></h2>
            <div class="profile-sidebar">
                <p><strong>點數餘額:</strong> <?php echo number_format($cashBalance); ?></p>
                <?php foreach ($characters as $character): ?>
                    <p><strong>玩家名稱:</strong> <?php echo htmlspecialchars($character['CharacterName']); ?></p>
                    <p><strong>角色金錢:</strong> <?php echo number_format($character['CharacterMoney']); ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
