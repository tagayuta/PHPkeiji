<?php
    $id = $_POST['updateID'];
    $comment = $_POST['updateComment'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>投稿編集</title>
</head>
<body>
<h2 class="title">編集してください</h2>
    <div class="up">
        <form action="GOupdate.php" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <textarea name="comment" cols="50" rows="10" ><?= $comment ?></textarea>
            <input type="submit" value="登録" class="btn">
        </form>
    </div>
</body>
</html>