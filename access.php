<?php
        // データベースに接続
        try {
                $dsn = 'mysql:dbname=local;port=10008;host=localhost;charset=utf8';
                $user = 'root';
                $password = 'root';
                $pdo = new PDO($dsn,$user,$password);
            } catch (PDOException $e) {
                echo 'DB接続エラー！: ' . $e->getMessage();
            }
    ?>