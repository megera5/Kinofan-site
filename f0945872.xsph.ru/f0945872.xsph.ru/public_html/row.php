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
        <th>Номер ряда</th>
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
            echo "Информация о рядах: <br>";
        } catch (PDOException $e) {
            echo "Ошибка подключения: " . $e->getMessage();
        }
        $stmt_halls = $pdo->query("SELECT location.address, hall.hall_number, hall.hall_code
            FROM hall 
            JOIN location ON hall.location_code = location.location_code");
        $stmt_rows = $pdo->query("SELECT row.row_number, hall.hall_number, hall.hall_code
            FROM row 
            LEFT JOIN hall ON row.hall_code = hall.hall_code")->fetchAll();

        while ($row = $stmt_halls->fetch()) {
            echo "<tr><td>".$row['address']."</td><td>".$row['hall_number']."</td>";
            $hall_code = $row['hall_code'];
            foreach ($stmt_rows as $row2) {
                if ($row2['hall_code'] == $hall_code) {
                    echo "<td>".$row2['row_number']."</td>";
                }
            }
            echo "</tr>";
        }
    ?>
</table>
<br>
<form method="post" action="add_event.php">
    <label for="address">Место проведения: </label>
<?php
$stmt_loc = $pdo->query("SELECT location_code, address FROM location");
echo '<select name="location_code" id="location_code">';
    while ($row = $stmt_loc->fetch()) {
        echo "<option value='".$row['location_code']."'>".$row['address']."</option>";
    }
echo '</select><br><br>';
?>

<label for="hall_number">Номер зала: </label>
<?php
    $stmt_hall = $pdo->query("SELECT hall_code, hall_number FROM hall");
    echo '<select name="hall_code" id="hall_code">';
        while ($row = $stmt_hall->fetch()) {
            echo "<option value='".$row['hall_code']."'>".$row['hall_number']."</option>";
        }
    echo '</select><br><br>';
?>
    
    <label for="row_number">Номер ряда: </label>
    <input type="number" id="row_number" name="row_number" required><br><br>

    <input type="submit" name='rowbtn' value="Добавить ряд">
</form>
        
</body>
</html>