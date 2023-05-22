<?php
$dns = 'mysql:host=localhost; dbname=testsystem; charaset=utf8';
$user = 'testuser';
$pass = 'testpass';

if ("POST" == $_SERVER['REQUEST_METHOD']) {
    $name = $_POST["name"];
    $comment = $_POST["comment"];

    header('Location: index.php');
    
    if($name == "" || $comment == "") {
        echo "<script>alert('未入力の箇所があります。');</script>";
    }

    $name = htmlentities($name, ENT_QUOTES, "UTF-8");
    $name = htmlentities($comment, ENT_QUOTES, "UTF-8");

    try {
        $db = new PDO($dns, $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $insertSQL = "INSERT INTO keiji(name, comment) VALUES(?, ?)";
        $selectSQL = "SELECT * FROM keiji";

        $stmt = $db->prepare($insertSQL);
        $data = array($name, $comment);
        $stmt->execute($data);

        $stmt = $db->prepare($selectSQL);
        $stmt->execute();

        $db = null;
        exit();
    } catch(PDOException $e) {
        echo "アクセスできませんでした";
        echo $e->getMessage();
    }
} else {
    $db = new PDO($dns, $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $selectSQL = "SELECT * FROM keiji";
    $stmt = $db->prepare($selectSQL);
    $stmt->execute();
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>掲示板</title>
</head>
<body>
    <?php foreach($stmt as $arrValue):?>
        <div class="keijiArea">
            <p>id: <?php echo $arrValue['id'] ?></p>
            <p>投稿者: <?php echo $arrValue['name'] ?></p>
            <p>投稿内容: <?php echo $arrValue['comment'] ?></p>
            <P>時間: <?php echo $arrValue['time'] ?></p>
            <form action="index.php" method="post">
                <input type="hidden" name="delete" value="<?php $arrValue['id']?>">
                <input type="submit" value="この投稿を削除">
            </form>
            <hr>
        </div>
    <?php endforeach;?>
    
    <form action="index.php" method="post">
        <p>名前：<input type="text" name="name"></p>
        <p>コメント：<input type="text" name="comment"></p>
        <input type="submit" value="書き込む">
    </form>
</body>
</html>

