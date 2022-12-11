<?php 

    session_start();
    require('../../../config.php');

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) exit("error");

    if(!isset($_SESSION["id"])) exit("error");
    $room = $_SESSION["id"];

    if($stmt = $con->prepare("UPDATE rooms SET status = 7 WHERE namecode = ?")){
        $stmt->bind_param("s", $room);
        $stmt->execute();
        $stmt->close();
        if($stmt = $con->prepare("SELECT fish FROM rooms WHERE namecode = ?")){
            $stmt->bind_param("s", $room);
            $stmt->execute();
            $stmt->bind_result($fish_in_room);
            $stmt->fetch();
            $stmt->close();
            if($stmt = $con->prepare("SELECT SUM(fish) FROM users WHERE room = ?")){
                $stmt->bind_param("s", $room);
                $stmt->execute();
                $stmt->bind_result($fish_votes);
                $stmt->fetch();
                $stmt->close();
                if($fish_votes > $fish_in_room) {
                    if($stmt = $con->prepare("UPDATE rooms SET status = 2 WHERE namecode = ?")){
                        $stmt->bind_param("s", $room);
                        $stmt->execute();
                        $stmt->close();
                        exit("fail");
                    } else exit("error");
                }
                $fish_in_room = $fish_in_room - $fish_votes;
                $fish_in_room = $fish_in_room * 2;
                if($stmt = $con->prepare("UPDATE rooms SET fish = ? WHERE namecode = ?")){
                    $stmt->bind_param("is", $fish_in_room, $room);
                    $stmt->execute();
                    $stmt->close();
                    exit("success");
                } else exit("error");
            } else exit("error");
        } else exit("error");
    } else exit("error");

?>