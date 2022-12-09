<?php 

    session_start();
    require('../../../config.php');

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) exit("error");

    if(!isset($_SESSION['id'])) exit("error");
    $room = $_SESSION['id'];

    // Get all room codes from database table (rooms)
    // Then exit them as a json array
    if ($stmt = $con->prepare("UPDATE rooms SET require_pass = NOT require_pass WHERE namecode = ?")) {
        $stmt->bind_param('i', $room);
        $stmt->execute();
    }

?>