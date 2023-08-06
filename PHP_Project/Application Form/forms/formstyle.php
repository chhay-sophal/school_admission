<?php
include_once('../include/connection.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $formStyle = $_POST['formStyle'];

    $sql = "UPDATE tblFormReg SET Form = $formStyle WHERE ID = 1";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header('Location: http://localhost:8080/application%20form/dashboard.php');
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
        $conn->close();
    }
}
