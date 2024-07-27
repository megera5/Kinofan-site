<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title></title>
    
</head>
<body>
<?php
$host = 'localhost';
$dbname = 'f0945872_film';
$user = 'f0945872_film';
$password = 'Annamart05!';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    echo "Подключение успешно";
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
}
?>
</body>
</html>