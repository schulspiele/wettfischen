<?php 

    session_start();
    require('../../../config.php');

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) exit("Error");

    if(!isset($_SESSION['id']) || !isset($_POST['room'])) exit("id or room");
    $id = $_SESSION['id'];
    $room = $_POST['room'];

    // Get status AND check if round is not the same
    if($stmt = $con->prepare("SELECT status, round FROM rooms WHERE namecode = ?")){
        $stmt->bind_param("i", $room);
        $stmt->execute();
        $stmt->bind_result($status, $room_round);
        $stmt->fetch();
        $stmt->close();
        if($stmt = $con->prepare("SELECT round FROM users WHERE id = ?")){
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $stmt->bind_result($user_round);
            $stmt->fetch();
            $stmt->close();
            if($user_round == $room_round){
                echo "NO";
            } else {
                echo $status;
            }
        
        } else exit("DB-Error");
    }
?>