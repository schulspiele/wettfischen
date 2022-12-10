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
                Bitte gib das Raumpasswort ein
            </div>
        </div>
        <div class="overlay_bottom">
            <div class="overlay_input">
                <div>
                    <input type="text" name="roomcode" id="roomcode_input" maxlength="4">
                </div>
                <div>
                    <!-- Button that redirects to /student/room/?r=[room] -->
                    <!-- Roomcode needs to be all uppercase -->
                    <button id="roomcode_submit" onclick="location.href = '/student/room/?r=<?=$_GET['r']?>&c=' + document.getElementById('roomcode_input').value.toUpperCase();">Raum prüfen</button>
                </div>
            </div>
        </div>
    </div>
    <script src="/res/js/jquery/jquery-3.6.1.min.js"></script>
    <script src="/res/js/student/validateRoomcode.js"></script>
</body>

</html>