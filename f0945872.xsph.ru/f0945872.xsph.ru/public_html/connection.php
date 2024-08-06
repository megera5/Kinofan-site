<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title></title>
    
</head>
<body>
<?php
include 'config.php';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    echo "Подключение успешно";
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
}
?>
</body>
</html>