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

        include 'config.php';
        
       try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            echo "Информация о билетах: <br>";
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
<table>
   <tr>
        <th>Место проведения</th>
        <th>Номер зала</th>
        <th>Номер ряда</th>
        <th>Номер места</th>
        <th>Коэффициент</th>
    </tr>
<?php
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
    <?php
    $stmt_cost = $pdo->query("SELECT session_code, basic_cost FROM session");
    echo '<select name="session_code" id="session_code">';
        while ($row = $stmt_cost->fetch()) {
            echo "<option value='".$row['session_code']."'>".$row['basic_cost']."</option>";
        }
    echo '</select><br><br>';
    ?>
    
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
    <?php
    $stmt_place = $pdo->query("SELECT place_code, place_number FROM place");
    echo '<select name="place_code" id="place_code">';
        while ($row = $stmt_place->fetch()) {
            echo "<option value='".$row['place_code']."'>".$row['place_number']."</option>";
        }
    echo '</select><br><br>';
    ?>
    
    <label for="ratio">Коэффициент: </label>
    <?php
    $stmt_rat = $pdo->query("SELECT place_code, ratio FROM place");
    echo '<select name="place_code" id="place_code">';
        while ($row = $stmt_rat->fetch()) {
            echo "<option value='".$row['place_code']."'>".$row['ratio']."</option>";
        }
    echo '</select><br><br>';
    ?>


    <input type="submit" name="ticketbtn" value="Добавить билет">
</form>
        
</body>
</html>