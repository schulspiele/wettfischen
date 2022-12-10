<?php 

    session_start();
    require('../../config.php');

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) exit("Error");

    if(!isset($_GET['r'])) header("Location: ../join-room/");
    $id = $_GET['r'];

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Wettfischen</title>
    <link rel="icon" type="image/x-icon" href="/res/img/favicon.ico" />
    <link rel="stylesheet" href="/res/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/res/fontawesome/css/solid.min.css">
    <link rel="stylesheet" href="/res/css/fonts.css">
    <link rel="stylesheet" href="/res/css/main.css">
    <link rel="stylesheet" href="/res/css/student/input.css">
</head>

<body>
    <main>
        <div class="title">
            <h1>Bitte gib ein, wie viel du Fischen willst!</h1>
        </div>
        <div class="number">
            <div id="number_display"></div>
        </div>
        <div class="numpad">
            <div class="numpad_one numpad_key">1</div>
            <div class="numpad_two numpad_key">2</div>
            <div class="numpad_three numpad_key">3</div>
            <div class="numpad_four numpad_key">4</div>
            <div class="numpad_five numpad_key">5</div>
            <div class="numpad_six numpad_key">6</div>
            <div class="numpad_seven numpad_key">7</div>
            <div class="numpad_eight numpad_key">8</div>
            <div class="numpad_nine numpad_key">9</div>
            <div class="numpad_clear numpad_key"><i class="fa-solid fa-xmark"></i></div>
            <div class="numpad_zero numpad_key">0</div>
            <div class="numpad_check numpad_key"><i class="fa-solid fa-check"></i></div>
        </div>
    </main>
    <script src="/res/js/jquery/jquery-3.6.1.min.js"></script>
    <script src="/res/js/student/input.js"></script>
</body>

</html>