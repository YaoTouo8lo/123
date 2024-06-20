<?php
require 'connect/config.php';

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailID = $_POST['emailID'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $email = $_POST['email'];

    // 驗證密碼和確認密碼是否符合。
    if ($password !== $confirmPassword) {
        $error = "密碼和確認密碼不符。";
    } else if (strpos($emailID, '@') !== false) {
        $error = "EmailID 不能包含@。";
    } else {
        $conn = conn('GlobalAccount');
        $sql = "SELECT * FROM RC_Account WHERE EmailID = ?";
        $params = array($emailID);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if (sqlsrv_has_rows($stmt)) {
            $error = "該ID已被使用。";
        } else {
            // 新增使用者到資料庫
            $sql = "INSERT INTO RC_Account (EmailID, Password, Email) VALUES (?, ?, ?)";
            $params = array($emailID, $password, $email);
            $stmt = sqlsrv_query($conn, $sql, $params);

            if ($stmt) {
                $message = "帳號申請成功";
                header("Location: login.php");
                exit();
            } else {
                $error = "註冊時發生錯誤。";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>帳號申請</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        #signup {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        #signup h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        #signup input[type="text"],
        #signup input[type="password"],
        #signup input[type="email"],
        #signup button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        #signup button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        #signup button:hover {
            background-color: #45a049;
        }
        #signup p.error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div id="signup">
        <h2>帳號申請</h2>
        <form action="" method="POST">
            <input type="text" name="帳號" placeholder="ID" required>
            <input type="password" name="密碼" placeholder="Password" required>
            <input type="password" name="確認密碼" placeholder="Confirm Password" required>
            <input type="email" name="Email" placeholder="Email" required>
            <button type="submit">帳號申請</button>
        </form>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <?php if (isset($message)) { echo "<p class='message'>$message</p>"; } ?>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
