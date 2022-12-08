<?php 

    session_start();
    require('../../../config.php');

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) exit("error");

    if(!isset($_SESSION["id"])) exit("error");
    $room = $_SESSION["id"];

    // Set status column to 1 (where room = $room)
    if($stmt = $con->prepare("UPDATE rooms SET status = 1 WHERE namecode = ?")){
        $stmt->bind_param("s", $room);
        $stmt->execute();
        $stmt->close();
        exit("success");
    } else exit("error");

?>