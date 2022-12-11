<?php 

    session_start();

    if(!isset($_SESSION['id']) || !isset($_SESSION['pass'])){
        header("Location: ../../");
    } else {
        $id = $_SESSION['id'];
        $pass = $_SESSION['pass'];
    }

    require('../../config.php');

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) exit("DB-Error");
    
    if ($stmt = $con->prepare("SELECT require_pass, passcode, fish, round FROM rooms WHERE namecode = ?")) {
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($require_pass, $passcode, $fish, $round);
        $stmt->fetch();
        $stmt->close();
    }

    // Get number of users in room
    if ($stmt = $con->prepare("SELECT COUNT(*) FROM users WHERE room = ?")) {
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($num_users);
        $stmt->fetch();
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
    <link rel="stylesheet" href="/res/css/teacher/wait_students.css">
</head>

<body>
    <main>
        <div class="container" id="main_container">
            <div class="student_infotext">
                <h1>Bitte wählt wie viel ihr Fischen wollt</h1>
            </div>
            <div class="roominfo_id roominfo_container">
                <span>Raum-ID: <span class="roominfo"><?=$id?></span></span>
            </div>
            <?php 
                if($require_pass){
                    echo '<div class="roominfo_passcode roominfo_container">
                            <span>Raum-Passwort: <span class="roominfo">'.$passcode.'</span></span>
                        </div>';
                } else {
                    echo '<script>
                        document.getElementById("main_container").style.gridTemplateAreas = \'"student_infotext" "roominfo_id"\';
                        document.getElementById("main_container").style.gridTemplateColumns = "1fr";
                    </script>';
                }
            ?>
        </div>
    </main>
    <div class="container_url">
        <div id="container_url_text">
            https://<?=$_SERVER['HTTP_HOST']?>
        </div>
    </div>
    <div class="container_fishnum" id="container_fishnum">
        <i class="fa-solid fa-fish-fins"></i> <span id="fishnum">???</span>
    </div>
    <div id="skip_button" class="skip_button" onclick="room.end_round(true);">
        Runde beenden <i class="fa-solid fa-forward"></i>
    </div>
    <div class="people_voted" id="people_voted_container">
        <i class="fa-solid fa-person"></i>
        <span id="people_voted">0</span> / <?=$num_users?>
    </div>
    <script src="/res/js/jquery/jquery-3.6.1.min.js"></script>
    <script src="/res/js/teacher/gameplay.js"></script>
    <script src="/res/js/teacher/getFishNum.js"></script>
    <script src="/res/js/teacher/getVoteNum.js"></script>
</body>

</html>