<?php
include_once('../include/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $requestId = $_POST['request_id'];
    $status = $_POST['status'];

    $sql = "UPDATE tblRegister SET Status = '$status' WHERE ID = $requestId";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        // Return success response to AJAX request
        http_response_code(200);
        echo "Request status updated successfully";
    } else {
        echo "Error updating request status: " . $conn->error;
        $conn->close();
    }
} else {
    echo "Invalid request method";
}
