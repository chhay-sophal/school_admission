<?php
    include_once('connection.php');

    // Query to select data from tblExpired
    $sql = "SELECT * FROM tblExpired WHERE Year = YEAR(NOW())";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $due_date = $row['ExpiredDate'];
        }
    }

    $current_date = date('Y-m-d');
    
    if (strtotime($due_date) < strtotime($current_date)) {
        header('Location: http://localhost:8080/application%20form/expiredPage.php');
        exit;
    } else {
        header('Location: http://localhost:8080/application%20form/register.php');
    }
?>