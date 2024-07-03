<?php

$servername = "db";
$username = "root";
$password = "root";
$dbName = "site_mega_db";

$error = "";

$link = mysqli_connect($servername, $username, $password);

if (!$link) {
    $error .= "Ошибка подключения: " . mysqli_connect_error() . "\n";
} else {
    $sql = "CREATE DATABASE IF NOT EXISTS $dbName";
    if (!mysqli_query($link, $sql)) {
        $error .= "Не удалось создать БД: " . mysqli_error($link) . "\n";
    }

    mysqli_close($link);

    $link = mysqli_connect($servername, $username, $password, $dbName);

    if (!$link) {
        $error .= "Ошибка подключения: " . mysqli_connect_error() . "\n";
    } else {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(15) NOT NULL,
            email VARCHAR(50) NOT NULL,
            pass VARCHAR(20) NOT NULL
        )";
        if (!mysqli_query($link, $sql)) {
            $error .= "Не удалось создать таблицу users: " . mysqli_error($link) . "\n";
        }
        mysqli_close($link);
    }
}

if ($error) {
    echo nl2br($error);
}
?>
