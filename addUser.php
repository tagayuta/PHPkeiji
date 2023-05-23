<?php
    $dns = 'mysql:host=localhost; dbname=testsystem; charaset=utf8';
    $user = 'testuser';
    $pass = 'testpass';

    $name = htmlentities($_POST["name"], ENT_QUOTES, "UTF-8");
    $password = htmlentities($_POST["password"], ENT_QUOTES, "UTF-8");

    $password = hash("sha256", $password);

    try {
        $db = new PDO($dns, $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $userInsertSQL = "INSERT INTO loginUser VALUES(?, ?)";
        $stmt = $db->prepare($userInsertSQL);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $password);

        $stmt->execute();
    } catch(PDOException $e) {
        echo "アクセスできませんでした";
        echo $e->getMessage();
    }
?>