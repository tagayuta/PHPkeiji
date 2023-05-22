<?php 
    $name = $_POST["name"];
    $comment = $_POST["comment"];

    $name = htmlentities($name, ENT_QUOTES, "UTF-8");
    $comment = htmlentities($comment, ENT_QUOTES, "UTF-8");

    if($name == "" || $comment == "") {
        echo "<script>alert('未入力の箇所があります。');</script>";
        header('Location: index.php');
        exit();
    }


echo <<<_HTML_
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>入力内容確認画面</title>
</head>
<body>
    <div class="up">
        <h2 class="title">投稿内容を確認してください</h2>
        <p>名前:$name</p>
        <p>コメント:$comment</p>

        <form action="index.php" method="post">
            <div class="check">
            <input type="hidden" name="name2" value="$name">
            <input type="hidden" name="comment2" value="$comment">
            </div>
            <input type="submit" value="投稿する" class="btn">
        </form>
    </div>
</body>
</html>
_HTML_;

?>