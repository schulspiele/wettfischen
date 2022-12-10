<?php 

    session_start();
    require('../../../config.php');

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) exit("Error");

    if(!isset($_POST['number'])) exit("Error");
    $fish_number = $_POST['number'];

    // Increase round number and set fish number
    if ($stmt = $con->prepare("UPDATE users SET round = round + 1, fish = ? WHERE room = ? AND name = ?")) {
        $stmt->bind_param('iis', $fish_number, $_SESSION['room'], $_SESSION['displayname']);
        $stmt->execute();
        $stmt->close();
        exit("success");
    }

?>