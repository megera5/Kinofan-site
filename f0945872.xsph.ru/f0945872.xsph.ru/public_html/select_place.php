<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Информация о фильмах</title>
<style>
    .container {
            display: flex;
            align-items: center;
        }

    .button {
        margin-left:50px;
        display: inline-block;
        padding: 10px;
        color: white;
        font-size: 20px;
        text-align: center;
        text-decoration: none;
    }
    .button1 {
        text-align:center;
        background-color: #ffe666;
        color: #1c161f;
        border: none;
        padding: 10px 20px;
        text-decoration: none;
        display: inline-block;
        font-size: 18px;
        margin: 4px 2px;
        cursor: pointer;
    }

    h2 {
        font-size:30px;
        color:#ffe666;
    }
    hr {
        margin: 20px 0;
        padding: 0;
        height: 3px;
        border: none;
        background: white;
        width: 100%;
    }
    body {
        background-color: #1c161f;
        color: white;
        padding: 20px;
        display: flex;
        flex-direction: column;
        height: 100vh;
    }
    input[type="submit"] {
        text-align:center;
        background-color: #70547a;
        color: white;
        border: none;
        padding: 10px 20px;
        text-decoration: none;
        display: inline-block;
        font-size: 18px;
        margin: 4px 2px;
        cursor: pointer;
    }
    .hall-layout {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .hall-info {
        font-size: 1.5em;
        margin-bottom: 1em;
        text-align: center;
    }
    .halln{
        font-size: 1.8em;
    }
    .row {
        display:flex;
        justify-content: center;
    }

    .row-number {
        font-size: 1.6em;
        margin-right: 1em;
        margin-top:0.6em;
    }

    .place {
        display: inline-block;
        margin: 0.2em;
        font-size: 1.6em;
    }

    .place-checkbox {
        display: none;
    }

    .place-label {
        display: inline-block;
        width: 2em;
        height: 2em;
        border: 1px solid #4a233a;
        border-radius: 50%;
        text-align: center;
        line-height: 2em;
        cursor: pointer;
        background-color: #521b3ce0;
    }

    .place-checkbox:checked + .place-label {
        background-color: #d9e084;
        color: black;
    }
    .button2 {
        margin: 0 auto;
        text-align:center;
        background-color: #ffe666;
        color: #1c161f;
        border: none;
        padding: 10px 20px;
        text-decoration: none;
        display: inline-block;
        font-size: 18px;
        cursor: pointer;
    }
</style>
</head>
<body>
<form method="post">
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include 'config.php';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    } catch (PDOException $e) {
        echo "Ошибка подключения: " . $e->getMessage();
    }
?>
<div class="container">
    <h2>KINOFAN</h2>
    <a href="eventt.php" class="button"><b>Добавить фильм</b></a>
    <a href="session.php" class="button"><b>Добавить сеанс</b></a>
</div>
<hr>
<a href="new_film.php" class="button1"><b>← К выбору фильма</b></a><br><br>
<?php
    $stmt_location = $pdo->query("SELECT address FROM location");
    while ($row = $stmt_location->fetch()) {
        echo '<input type="submit" name="address" value="' . $row['address'] . '">';
    }
    ?>
</form><br><br>
<?php
if (isset($_POST['address'])) {
    $selected_address = $_POST['address'];

    $stmt_hall = $pdo->prepare("SELECT hall.hall_number, hall.hall_code, location.location_code
            FROM hall
            LEFT JOIN location ON hall.location_code = location.location_code
            WHERE location.address = :selected_address");
    $stmt_hall->execute(['selected_address' => $selected_address]);

    $row = $stmt_hall->fetch();

    echo '<div id="hall-layout">';
    echo "<div class='hall-info'><div class='halln'>Зал " . $row['hall_number'] . "</div>" . '<br>'. "Экран</div>". '<br>' . '<br>';

    $stmt_row = $pdo->prepare("SELECT row.row_number, hall.hall_number, hall.hall_code
            FROM row
            LEFT JOIN hall ON row.hall_code = hall.hall_code
            WHERE hall.hall_code = :hall_code
            ORDER BY row.row_number ASC");

    $stmt_row->execute(['hall_code' => $row['hall_code']]);
    $rows = $stmt_row->fetchAll();

    foreach ($rows as $row) {
        echo '<div class="row">';
        echo '<div class="row-number">' . $row['row_number'] . '</div>';

        $stmt_place = $pdo->prepare("SELECT place.place_number
                FROM place
                LEFT JOIN row ON place.row_code = row.row_code
                WHERE row.row_number = :row_number
                ORDER BY place.place_number ASC");
        $stmt_place->execute(['row_number' => $row['row_number']]);
        $places = $stmt_place->fetchAll();

        foreach ($places as $place) {
            echo '<div class="place">';
            echo '<input type="checkbox" class="place-checkbox" id="place-' . $place['place_number'] . '" name="selected_places[]" value="' . $place['place_number'] . '">';
            echo '<label class="place-label" for="place-' . $place['place_number'] . '">' . $place['place_number'] . '</label>';
            echo '</div>';
        }

        echo '</div>';
    }
    echo '</div>';
}
?>
<br><br>
<a href="order.php" class="button2"><b>Оформить заказ →</b></a><br><br>
</body>
</html>