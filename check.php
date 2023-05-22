<?php 
    $name = $_POST["name"];
    $comment = $_POST["comment"];
        
    if($name == "" || $comment == "") {
        echo "<script>alert('未入力の箇所があります。');</script>";
        history.back();
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>入力内容確認画面</title>
</head>
<body>
    <h2>投稿内容を確認してください</h2>
    <p>名前: <?php echo $name ?></p>
    <p>コメント: <?php echo $comment ?></p>

    <form action="index.php" method="post">
        <input type="hidden" name="name" value="<?= $name ?>">
        <input type="hidden" name="comment" value="<?= $comment ?>">
        <input type="submit" value="投稿する">
    </form>
</body>
</html>