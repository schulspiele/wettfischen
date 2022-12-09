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
    
    if ($stmt = $con->prepare("SELECT passcode, fish FROM rooms WHERE namecode = ?")) {
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($passcode, $fish);
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
        <div class="container">
            <div class="student_infotext">
                <h1>Bitte wählt wie viel ihr Fischen wollt</h1>
            </div>
            <div class="roominfo">
            </div>
        </div>
    </main>
    <div class="container_url">
        <div id="container_url_text">
            https://<?=$_SERVER['HTTP_HOST']?>
        </div>
    </div>
    <div class="container_fishnum">
        <i class="fa-solid fa-fish-fins"></i> <span id="fishnum">???</span>
    </div>
    <div class="container_roomdetails">

    </div>
    <div class="container_build">

    </div>
    <div id="skip_button" class="skip_button" onclick="room.skip_student_wait();">Runde beenden <i class="fa-solid fa-forward"></i>
    </div>
    <div class="overlay">
        <div class="overlay-content">
            <button class="fullscreen-button" onclick="toggleFullScreen();">
                <i class="fas fa-expand"></i>
            </button>
        </div>
    </div>
    <script src="/res/js/jquery/jquery-3.6.1.min.js"></script>
    <script src="/res/js/teacher/fullscreen.js"></script>
    <script src="/res/js/teacher/gameplay.js"></script>
</body>

</html>