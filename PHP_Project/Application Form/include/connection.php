<?php
    // function connection(){
    //     // Create connection
    //     $con = mysqli_connect("localhost", "root", "", "db_student_management");

    //     // Check connection
    //     if (!$con) {
    //         die("Connection failed: " . mysqli_connect_error());
    //     }
    //     echo "Connected successfully";
    // }
    
    // Establish a database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbRegister";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>