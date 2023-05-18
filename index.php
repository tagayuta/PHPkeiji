<?php
if ("POST" == $_Server["REQUEST_METHOD"]) {
    $name = $_POST["name"];
    $comment = $_POST["comment"];

    if($name == "" || $comment == "") {
        echo "<script>alert('未入力の箇所があります。');</script>";
    }

    $name = htmlentities($name, ENT_QUOTES, "UTF-8");
    $name = htmlentities($comment, ENT_QUOTES, "UTF-8");

    $dns = 'mysql:host=localhost; dbname=testsystem; charset=uth8';
    $user = 'testuser';
    $pass = 'testpass';
    try {
        $db = new PDO($dns, $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $insertSQL = "INSERT INTO testuset(name, comment) VALUES(?, ?)";
        $selectSQL = "SELECT * FROM keiji";

        $stmt = $db->prepare($insertSQL);
        $data = array($name, $comment);
        $stmt->execute($data);

        $stmt = $db->prepare($selectSQL);
        $stmt->execute();
    } catch(PDOException $e) {
        echo "アクセスできませんでした";
        echo $e->getMessage();
    }
}

echo <<<_BODY_
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>掲示板</title>
</head>
<body>
    while($arr = $stmt->fetch()) {
    <div class="keijiArea">
        <p>id: $arr['id']</p>
        <p>投稿者：arr['name']</p>
        <hr>
        <p>投稿内容</p>
        <p>$arr['comment']</p>
        <P>時間： arr['time']</p>
    </div>
    }
    <form action="index.php" method="post">
        <p>名前：<input type="text" name="name"></p>
        <p>コメント：<input type="text" name="comment"></p>
        <input type="submit" value="書き込む">
    </form>
</body>
</html>
_BODY_
    
?>

