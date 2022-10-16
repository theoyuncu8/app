<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'dluxapp_user');
define('DB_PASS', 'dluxapp_password1234');
define('DB_NAME', 'dluxmobel_app');



$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);



if ($con) {
    $id = $_POST['id'];

    $getData = "SELECT * FROM products WHERE id = '$id'";

    if ($id != "") {
        $result = mysqli_query($con, $getData);
        $rows = mysqli_num_rows($result);
        $response = array();

        if ($rows > 0) {
            $delete = "DELETE FROM products WHERE id = '$id'";
            $exequery = mysqli_query($con, $delete);

            if ($exequery) {
                array_push($response, array(
                    'status' => 'OK'
                ));
            } else {
                array_push($response, array(
                    'status' => 'FAILED'
                ));
            }
        } else {
            array_push($response, array(
                'status' => 'FAILED'
            ));
        }
    } else {
        array_push($response, array(
            'status' => 'FAILED'
        ));
    }
} else {
    array_push($response, array(
        'status' => 'FAILED'
    ));
}

echo json_encode(array("server_response" => $response));
mysqli_close($con);
?>