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
    
    if($stmt = $con->prepare("UPDATE rooms SET status = 5 WHERE namecode = ?")){
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->close();
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
                        <span id="gameover_note">Runde zuende!</span>
                    </b>
                </div>
            </div>
        </div>
    </main>
    <div class="restart_button" onclick="room.next_round();">
        Nächste Runde <i class="fa-regular fa-square-caret-right"></i>
    </div>
    <script src="/res/js/jquery/jquery-3.6.1.min.js"></script>
    <script src="/res/js/teacher/gameplay.js"></script>
</body>

</html>