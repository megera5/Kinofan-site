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
        <th>Номер места</th>
        <th>Коэффициент</th>
    </tr>
    <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        include 'config.php';
        
       try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            echo "Информация о местах: <br>";
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }

        $stmt_locat = $pdo->query("SELECT location.address, hall.hall_number, hall.hall_code
                FROM hall 
                JOIN location ON hall.location_code = location.location_code");

        $stmt_halls = $pdo->query("SELECT row.row_number, hall.hall_number, hall.hall_code, row.row_code
                FROM row 
                LEFT JOIN hall ON row.hall_code = hall.hall_code")->fetchAll();

        $stmt_row = $pdo->query("SELECT place.place_number, place.ratio, row.row_code
                FROM place
                LEFT JOIN row ON place.row_code = row.row_code")->fetchAll();

        while ($row = $stmt_locat->fetch()) {
            echo "<tr><td>".$row['address']."</td><td>".$row['hall_number']."</td>";
            $hall_code = $row['hall_code'];

        $filtered_halls = array_filter($stmt_halls, function($item) use ($hall_code) {
            return $item['hall_code'] == $hall_code;
        });

        foreach ($filtered_halls as $row2) {
            echo "<td>".$row2['row_number']."</td>";
            $row_code = $row2['row_code'];

        $filtered_rows = array_filter($stmt_row, function($item) use ($row_code) {
            return $item['row_code'] == $row_code;
        });

        foreach ($filtered_rows as $row3) {
            echo "<td>".$row3['place_number']."</td><td>".$row3['ratio']."</td>";
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
    <?php
    $stmt_row = $pdo->query("SELECT row_code, row_number FROM row");
    echo '<select name="row_code" id="row_code">';
        while ($row = $stmt_row->fetch()) {
            echo "<option value='".$row['row_code']."'>".$row['row_number']."</option>";
        }
    echo '</select><br><br>';
    ?>
    
    <label for="place_number">Номер места: </label>
    <input type="number" id="place_number" name="place_number" required><br><br>
    
    <label for="ratio">Коэффициент: </label>
    <input type="number" id="ratio" name="ratio" required><br><br>


    <input type="submit" name="placebtn" value="Добавить место">
</form>
        
</body>
</html>