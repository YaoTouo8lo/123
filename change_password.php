<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'connect/config.php';

if (!isset($_SESSION['emailID'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $emailID = $_SESSION['emailID'];

    $conn = conn('GlobalAccount');
    $sql = "SELECT * FROM RC_Account WHERE EmailID = ? AND Password = ?";
    $params = array($emailID, $currentPassword);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_has_rows($stmt)) {
        $sql = "UPDATE RC_Account SET Password = ? WHERE EmailID = ?";
        $params = array($newPassword, $emailID);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt) {
            $message = "密碼更新成功。";
        } else {
            $message = "密碼更新失敗。";
        }
    } else {
        $message = "目前密碼不正確。";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>更改密碼</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <section id="change-password">
        <h2>更改密碼</h2>
        <form action="" method="POST">
            <input type="password" name="currentPassword" placeholder="Current Password" required>
            <input type="password" name="newPassword" placeholder="New Password" required>
            <button type="submit">更改密碼</button>
        </form>
        <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
    </section>
    <?php include 'footer.php'; ?>
</body>
</html>
