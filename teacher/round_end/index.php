<?php 

    session_start();

    if(!isset($_SESSION['id']) || !isset($_SESSION['pass'])){
        header("Location: ../");
    } else {
        $id = $_SESSION['id'];
        $pass = $_SESSION['pass'];
    }

    require('../../config.php');

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) exit("DB-Error");
    
    if($stmt = $con->prepare("SELECT fish, fish_round FROM rooms WHERE namecode = ?")){
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($fish_in_room, $fish_votes);
        $stmt->fetch();
        $stmt->close();
        if($fish_votes >= $fish_in_room) {
            header("Location: /teacher/game_over/");
        } else {
            $fish_in_room = $fish_in_room - $fish_votes;
            $fish_in_room = $fish_in_room * 2;
            if($stmt = $con->prepare("UPDATE rooms SET fish = ?, status = 5 WHERE namecode = ?")){
                $stmt->bind_param("is", $fish_in_room, $id);
                $stmt->execute();
                $stmt->close();
                header("Location: /teacher/between_rounds/");
            } else exit("DB-Error");
        }
    } else exit("DB-Error");
?>