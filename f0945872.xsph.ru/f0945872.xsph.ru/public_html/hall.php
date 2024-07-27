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
        <th>Номер зала</th>
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
            echo "Информация о залах: <br>";
        } catch (PDOException $e) {
            echo "Ошибка подключения: " . $e->getMessage();
        }
        $stmt_hall = $pdo->query("SELECT location.address, hall.hall_number
                    FROM hall 
                    JOIN location ON hall.location_code = location.location_code");
        $stmt_loc = $pdo->query("SELECT location_code, address FROM location");
        
        while ($row = $stmt_hall->fetch()) {
            echo "<tr><td>".$row['address']."</td><td>".$row['hall_number']."</td></tr>";
        }
    ?>
</table>
<br>
<form method="post" action="add_event.php">
    <label for="address">Место проведения: </label>
    <?php
    echo '<select name="location_code" id="location_code">';
        while ($row = $stmt_loc->fetch()) {
            echo "<option value='".$row['location_code']."'>".$row['address']."</option>";
        }
    echo '</select><br><br>';
    ?>
    
    <label for="hall_number">Номер зала: </label>
    <input type="number" id="hall_number" name="hall_number" required><br><br>

    <input type="submit" name ='hallbtn' value="Добавить зал">
</form>
        
</body>
</html>