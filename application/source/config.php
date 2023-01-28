<?php
    define('DB_HOST', 'database');
    define('USER', 'root');
    define('PASSWORD', 'root');
    define('DATABASE', 'mydb');
    try{
        $connection = new PDO('mysql:host='.DB_HOST.';dbname='.DATABASE, USER, PASSWORD);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>