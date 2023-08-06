<?php
include_once('../include/connection.php');

if (isset($_GET['search'])) {
    $search = $_GET['search'];

    // Validate and sanitize the search query
    $search = filter_var($search, FILTER_SANITIZE_STRING);

    // Use prepared statements to prevent SQL injection attacks
    $stmt = $conn->prepare("SELECT r.ID, r.Batch, r.Ref, r.Photo, r.First_Name_Kh, r.Last_Name_Kh,
                            r.First_Name_En, r.Last_Name_En, s.Title AS Sex, m.Title AS Marital_Status, r.Village_POB, r.Commune_POB,
                            r.District_POB, r.Province_POB, r.DOB, r.Village_Current, r.Commune_Current,
                            r.District_Current, r.Province_Current, r.Nationality, r.Father_Name,
                            r.Father_Tel, r.Mother_Name, r.Mother_Tel, r.Emergency_Contact_Name, rel.Title AS Emergency_Contact_Relation,
                            r.Emergency_Contact_Tel, r.Tel, r.Email,
                            r.Diploma_Certificate, r.Student_ID_File, r.Khmer_ID_File, r.ReqDate, r.Status, r.dBy, r.dDate, r.Reason, 
                            l.Title AS Level, ma.Title AS Major, sh.Title AS Shift, p.Title AS Payment_Method
                        FROM tblRegister r
                        JOIN tblSex s ON r.Sex = s.ID
                        JOIN tblMarried m ON r.Marital_Status = m.ID
                        JOIN tblRelationship rel ON r.Emergency_Contact_Relation = rel.ID
                        JOIN tblLevel l ON r.Apply_For = l.ID
                        JOIN tblMajor ma ON r.Major = ma.ID
                        JOIN tblShift sh ON r.Shift = sh.ID
                        JOIN tblPayment p ON r.Payment_Method = p.ID WHERE Ref = ?;");

    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Output data as JSON
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        // Output error message as JSON
        $error = array("message" => "No results found");
        echo json_encode($error);
    }
} else {
    // Output error message as JSON
    $error = array("message" => "Invalid request method");
    echo json_encode($error);
}
