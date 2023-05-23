<?php
    session_start();

    if(isset($_SESSION["name"]) && isset($_SESSION["password"])) {
        header('Location: logout.html');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
</head>
<body>
    <h1 class="title">みんなの掲示板！！</h1>
    <p>ログイン情報を入力してください</p>
    <form action="login.php" method="post">
        <input type="text" name="userName">
        <input type="password" name="password">
        <input type="submit" value="送信">
    </form>
</body>
</html>