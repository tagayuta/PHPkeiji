<?php
    $dns = 'mysql:host=localhost; dbname=testsystem; charaset=utf8';
    $user = 'testuser';
    $pass = 'testpass';

    if ("POST" == $_SERVER['REQUEST_METHOD']) {
        $name2 = $_POST['name2'];
        $comment2 = $_POST['comment2'];
        if($name2 == "" || $comment2 == "") {
            echo "<script>alert('未入力の箇所があります。');</script>";
        }
        
        try {
            $db = new PDO($dns, $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $insertSQL = "INSERT INTO keiji(name, comment) VALUES(?, ?)";
            $selectSQL = "SELECT * FROM keiji";

            $stmt = $db->prepare($insertSQL);
            $stmt->bindParam(1, $name2);
            $stmt->bindParam(2, $comment2);
            $stmt->execute();

            $stmt = $db->prepare($selectSQL);
            $stmt->execute();
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
    
    $db = null;

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>掲示板</title>
</head>
<body>
    <div class="container">
        <h1 class="title">みんなの掲示板！！</h1>
        <div class="formArea">
            <form action="check.php" method="post">
                <ul>
                    <li>
                        <label for="name">名前</label>
                        <input type="text" name="name" placeholder="名前" class="name">
                    </li>
                    <li>
                        <label for="comment">コメント</label>
                        <textarea name="comment" cols="50" rows="10" placeholder="コメント"></textarea>
                    </li>
                </ul>
                <input type="submit" value="書き込む" class="btn">
            </form>
        </div>

        <div class="keijiArea">
            <?php foreach($stmt as $arrValue):?>
                <div class="commentArea">
                    <p class="number">投稿番号: <?php echo $arrValue['id'] ?></p>
                    <p class="user">投稿者: <?php echo $arrValue['name'] ?></p>
                    <p>投稿内容</p>
                    <p class="comment"><?php echo $arrValue['comment'] ?></p>
                    <P class="time">時間: <?php echo $arrValue['time'] ?></p>
                    <div class="forms">
                    <form action="update.php" method="post">
                        <input type="hidden" name="updateID" value="<?= $arrValue['id']?>">
                        <input type="hidden" name="updateComment" value="<?= $arrValue['comment']?>">
                        <input type="submit" value="編集" class="update">
                    </form>
                    <form action="delete.php" method="post">
                        <input type="hidden" name="delete" value="<?= $arrValue['id']?>">
                        <input type="submit" value="削除" class="delete">
                    </form>
                    </div>
                    <hr>
                </div>
            <?php endforeach;?>
        </div>
    </div>
    
    
    
    
</body>
</html>

