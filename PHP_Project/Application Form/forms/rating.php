<?php
include_once('../include/connection.php');

// Get the form data
if (isset($_POST['rate']) && isset($_POST['nameRating']) && isset($_POST['commentsRating'])) {
    header('Content-Type: application/json');

    // Get the form data
    $rating = $_POST['rate'];
    $name = $_POST['nameRating'];
    $comments = $_POST['commentsRating'];

    // Insert the data into the database
    $sql = "INSERT INTO ratings (rating, name, comments) VALUES ($rating, '$name', '$comments');";
    mysqli_query($conn, $sql);

    // retrieve data for new rating
    $newRatingSql = "SELECT * FROM ratings WHERE id = " . mysqli_insert_id($conn);
    $newRatingResult = mysqli_query($conn, $newRatingSql);
    $newRating = mysqli_fetch_assoc($newRatingResult);

    // Return a JSON response
    echo json_encode(array('success' => 1, 'data' => $newRating));
} else {
    echo json_encode(array('success' => 0));
}

mysqli_close($conn);
