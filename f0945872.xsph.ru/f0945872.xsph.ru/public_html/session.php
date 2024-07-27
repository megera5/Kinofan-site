<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Информация о фильмах</title>
</head>
<body>
<table>
    <tr>
        <th>Фильм</th>
        <th>Дата</th>
        <th>Время</th>
        <th>Стоимость</th>
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
            echo "Информация о сеансах: <br>";
        } catch (PDOException $e) {
            echo "Ошибка подключения: " . $e->getMessage();
        }
        $stmt_session = $pdo->query("SELECT event.event_name, session.date, session.time, session.basic_cost
                    FROM session 
                    JOIN event ON session.event_code = event.event_code");
        $stmt_event = $pdo->query("SELECT event_code, event_name FROM event");
        
        while ($row = $stmt_session->fetch()) {
            echo "<tr><td>".$row['event_name']."</td><td>".$row['date']."</td><td>".$row['time']."</td><td>".$row['basic_cost']."</td></tr>";
        }
    ?>
</table>
<br>
<form method="post" action="add_event.php">
    <label for="event_name">Фильм: </label>
    <?php
    echo '<select name="event_code" id="event_code">';
        while ($row = $stmt_event->fetch()) {
            echo "<option value='".$row['event_code']."'>".$row['event_name']."</option>";
        }
    echo '</select><br><br>';
    ?>
    
    <label for="date">Дата: </label>
    <input type="date" id="date" name="date" required><br><br>
    
    <label for="time">Время: </label>
    <input type="time" id="time" name="time" required><br><br>

    <label for="basic_cost">Стоимость: </label>
    <input type="number" id="basic_cost" name="basic_cost" required><br><br>

    <input type="submit" name ='sessbtn' value="Добавить сеанс">
</form>
</body>
</html>