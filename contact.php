<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>聯絡我們 - Origin RC</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <section id="contact">
        <h1>聯絡我們</h1>
        <p>地址：[地址]</p>
        <p>電話：[電話號碼]</p>
        <p>電子郵件：[電子郵件]</p>
        <form action="submit_form.php" method="POST">
            <input type="text" name="name" placeholder="Your Name">
            <input type="email" name="email" placeholder="Your Email">
            <textarea name="message" placeholder="Your Message"></textarea>
            <button type="submit">發送</button>
        </form>
    </section>
    <?php include 'footer.php'; ?>
</body>
</html>
