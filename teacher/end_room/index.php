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

    if ($stmt = $con->prepare("UPDATE rooms SET status = 3 WHERE namecode = ?")) {
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->close();
    }

    session_destroy();

    header("Location: ../../");
    
?>