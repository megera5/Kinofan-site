<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Информация о фильмах</title>
</head>
<body>
<table>
     <tr>
        <th>Жанры</th>
    </tr>
    <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $host = 'localhost';
        $dbname = 'f0945872_film';
        $user = 'f0945872_film';
        $password = 'Annamart05!';
        
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            echo "Информация о жанрах: <br>";
        } catch (PDOException $e) {
            echo "Ошибка подключения: " . $e->getMessage();
        }
        $stmt_genres = $pdo->query("SELECT genre_code, genre_name FROM genre");
        
        while ($row = $stmt_genres->fetch()) {
            echo "<tr><td>".$row['genre_name']."</td></tr>";
        }
    ?>
</table>
<br>
<form method="post" action="add_event.php">
    <label for="genre_names">Жанр: </label>
    <input type="text" id="genre_names" name="genre_names" required><br><br>
    
    <input type="submit" name ='genrebtn' value="Добавить жанр">
</form>
        
</body>
</html>