<?php 

    session_start();

    if(!isset($_SESSION['id']) || !isset($_SESSION['pass'])){
        header("Location: ../");
    } else {
        $id = $_SESSION['id'];
        $pass = $_SESSION['pass'];
    }


?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wettfischen</title>
    <link rel="icon" type="image/x-icon" href="/res/img/favicon.ico" />
    <link rel="stylesheet" href="/res/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/res/fontawesome/css/solid.min.css">
    <link rel="stylesheet" href="/res/css/fonts.css">
    <link rel="stylesheet" href="/res/css/main.css">
    <link rel="stylesheet" href="/res/css/teacher/room.css">
</head>

<body>
    <main>
        <div class="game_info">
            <div class="game_details_container">
                <div class="join_link">Tritt dem Raum bei:<br><b><?=$_SERVER['HTTP_HOST']?></b></div>
                <div class="game_details">
                    <div class="game_id_text">Raum-ID:</div>
                    <div class="game_id"><?=$id?></div>
                </div>
            </div>
        </div>
        <div class="player_list" id="player_list-container">
        </div>
    </main>
    <div id="start_button" class="start_button">
        Start <i class="fas fa-play"></i>
    </div>
    <div class="overlay">
        <div class="overlay-content">
            <button class="fullscreen-button" onclick="toggleFullScreen()">
                <i class="fas fa-expand"></i>
            </button>
            <button class="settings-button">
                <i class="fas fa-cog"></i>
            </button>
        </div>
    </div>
    <script src="/res/js/jquery/jquery-3.6.1.min.js"></script>
    <script src="/res/js/teacher/fullscreen.js"></script>
    <script src="/res/js/teacher/loadStudents.js"></script>
</body>

</html>