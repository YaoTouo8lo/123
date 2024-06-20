<?php
session_start();
require 'connect/config.php';

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailID = $_POST['emailID'];
    $password = $_POST['password'];

    // 驗證emailID不包含“@”
    if (strpos($emailID, '@') !== false) {
        $error = "EmailID 不能包含@。";
    } else {
        $conn = conn('GlobalAccount');
        $sql = "SELECT * FROM RC_Account WHERE EmailID = ? AND Password = ?";
        $params = array($emailID, $password);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_has_rows($stmt)) {
            $_SESSION['emailID'] = $emailID;
            header("Location: index.php");
            exit();
        } else {
            $error = "電子郵件 ID 或密碼無效。";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入</title>
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
        #login {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        #login h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        #login input[type="text"],
        #login input[type="password"],
        #login button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        #login button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        #login button:hover {
            background-color: #45a049;
        }
        #login p.error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div id="login">
        <h2>登入</h2>
        <form action="" method="POST">
            <input type="text" name="emailID" placeholder="EmailID" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">登入</button>
        </form>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
