<?php
    session_start();
    $_SESSION = array();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログアウトしました</title>
</head>
<body>
    <h1 class="title">みんなの掲示板！！</h1>
    <p>ログアウトしました</p>
    <p><a href="loginForm.php">ログインはこちらからどうぞ！</a></p>
</body>
</html>