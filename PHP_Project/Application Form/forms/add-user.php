<?php
include_once('../include/connection.php');

session_start();
$folder = '../upload/users/profile/';

// Check if a file was uploaded
if (isset($_FILES['createProfile']) && $_FILES['createProfile']['error'] === UPLOAD_ERR_OK) {
    $createProfile = $_FILES['createProfile']['name'];
    $createProfile_temp = $_FILES['createProfile']['tmp_name'];
} else {
    // Handle the case where no file was uploaded or an error occurred
    $createProfile = '';
    $createProfile_temp = '';
}

// $createUsername = 'Phearak';
// $createPassword = 'Phearak12';
// $createEmail = 'phearakph2003@gmail.com';
// $createRole = 1;
// $createStatus = 1;

$createUsername = mysqli_real_escape_string($conn, $_POST['createUsername']);
$createPassword = mysqli_real_escape_string($conn, $_POST['createPassword']);
$createEmail = mysqli_real_escape_string($conn, $_POST['createEmail']);
$createRole = mysqli_real_escape_string($conn, $_POST['createRole']);
$createStatus = mysqli_real_escape_string($conn, $_POST['createStatus']);

// Check if the username already exists
$sql = "SELECT COUNT(*) AS count FROM tblUser WHERE Username = '$createUsername'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['count'] > 0) {
    // If the username already exists, prepare a JSON response
    $response = array(
        'status' => 'Error',
        'message' => 'Username already exists. Please choose a different username.'
    );
} else {
    // Hash the password
    $hashedPassword = password_hash($createPassword, PASSWORD_DEFAULT);

    $sql = "INSERT INTO tblUser (Username, Password, Email, Role, Status, Profile, Created_by)
            VALUES ('$createUsername', '$hashedPassword', '$createEmail', $createRole, $createStatus, '$createProfile', '{$_SESSION["username"]}')";

    if (mysqli_query($conn, $sql)) {
        if (mysqli_affected_rows($conn) > 0 && !empty($createProfile)) {
            move_uploaded_file($createProfile_temp, $folder . $createProfile);
        } else {
            echo 'The query was executed but no rows were affected';
        }
        // Prepare a JSON response for a successful operation
        $response = array(
            'status' => 'Success',
            'message' => 'User created successfully.'
        );
    } else {
        // Prepare a JSON response for a failed operation
        $response = array(
            'status' => 'Error',
            'message' => 'Error executing the query: ' . mysqli_error($conn)
        );
    }
}

mysqli_close($conn);

// Send the JSON response
echo json_encode($response);
