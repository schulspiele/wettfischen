<?php 

    session_start();
    require('../../../config.php');

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) exit("error");

    if(!isset($_SESSION['id'])) exit("error");
    $room = $_SESSION['id'];

    if ($stmt = $con->prepare("SELECT fish FROM rooms WHERE namecode = ?")) {
        $stmt->bind_param('s', $room);
        $stmt->execute();
        $stmt->bind_result($fish_num);
        $stmt->fetch();
        $stmt->close();
        echo $fish_num;
    }

?>