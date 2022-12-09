<?php 

    session_start();
    require('../../../config.php');

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) exit("error");

    if(!isset($_SESSION['id']) || !isset($_POST["fish_num"])) exit("error");
    $room = $_SESSION['id'];
    $fish_num = $_POST["fish_num"];

    if ($stmt = $con->prepare("UPDATE rooms SET fish = ? WHERE namecode = ?")) {
        $stmt->bind_param('is', $fish_num, $room);
        $stmt->execute();
    }

?>