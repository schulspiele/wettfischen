<?php 

    session_start();
    require('../../../config.php');

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) exit("error");

    if(!isset($_SESSION['id']) || !isset($_POST["require_pass"])) exit("error");
    $room = $_SESSION['id'];
    $require_pass = $_POST["require_pass"];
    $require_pass = $require_pass == "true" ? 1 : 0;

    // Get all room codes from database table (rooms)
    // Then exit them as a json array
    if ($stmt = $con->prepare("UPDATE rooms SET require_pass = ? WHERE namecode = ?")) {
        $stmt->bind_param('ii', $require_pass, $room);
        $stmt->execute();
        exit("UPDATE rooms SET require_pass = $require_pass WHERE namecode = $room");
    }

?>