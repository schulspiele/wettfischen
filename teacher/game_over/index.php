<?php 

    session_start();

    if(!isset($_SESSION['id']) || !isset($_SESSION['pass'])){
        header("Location: ../");
    } else {
        $id = $_SESSION['id'];
        $pass = $_SESSION['pass'];
    }

    require('../../config.php');

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) exit("DB-Error");
    
    // Get user details 
    if ($stmt = $con->prepare("SELECT COUNT(*) FROM users WHERE room = ?")) {
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($num_users);
        $stmt->fetch();
        $stmt->close();
    }
    // Get room details
    if ($stmt = $con->prepare("SELECT fish_start, round, fish_ges FROM rooms WHERE namecode = ?")) {
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($fish_start, $rounds_played, $fish_ges);
        $stmt->fetch();
        $stmt->close();
    }
    // Set room status to 2
    if ($stmt = $con->prepare("UPDATE rooms SET status = 2 WHERE namecode = ?")) {
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->close();
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
    <link rel="stylesheet" href="/res/css/teacher/game_over.css">
</head>

<body>
    <main>
        <div class="gameover_info">
            <div class="gameover_container">
                <div class="join_link">
                    <b>
                        <span id="gameover_note">Game over!</span>
                    </b>
                    <br>    
                    Vielen dank fürs Spielen
                </div>
            </div>
        </div>
        <div class="scorelist">

        </div>
        <div class="stats">
            <div class="stat-player_num stat-container">
                <div class="stats-item_title">Spieler*innen</div>
                <div class="stats-item_content"><?=$num_users?></div>
            </div>
            <div class="stat-fish_start stat-container">
                <div class="stats-item_title">Fische beim Start</div>
                <div class="stats-item_content"><?=$fish_start?></div>
            </div>
            <div class="stat-fish_end stat-container">
                <div class="stats-item_title">Fische gefischt</div>
                <div class="stats-item_content"><?=$fish_ges?></div>
            </div>
            <div class="stat_rounds stat-container">
                <div class="stats-item_title">Runden gespielt</div>
                <div class="stats-item_content"><?=$rounds_played?></div>
            </div>
        </div>
    </main>
    <div class="restart_button" onclick="room.restart();">
        <i class="fas fa-redo-alt"></i>
    </div>
    <script src="/res/js/jquery/jquery-3.6.1.min.js"></script>
    <script src="/res/js/teacher/gameplay.js"></script>
</body>

</html>