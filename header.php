<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
    <nav>
        <div class="logo">
            <a href="index.php"><img src="img/Main_logo.png" alt="Logo"></a>
        </div>
        <ul class="menu">
            <li><a href="index.php">主頁</a></li>
            <li><a href="services.php">服務</a></li>
            <li><a href="https://www.facebook.com/profile.php?id=100089270736802">粉絲專頁</a></li>
            <li><a href="https://discord.gg/4gUx3tySms">Discord</a></li>
			<li><a href="download.php">下載遊戲</a></li>
        </ul>
        <ul class="auth">
            <?php if (isset($_SESSION['emailID'])): ?>
                <li><a href="profile.php">個人資料</a></li>
                <li><a href="logout.php">登出</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Signup</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<style>
header {
    background-color: #333;
    color: white;
    padding: 10px 0;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}

nav .logo img {
    height: 50px; /* 調整標誌大小 */
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
}

nav ul.menu {
    flex: 1;
}

nav ul.auth {
    flex: 0;
}

nav ul li {
    margin: 0 15px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-size: 16px;
}

nav ul li a:hover {
    text-decoration: underline;
}
</style>
