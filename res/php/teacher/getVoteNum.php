<?php 

    session_start();
    require('../../../config.php');

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) exit("error");

    if(!isset($_SESSION['id'])) exit("error");
    $room = $_SESSION['id'];

    // Get number of users in room that are in the same round as the "round" column in the rooms table and voted is not 0
    if ($stmt = $con->prepare("SELECT COUNT(*) FROM users WHERE room = ? AND round = (SELECT round FROM rooms WHERE namecode = ?) AND voted != 0")) {
        $stmt->bind_param('ss', $room, $room);
        $stmt->execute();
        $stmt->bind_result($num_users);
        $stmt->fetch();
        $stmt->close();
        echo $num_users;
    }

?>