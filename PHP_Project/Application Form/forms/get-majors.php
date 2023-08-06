<?php
include_once('../include/connection.php');
// Get the selected degree level ID from the query string
$levelId = $_GET['level_id'];
// Construct the SQL query to select the majors for the selected degree level
$sql = "SELECT tblMajor.ID, tblMajor.Title AS Major, tblLevel.Title AS Level
        FROM tblSubject
        JOIN tblMajor ON tblSubject.Title = tblMajor.ID
        JOIN tblLevel ON tblSubject.Level = tblLevel.ID WHERE tblLevel.ID = $levelId";
// Execute the query
$result = mysqli_query($conn, $sql);
// Create an array to hold the results
$majors = array();
// Loop through the results and add them to the array
while ($row = mysqli_fetch_assoc($result)) {
  $majors[] = $row;
}
// Return the results as JSON
echo json_encode($majors);
