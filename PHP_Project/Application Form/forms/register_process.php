<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Response</title>
    <style>
        @font-face {
            font-family: Poppins;
            src: url(assets/fonts/Poppins.ttf);
        }

        @font-face {
            font-family: Krasar;
            src: url(assets/fonts/Krasar.ttf);
        }

        :root {
            --primary-op: #0187906c;
            --primary: #018690;
            --dark: #006b73;
            --white: #fff;
            --gold: rgb(255, 217, 0);
        }

        * {
            font-family: Poppins;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            box-sizing: border-box;
        }

        .qr-container {
            text-align: center;
            border-radius: 10px;
            padding: 40px;
            background-color: #fff;
            box-shadow: 0 0 5px 1px #000;
        }

        .qr-container img {
            border: 2px solid #000;
            padding: 15px;
            border-radius: 10px;
        }

        h1 {
            font-size: 1.5rem;
        }
    </style>

    <script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    include_once('../include/connection.php');

    // Select the Batch column from the tblExpired table for the current year
    $sqlBatch = "SELECT Batch FROM tblExpired WHERE Year = YEAR(NOW())";

    // Execute the query
    $resultBatch = mysqli_query($conn, $sqlBatch);

    // Check if the query was successful
    if (!$resultBatch) {
        die('Error: ' . mysqli_error($conn));
    }

    // Fetch the result and store it in the $batch variable
    $rowBatch = mysqli_fetch_assoc($resultBatch);
    $batch = $rowBatch['Batch'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $folder = '../upload/register/';

        // Retrieve the values submitted by the form
        $photo = $_FILES['imageUpload']['name'];
        $photo_temp = $_FILES['imageUpload']['tmp_name'];

        $fname_kh = $_POST['fname_kh'];
        $lname_kh = $_POST['lname_kh'];
        $fname_en = $_POST['fname_en'];
        $lname_en = $_POST['lname_en'];
        $gender = $_POST['gender'];

        $tel = $_POST['tel'];
        $email = $_POST['email'];

        $marital_status = $_POST['marital_status'];
        $birthday = $_POST['birthday'];
        $nationality = $_POST['nationality'];
        $village = $_POST['village'];
        $commune = $_POST['commune'];
        $district = $_POST['district'];
        $province = $_POST['province'];
        $village_cur = $_POST['village_cur'];
        $commune_cur = $_POST['commune_cur'];
        $district_cur = $_POST['district_cur'];
        $province_cur = $_POST['province_cur'];

        $father_name = $_POST['father_name'];
        $father_tel = $_POST['father_tel'];
        $mother_name = $_POST['mother_name'];
        $mother_tel = $_POST['mother_tel'];
        $name_emer = $_POST['name_emer'];
        $relationship_emer = $_POST['relationship_emer'];
        $tel_emer = $_POST['tel_emer'];

        $level = $_POST['level'];
        $major = $_POST['major'];
        $shift = $_POST['shift'];
        $payment = $_POST['payment'];

        $diploma = $_FILES['diploma']['name'];
        $diploma_temp = $_FILES['diploma']['tmp_name'];

        $student_id = $_FILES['student_id']['name'];
        $student_id_temp = $_FILES['student_id']['tmp_name'];

        $kh_id = $_FILES['kh_id']['name'];
        $kh_id_temp = $_FILES['kh_id']['tmp_name'];

        // Check if the Full Name (English Name), Sex, DOB, Father Name, Mother Name, Place of Birth already exist in the database
        $existingRecords = mysqli_query($conn, "SELECT * FROM tblRegister WHERE First_Name_En='$fname_en' AND Last_Name_En='$lname_en' AND Sex='$gender' AND DOB='$birthday' AND Father_Name='$father_name' AND Mother_Name='$mother_name' AND Village_POB='$village' AND Commune_POB='$commune' AND District_POB='$district' AND Province_POB='$province'");

        if (mysqli_num_rows($existingRecords) > 0) {
            // Generate the necessary values for the SweetAlert message
            $icon = 'error';
            $title = 'Oops... Process Declined';
            $text = 'A record with the same Full Name (English Name), Sex, DOB, Father Name, Mother Name, and Place of Birth already exists in the database.';
            $buttonConfirmText = 'Home';
            $footer = '<a href="https://t.me/phearak2003" target="_blank">Why do I have this issue?</a>';

            // Embed the values in a JavaScript function call
            echo '<script>Swal.fire({
        icon: \'' . $icon . '\',
        title: \'' . $title . '\',
        text: \'' . $text . '\',
        confirmButtonText: \'' . $buttonConfirmText . '\',
        footer: \'' . $footer . '\'
    }).then((result) => {
        if (result.isConfirmed) {
            location.reload();
        }
    })</script>';
        } else {
            $dt = new DateTime();
            $dateFormat = $dt->format('YmdHisv');
            if ($level == 1) {
                $ref = 'ABA-' . $dateFormat;
            } else if ($level == 2) {
                $ref = 'BBA-' . $dateFormat;
            } else {
                $ref = 'MAS-' . $dateFormat;
            };

            $sql = "INSERT INTO tblRegister (Batch, Ref, Photo, First_Name_Kh, Last_Name_Kh, First_Name_En, Last_Name_En, Sex, Village_POB, Commune_POB, District_POB, Province_POB, DOB, Village_Current, Commune_Current, District_Current, Province_Current, Nationality, Father_Name, Father_Tel, Mother_Name, Mother_Tel, Marital_Status, Emergency_Contact_Name, Emergency_Contact_Relation, Emergency_Contact_Tel, Apply_For, Major, Shift, Tel, Email, Payment_Method, Diploma_Certificate, Student_ID_File, Khmer_ID_File)
                VALUES ($batch, '$ref', '$photo', '$fname_kh', '$lname_kh', '$fname_en', '$lname_en', '$gender', '$village', '$commune', '$district', '$province', '$birthday', '$village_cur', '$commune_cur', '$district_cur', '$province_cur', '$nationality', '$father_name', '$father_tel', '$mother_name', '$mother_tel', '$marital_status', '$name_emer', '$relationship_emer', '$tel_emer', '$level', '$major', '$shift', '$tel', '$email', '$payment', '$diploma', '$student_id', '$kh_id')";

            if (mysqli_query($conn, $sql)) {
                if (mysqli_affected_rows($conn) > 0) {
                    move_uploaded_file($photo_temp, $folder . $photo);
                    move_uploaded_file($diploma_temp, $folder . $diploma);
                    move_uploaded_file($student_id, $folder . $student_id);
                    move_uploaded_file($kh_id_temp, $folder . $kh_id);
                    echo '<div class="qr-container">';
                    echo '<img id="qr-code" src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=http://192.168.0.184:8080/application%20form/admission_search.php?search=' . $ref . '" alt="QR code">';
                    echo '<h1>' . $ref . ' </h1>';
                    echo '<button id="download-btn">Download QR code</button>';
                    echo '</div>';
                    echo '<p style="font-size: 1.2rem; text-align: center;">Please note the Ref number or Screenshot this page to find your admission application.</p>';
                    echo '<a href="../index.php">Home Page</a>';
                    echo '<a href="../admission_search.php?search=' . $ref . '">My admission process</a>';
                } else {
                    echo 'The query was executed but no rows were affected';
                }
            } else {
                echo 'Error executing the query: ' . mysqli_error($conn);
            }
        }
    }
    mysqli_close($conn);
    ?>
</body>

<!-- // Import the html2canvas library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Add a click event listener to the download button
        $('#download-btn').on('click', function() {
            // Get the QR code image element by its ID
            var qrCode = $('#qr-code').get(0);

            // Capture the image using html2canvas
            html2canvas(qrCode).then(function(canvas) {
                // Convert the canvas data to a data URL
                var dataUrl = canvas.toDataURL('image/png');

                // Create a download link
                var downloadLink = $('<a></a>').attr({
                    href: dataUrl,
                    download: 'qr-code.png'
                });

                // Click the download link to trigger the download
                downloadLink.get(0).click();
            });
        });
    })
</script>

</html>