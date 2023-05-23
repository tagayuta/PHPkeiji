<?php
    session_start();
    $dns = 'mysql:host=localhost; dbname=testsystem; charaset=utf8';
    $user = 'testuser';
    $pass = 'testpass';

    $name = htmlentities($_POST["userName"], ENT_QUOTES, "UTF-8");
    $password = htmlentities($_POST["password"], ENT_QUOTES, "UTF-8");

    $password = hash("sha256", $password);

    try {
        $db = new PDO($dns, $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $userSeach = "SELECT name, id FROM loginUser WHERE name = ? AND id = ?";

        $stmt = $db->prepare($userSeach);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $password);

        $result = $stmt->execute();

        if($result == 1) {
            echo "検索成功";
            $_SESSION["name"] = $name;
            $_SESSION["password"] = $password;
        } else {
            echo "データがありませんでした。";
        }
    } catch(PDOException $e) {
        echo "アクセスできませんでした";
        echo $e->getMessage();
    }

    $db = null;
?>