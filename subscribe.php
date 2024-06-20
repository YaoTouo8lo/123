<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    // 連線到資料庫（config.php）
    require 'connect/config.php';
    $conn = conn('GlobalAccount');

    // 檢查電子郵件是否已經存在
    $sql = "SELECT * FROM Subscribers WHERE email = ?";
    $params = array($email);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if (sqlsrv_has_rows($stmt)) {
        $message = "該電子郵件已註冊。";
    } else {
        // 將電子郵件加入資料庫
        $sql = "INSERT INTO Subscribers (email) VALUES (?)";
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt) {
            $message = "註冊成功.";
        } else {
            $message = "註冊失敗.";
        }
    }
    sqlsrv_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>訂閱狀態</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2>訂閱狀態</h2>
        <p><?php echo $message; ?></p>
        <a href="index.php">返回主頁</a>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
