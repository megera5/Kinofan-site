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
    .movie-info {
        color: white;
        font-size: 40px;
        text-align: center;
    }

    .movie-name {
        font-size: 22px;
        vertical-align: top;
        color:#ffe666;
    }

    .movie-time {
        color: white;
        font-size: 25px;
        vertical-align: top;
    }

    .movie-price {
        font-size: 32px;
        color: #b48fbd;
    }
    a{
        color:#b48fbd;
    }


</style>
</head>
<body>
<form method ="post">
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $host = 'localhost';
    $dbname = 'f0945872_film';
    $user = 'f0945872_film';
    $password = 'Annamart05!';

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
<?php
    $stmt_date = $pdo->query("SELECT DISTINCT date FROM session");
    while ($row = $stmt_date->fetch()) {
        echo '<input type="submit" name="date" value="' . $row['date'] . '">';
    }
?>
</form><br><br>
<?php
    if (isset($_POST['date'])) {
        $selected_date = $_POST['date'];

        $stmt_film = $pdo->prepare("SELECT e.* FROM event e
                                JOIN session s ON e.event_code = s.event_code
                                WHERE s.date = :selected_date");
        $stmt_film->bindParam(':selected_date', $selected_date, PDO::PARAM_STR);
        $stmt_film->execute();

        $stmt_time = $pdo->query("SELECT session.time, session.basic_cost, session.event_code, event.event_code
                FROM session
                LEFT JOIN event ON session.event_code = event.event_code")->fetchAll();

        if ($stmt_film->rowCount() > 0) {
            while ($row_movies = $stmt_film->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="movie-name"><span class="movie-info">'. $row_movies['event_name'] . '</span> ' . $row_movies['year_of_manufacture'] . '</div>'.'<br>';
                $event_code = $row_movies['event_code'];
                foreach ($stmt_time as $row2) {
                    if ($row2['event_code'] == $event_code) {
                        echo '<div class="movie-time"><span class="movie-price"><a href="select_place.php?time=' . urlencode($row2['time']) . '">' . $row2['time'] . '</a></span> ' . $row2['basic_cost'] ."₽". '</div>';
                    }
                }
                ?>
                <br><br>
        <?php
            }
        } else {
            echo "Нет фильмов на выбранную дату.";
        }
    }
?>
</body>
</html>