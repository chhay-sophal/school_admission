<?php
include_once('../include/connection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $folder = '../upload/users/profile/';
    $editProfile = $_FILES['editProfile']['name'];
    $editProfile_temp = $_FILES['editProfile']['tmp_name'];
    $editPassword = $_POST['password'];

    // Update password
    $sql = "UPDATE tblUser SET Password = '$editPassword' WHERE ID = {$_SESSION['userID']}";
    if (!mysqli_query($conn, $sql)) {
        echo 'Error updating password: ' . mysqli_error($conn);
        exit();
    } else {
        $_SESSION['password'] = $editPassword;
    }

    // Update profile image
    if (!empty($editProfile)) {
        move_uploaded_file($editProfile_temp, $folder . $editProfile);
        $sql = "UPDATE tblUser SET Profile = '$editProfile' WHERE ID = {$_SESSION['userID']}";
        if (!mysqli_query($conn, $sql)) {
            echo 'Error updating profile image: ' . mysqli_error($conn);
            exit();
        }
        $_SESSION['profile'] = $editProfile;
    }

    header('Location: http://localhost:8080/application%20form/dashboard.php');
}

mysqli_close($conn);
