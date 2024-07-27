<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Информация о фильмах</title>
</head>
<body>
<table>
     <tr>
        <th>Место проведения</th>
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
            echo "Информация о месте проведения: <br>";
        } catch (PDOException $e) {
            echo "Ошибка подключения: " . $e->getMessage();
        }
        $stmt_location = $pdo->query("SELECT address FROM location");
        
        while ($row = $stmt_location->fetch()) {
            echo "<tr><td>".$row['address']."</td></tr>";
        }
    ?>
</table>
<br>
<form method="post" action="add_event.php">
    <label for="address">Место проведения: </label>
    <input type="text" id="address" name="address" required><br><br>
    
    <input type="submit" name ='locatbtn' value="Добавить место проведения">
</form>
</body>
</html>