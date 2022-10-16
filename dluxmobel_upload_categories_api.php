<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $text= $_POST['text'];
    
    define('HOST', 'localhost');
    define('USER', 'dluxapp_user');
    define('PASS', 'dluxapp_password1234');
    define('DB', 'dluxmobel_app');

    $con = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect');

    $sql = "SELECT id FROM categories ORDER BY id ASC";

    $res = mysqli_query($con, $sql);

    $id = 0;

    while ($row = mysqli_fetch_array($res)) {
        $id = $row['id'];
    }
    
  
    $sql = "INSERT INTO categories (text) VALUES ('$text')";

    if (mysqli_query($con, $sql)) {
        echo "Successfully Uploaded";
    }

    mysqli_close($con);
} else {
    echo "Error";
}
