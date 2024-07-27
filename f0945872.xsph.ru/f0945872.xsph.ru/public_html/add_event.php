<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить фильм</title>
</head>
<body>
<?php
    if(isset($_POST['genrebtn'])){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include 'connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $genre_names = $_POST['genre_names'];
    
            $stmt_insert_genre = $pdo->prepare("INSERT INTO genre (genre_name) VALUES (?)");
            $stmt_insert_genre->execute([$genre_names]);
    
            echo "Жанр успешно добавлен!";
    
            header("Location: event.php");
            exit();
        }
    }
    
    if(isset($_POST['filmbtn'])){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include 'connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $event_name = $_POST['event_name'];
            $genre_code = $_POST['genre_code'];
            $duration = $_POST['duration'];
            $year_of_manufacture = $_POST['year_of_manufacture'];
    
            $stmt_insert_event = $pdo->prepare("INSERT INTO event (genre_code, event_name, duration, year_of_manufacture) VALUES (?, ?, ?, ?)");
            $stmt_insert_event->execute([$genre_code, $event_name, $duration, $year_of_manufacture]);
    
            echo "Фильм успешно добавлен!";
    
            header("Location: event.php");
            exit();
        }
    }
    if(isset($_POST['sessbtn'])){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include 'connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $event_code = $_POST['event_code'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $basic_cost = $_POST['basic_cost'];
    
            $stmt_insert_session = $pdo->prepare("INSERT INTO session (event_code, date, time, basic_cost) VALUES (?, ?, ?, ?)");
            $stmt_insert_session->execute([$event_code, $date, $time, $basic_cost]);
    
            echo "Сеанс успешно добавлен!";
    
            header("Location: event.php");
            exit();
        }
    }
    if(isset($_POST['locatbtn'])){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include 'connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $address = $_POST['address'];
    
            $stmt_insert_location = $pdo->prepare("INSERT INTO location (address) VALUES (?)");
            $stmt_insert_location->execute([$address]);
    
            echo "Место успешно добавлено!";
    
            header("Location: event.php");
            exit();
        }
    }
    if(isset($_POST['hallbtn'])){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include 'connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $location_code = $_POST['location_code'];
            $hall_number = $_POST['hall_number'];
    
            $stmt_insert_hall = $pdo->prepare("INSERT INTO hall (location_code, hall_number) VALUES (?,?)");
            $stmt_insert_hall->execute([$location_code, $hall_number]);
    
            echo "Зал успешно добавлен!";
    
            header("Location: event.php");
            exit();
        }
    }
    if(isset($_POST['rowbtn'])){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include 'connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $hall_code = $_POST['hall_code'];
            $row_number = $_POST['row_number'];
    
            $stmt_insert_row = $pdo->prepare("INSERT INTO row (hall_code, row_number) VALUES (?,?)");
            $stmt_insert_row->execute([$hall_code, $row_number]);
    
            echo "Ряд успешно добавлен!";
    
            header("Location: event.php");
            exit();
        }
    }
    if(isset($_POST['placebtn'])){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include 'connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $row_code = $_POST['row_code'];
            $place_number = $_POST['place_number'];
            $ratio = $_POST['ratio'];
    
            $stmt_insert_place = $pdo->prepare("INSERT INTO place (row_code, place_number, ratio) VALUES (?,?,?)");
            $stmt_insert_place->execute([$row_code, $place_number, $ratio]);
    
            echo "Место успешно добавлен!";
    
            header("Location: event.php");
            exit();
        }
    }
    if(isset($_POST['ticketbtn'])){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include 'connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $session_code = $_POST['session_code'];
            $place_code = $_POST['place_code'];
    
            $stmt_insert_ticket = $pdo->prepare("INSERT INTO place (session_code, place_code) VALUES (?,?)");
            $stmt_insert_ticket->execute([$session_code, $place_code]);
    
            echo "Билет успешно добавлен!";
    
            header("Location: event.php");
            exit();
        }
    }
?>
</body>
</html>