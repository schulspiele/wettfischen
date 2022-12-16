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
    
    if($stmt = $con->prepare("SELECT fish, fish_round FROM rooms WHERE namecode = ?")){
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($fish_in_room, $fish_votes);
        $stmt->fetch();
        $stmt->close();
        if($fish_votes > $fish_in_room) {
            header("Location: /teacher/game_over/");
        } else {
            $fish_in_room = $fish_in_room - $fish_votes;
            $fish_in_room = $fish_in_room * 2;
            if($stmt = $con->prepare("UPDATE rooms SET fish = ? WHERE namecode = ?")){
                $stmt->bind_param("is", $fish_in_room, $id);
                $stmt->execute();
                $stmt->close();
            } else exit("DB-Error");
        }
    } else exit("DB-Error");
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
                        <span id="gameover_note">Runde fertig!</span>
                    </b>
                    <br>    
                    Vielen dank fürs Spielen
                </div>
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