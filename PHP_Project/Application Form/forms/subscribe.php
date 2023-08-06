<?php
include_once('../include/connection.php');

if (isset($_POST['nameSub']) && isset($_POST['emailSub'])) {
    header('Content-Type: application/json');

    $name = mysqli_real_escape_string($conn, $_POST['nameSub']);
    $email = mysqli_real_escape_string($conn, $_POST['emailSub']);

    $sql = "SELECT * FROM tblSubscribe WHERE Email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo json_encode(array('success' => 0, 'message' => 'Email already exists'));
    } else {
        $sql = "INSERT INTO tblSubscribe (Name, Email, Subscribe_Date) VALUES ('$name', '$email', NOW());";
        mysqli_query($conn, $sql);

        echo json_encode(array('success' => 1));
    }
} else {
    echo json_encode(array('success' => 0, 'message' => 'Invalid form data'));
}
