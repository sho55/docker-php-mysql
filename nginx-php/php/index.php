<?php

//接続する設定を作成
$dsn = 'mysql:dbname=mysql;host=[YOUR GATEWAY IP];port=3316';
$user = 'mysql';
$password = 'mysql';


try {
    $dbh = new PDO($dsn, $user, $password);
    


    $sql = "SELECT * FROM test_users";
    $stmt = $dbh -> query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (isset($result)){
    var_dump($result);
    }
    

} catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage() . "\n";
    exit();
}