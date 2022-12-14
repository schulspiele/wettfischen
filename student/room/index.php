<?php 

    session_start();
    require('../../config.php');

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) exit("Error");

    if(!isset($_GET['r'])) header("Location: ../join-room/");
    $id = $_GET['r'];

    if ($stmt = $con->prepare("SELECT status, passcode, require_pass FROM rooms WHERE namecode = ? /* AND passcode = ? */")) {
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($status, $passcode, $require_pass);
        $stmt->fetch();
        $stmt->close();
        if ($status != 9 ) header("Location: ../join-room/");
        if ($require_pass == 1) if (!isset($_GET['c']) || $passcode != $_GET['c']) header("Location: ../join-room/passcode.php?r=$id");
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
    <link rel="stylesheet" href="/res/css/student/room.css">
</head>

<body>
    <div class="overlay">
        <div class="overlay_top">
            <div class="overlay_title">
                Wähle einen Anzeigenamen
            </div>
        </div>
        <div class="overlay_bottom">
            <div class="overlay_input">
                <div>
                    <input type="text" name="displayname" id="displayname_input" maxlength="16" minlength="4">
                </div>
                <div>
                    <button id="displayname_submit" onclick="submitDisplayname(this);">Raum beitreten</button>
                </div>    
            </div>
        </div>
    </div>
    <main>
        <h1>
            Bitte warte, bis dein(e) Lehrer*in die Runde startet.
        </h1>
    </main>
    <script src="/res/js/jquery/jquery-3.6.1.min.js"></script>
    <script src="/res/js/student/validateDisplayname.js"></script>
    <script src="/res/js/student/submitDisplayname.js"></script>
    <script src="/res/js/student/checkRoomReady.js"></script>
</body>

</html>