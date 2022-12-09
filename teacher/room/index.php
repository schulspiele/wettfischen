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
    <link rel="stylesheet" href="/res/css/teacher/settings.css">
</head>

<body>
    <main>
        <div class="game_info">
            <div class="game_details_container" id="game_details_container">
                <div class="join_link">Tritt dem Raum bei:<br><b><span id="server_host_url"><?=$_SERVER['HTTP_HOST']?></span></b></div>
                <div class="game_details">
                    <div class="game_id_text">Raum-ID:</div>
                    <div class="game_id" id="game_id-display"><?=$id?></div>
                </div>
                <div class="game_pass_details" id="game_pass_details">
                    <div class="game_pass_text">Raum-Passwort:</div>
                    <div class="game_pass" id="game_pass-display"><?=$pass?></div>
                </div>
                <div class="game_qrcode" id="game_qrcode"></div>
            </div>
        </div>
        <div class="player_list" id="player_list-container">
        </div>
    </main>
    <div id="start_button" class="start_button" onclick="room.start();">
        Start <i class="fas fa-play"></i>
    </div>
    <div class="overlay" id="quick_action-overlay">
        <div class="overlay-content">
            <button class="fullscreen-button" onclick="toggleFullScreen();">
                <i class="fas fa-expand"></i>
            </button>
            <button class="settings-button" id="settings_toggle" onclick="settings.open();">
                <i class="fas fa-cog"></i>
            </button>
        </div>
    </div>
    <div class="settings" id="settings">
        <div class="settings_item" id="room_settings">
            <h1>Raum</h1>
            <ul>
                <li onclick="settings.toggle(this, 'show_roomcode');" class="settings_active">Raum-ID anzeigen</li>
                <li onclick="settings.toggle(this, 'activate_roompasscode');" class="settings_inactive">Raum mit Passwort</li>
                <li onclick="settings.toggle(this, 'show_room-qr');" class="settings_active">QR-Code zeigen</li>
            </ul>
        </div> <hr>
        <div class="settings_item" id="number_settings">
            <h1>Startanzahl</h1>
            <ul>
                <li onclick="settings.toggle(this, 'random_fishnum');" class="settings_toggle" id="fishnum_settings_toggle">Zufällig</li>
                <li id="fishnum_settings_input"><input type="number" id="fishnum_settings_input_input" min="5" value="15"></li>
            </ul>
        </div>
    </div>
    <script src="/res/js/jquery/jquery-3.6.1.min.js"></script>
    <script src="/res/js/qrcode/qrcode.js"></script>
    <script src="/res/js/teacher/fullscreen.js"></script>
    <script src="/res/js/teacher/loadStudents.js"></script>
    <script src="/res/js/teacher/gameplay.js"></script>
    <script src="/res/js/teacher/qrcode.js"></script>
    <script src="/res/js/teacher/settings.js"></script>
    <script src="/res/js/teacher/setFishNum.js"></script>
</body>

</html>