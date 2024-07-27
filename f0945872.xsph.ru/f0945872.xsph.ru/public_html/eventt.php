<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Информация о фильмах</title>
</head>
<body>
<table>
     <tr>
        <th>Название</th>
        <th>Жанр</th>
        <th>Длительность</th>
        <th>Год выпуска</th>
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
            echo "Информация о фильмах: <br>";
        } catch (PDOException $e) {
            echo "Ошибка подключения: " . $e->getMessage();
        }
        $stmt = $pdo->query("SELECT event.event_name, genre.genre_name, event.duration, event.year_of_manufacture 
                    FROM event 
                    JOIN genre ON event.genre_code = genre.genre_code");
        $stmt_genre = $pdo->query("SELECT genre_code, genre_name FROM genre");
        
        while ($row = $stmt->fetch()) {
            echo "<tr><td>".$row['event_name']."</td><td>".$row['genre_name']."</td><td>".$row['duration']."</td><td>".$row['year_of_manufacture']."</td></tr>";
        }
    ?>
</table>
<br>
<form method="post" action="add_event.php">
    <label for="event_name">Название фильма: </label>
    <input type="text" id="event_name" name="event_name" required><br><br>
    
    <label for="genre_name">Жанр: </label>
    <?php
    echo '<select name="genre_code" id="genre_code">';
        while ($row = $stmt_genre->fetch()) {
            echo "<option value='".$row['genre_code']."'>".$row['genre_name']."</option>";
        }
    echo '</select><br><br>';
    ?>
    
    <label for="duration">Длительность: </label>
    <input type="time" id="duration" name="duration" required><br><br>

    <label for="year_of_manufacture">Год выпуска: </label>
    <input type="number" id="year_of_manufacture" name="year_of_manufacture" required><br><br>

    <input type="submit" name ='filmbtn' value="Добавить фильм">
</form>
</body>
</html>