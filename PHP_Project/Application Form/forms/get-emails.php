<?php
include_once('../include/connection.php');

// Query to retrieve email addresses
$sql = "SELECT Email FROM tblSubscribe";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $emails = array();
  // Loop through results and add email addresses to array
  while($row = $result->fetch_assoc()) {
    $emails[] = $row["Email"];
  }
  // Return email addresses as JSON response
  echo json_encode(array("emails" => $emails));
} else {
  echo "No results found";
}

$conn->close();
