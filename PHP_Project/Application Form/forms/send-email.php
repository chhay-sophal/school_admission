<?php
include_once('../include/connection.php');

// Replace with your email and SMTP server settings
$subject = "Test email";
$message = "This is a test email sent using jQuery and PHP.";
$headers = "From: phearakph2003@gmail.com";

// Query to retrieve email addresses
$sql = "SELECT Email FROM tblSubscribe";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through results and send email to each address
    while ($row = $result->fetch_assoc()) {
        $to = $row["Email"];
        // Send email
        if (mail($to, $subject, $message, $headers)) {
            echo "Email sent to " . $to . " successfully<br>";
        } else {
            echo "Email delivery to " . $to . " failed<br>";
        }
    }
} else {
    echo "No results found";
}

$conn->close();
