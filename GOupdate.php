<?php
    $dns = 'mysql:host=localhost; dbname=testsystem; charaset=utf8';
    $user = 'testuser';
    $pass = 'testpass';

    $id = $_POST['id'];
    $comment = $_POST['comment'];
    if($comment == "") {
        echo "<script>alert('未入力の箇所があります。');</script>";
    }

    try {
        $db = new PDO($dns, $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $SQL = "UPDATE keiji SET comment = ? WHERE id = ?";

        $stmt = $db->prepare($SQL);
        $stmt->bindParam(1, $comment);
        $stmt->bindParam(2, $id);

        $stmt->execute();

        header('Location: index.php');
        exit();
    } catch(PDOException $e) {
        echo "アクセスできませんでした";
        echo $e->getMessage();
    }
?>