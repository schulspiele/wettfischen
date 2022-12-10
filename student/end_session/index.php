<?php

    session_start();
    require('../../config.php');

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) exit("Error");

    // Set room to inactive (status = 3)
    if($stmt = $con->prepare("UPDATE rooms SET status = 3 WHERE id = ?")) {
        $stmt->bind_param("i", $_SESSION['id']);
        $stmt->execute();
        $stmt->close();
    }

    session_destroy();

    header("Location: ../../");
    
?>