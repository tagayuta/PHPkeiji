<?php
    $rmValue = $_POST["delete"];

    $dns = 'mysql:host=localhost; dbname=testsystem; charaset=utf8';
    $user = 'testuser';
    $pass = 'testpass';

    $db = new PDO($dns, $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $deleteSQL = "DELETE FROM keiji WHERE id = ?";
    $stmt = $db->prepare($deleteSQL);

    $data = array($rmValue);
    $stmt->execute($data);

    $db = null;
    header('Location: index.php');
    exit();
?>