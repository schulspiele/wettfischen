<?php 

    session_start();
    require('../../../config.php');

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) exit("Error");

    if(!isset($_SESSION['displayname']) || !isset($_POST['room'])) exit("displayname or room");
    $displayname = $_SESSION['displayname'];
    $room = $_POST['room'];

    if($stmt = $con->prepare("SELECT status FROM rooms WHERE namecode = ?")) {
        $stmt->bind_param("i", $room);
        $stmt->execute();
        $stmt->bind_result($status);
        $stmt->fetch();
        echo $status;
        $_SESSION["room"] = $room;
        $stmt->close();
        exit();
    }
?>