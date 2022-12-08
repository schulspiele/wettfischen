<?php 

    session_start();
    require('../../../config.php');

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) exit("Error");

    if(!isset($_POST['displayname']) || !isset($_POST['room']) || !isset($_POST['code'])) exit("Error");
    $displayname = $_POST['displayname'];
    $room = $_POST['room'];
    $code = $_POST['code'];

    // Check if displayname is valid
    if (strlen($displayname) < 4 || strlen($displayname) > 16) {
        exit("Error");
    }

    // Check if displayname is already taken in this room
    if ($stmt = $con->prepare("SELECT * FROM users WHERE room = ? AND name = ?")) {
        $stmt->bind_param('ss', $room, $displayname);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) exit("Error");
        $stmt->close();

        $_SESSION['displayname'] = $displayname;

        // Insert displayname into database table (users)
        // Columns: name, room, type = 1
        if ($stmt = $con->prepare("INSERT INTO users (name, room, type) VALUES (?, ?, 1)")) {
            $stmt->bind_param('ss', $displayname, $room);
            $stmt->execute();
            $_SESSION['id'] = $con->insert_id;
            $stmt->close();
            exit("success");
        }
    }

?>