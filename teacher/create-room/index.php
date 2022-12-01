<?php

// Database credentials
require('../../config.php');

// Connect with the Credentials
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// check if the connection was successfull
if (mysqli_connect_errno()) {

    // Log the error
    error_log("Error(101)-".mysqli_connect_error(),0);
    exit("Error(101)-".mysqli_connect_error());

    // Display an error.
    exit();
}

// Start the PHP_session
session_start();

// Functions to generate an ID
function generateID($length){
    $id_charset = "123465789";
    $generated = "";
    for ($i=0; $i < $length; $i++) { 
        $new_char = substr($id_charset, mt_rand(0, strlen($id_charset) - 1),1);
        $generated .= $new_char;
    }
    return $generated;
}

// Check if id is already taken
$checking_id_double = true;
while($checking_id_double){  
    $new_id = generateID(4);
    if ($stmt = $con->prepare("SELECT * FROM sessions WHERE id = ?")) {
        $stmt->bind_param('s', $new_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
        } else {
            $checking_id_double = false;
            $new_pass = generateID(4);
            $stmt = $con->prepare("INSERT INTO sessions (namecode, passcode) VALUES (?, ?)");
            $stmt->bind_param('ss', $new_id, $new_pass);
            $stmt->execute();
            $stmt->close();
            $con->close();
            $_SESSION['id'] = $new_id;
            $_SESSION['pass'] = $new_pass;
            header("Location: ../room/");
        }
    }
}

?>