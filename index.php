<?php
    $dns = 'mysql:host=localhost; dbname=testsystem; charaset=utf8';
    $user = 'testuser';
    $pass = 'testpass';

    if ("POST" == $_SERVER['REQUEST_METHOD']) {
        $name2 = $_POST['name2'];
        $comment2 = $_POST['comment2'];
        
        try {
            //DBのテーブルのカラムはDBテーブル.txtを見てください
            //DBに接続
            $db = new PDO($dns, $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //データ追加用のSQL
            $insertSQL = "INSERT INTO keiji(name, comment) VALUES(?, ?)";//?は値を後で置き換えるために使用している
            // データをすべて取り出すSQL
            $selectSQL = "SELECT * FROM keiji";

            $stmt = $db->prepare($insertSQL);
            //SQL文の?の部分を置き換える処理
            //(1, $name2)は(何番目の?か, 置き換える値)
            $stmt->bindParam(1, $name2);
            $stmt->bindParam(2, $comment2);
            //SQLの実行
            $stmt->execute();

            $stmt = $db->prepare($selectSQL);
            // SQLの実行
            //実行して抽出した値は$stmtに格納される
            //$stmtは連想配列になっている
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

<!-- ここからHTML -->
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
        <a href="loginForm.php">ログイン</a>
        <a href="userAdd.html">新規登録</a>
        <!-- ↓↓↓データを追加するためのフォーム↓↓ -->
        <div class="formArea"><!-- CSSを適用するために<div>で囲っている -->
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
        <!-- ↑↑↑データ追加用フォームはここまで↑↑↑ -->


        <!-- ↓↓↓tableの値を出力している部分↓↓↓ -->
        <div class="keijiArea">
            <!-- foreachでDBから抽出した値を格納している$stmtを全部出力する -->
            <?php foreach($stmt as $arrValue):?>
                <div class="commentArea">
                    <!-- tableのidを出力する -->
                    <p class="number">投稿番号: <?php echo $arrValue['id'] ?></p>
                    <!-- tableのnameを出力する -->
                    <p class="user">投稿者: <?php echo $arrValue['name'] ?></p>
                    <p>投稿内容</p>
                    <!-- tableのcommentを出力する -->
                    <p class="comment"><?php echo $arrValue['comment'] ?></p>
                    <!-- tableのtimeを出力する -->
                    <P class="time">時間: <?php echo $arrValue['time'] ?></p>


                    <!-- 投稿内容編集用のPHPファイルに飛ばすform -->
                    <div class="forms">
                    <form action="update.php" method="post">
                        <!-- inputのvalue属性でformを飛ばすときに値を設定できる -->
                        <input type="hidden" name="updateID" value="<?= $arrValue['id']?>">
                        <input type="hidden" name="updateComment" value="<?= $arrValue['comment']?>">
                        <input type="submit" value="編集" class="update">
                    </form>
                    <!-- 投稿内容編集用のPHPファイルに飛ばすform ここまで-->

                    <!-- 投稿削除用のPHPファイルに飛ばすform -->
                    <form action="delete.php" method="post">
                        <input type="hidden" name="delete" value="<?= $arrValue['id']?>">
                        <input type="submit" value="削除" class="delete">
                    </form>
                    <!-- 投稿削除用のPHPファイルに飛ばすformここまで -->
                    </div>
                    <hr>
                </div>
            <?php endforeach;?>
            <!-- ループはここまで -->
        </div>
        <!-- ↑↑↑tableの値を出力している部分ここまで↑↑↑ -->

    </div>
</body>
</html>

