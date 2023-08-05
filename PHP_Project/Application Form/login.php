<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="shortcut icon" href="assets/img/logo/infinity-logo.png" type="image/x-icon">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/302987efd2.js" crossorigin="anonymous"></script>

    <!-- Style -->
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <?php
    // Start the session
    session_start();

    include_once('include/loading.php');

    // include database connection file
    include_once('include/connection.php');

    if (isset($_SESSION["username"]) != "" and isset($_SESSION['password']) != "") {
        header('location: http://localhost:8080/application%20form/dashboard.php');
    }
    ?>

    <!-- Background Effect -->
    <canvas id="neonSmoke"></canvas>

    <!-- Container -->
    <div class="login-container position-relative w-75">
        <div class="banner">
            <img class="img-fluid" src="https://img.freepik.com/premium-vector/business-data-analysis-management-tools-intelligence-enterprise-strategy-development-datadriven_566886-1952.jpg" data-tilt data-tilt-scale="1.1" alt="">
        </div>
        <div class="forms text-center">
            <h2 class="fw-bolder mb-5">INFINITY Institute</h2>
            <div class="container w-75">
                <form action="#" method="POST">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required />
                            <label for="username">Username</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required />
                            <label for="password">Password</label>
                        </div>
                        <button type="submit" id="btnSubmit" class="btn p-3 form-control mt-4" type="button">Login</button>
                    </div>
                </form>
                <div class="footer text-center mt-3">
                    <a class="text-decoration-none" href="https://t.me/phearak2003" target="_blank" onclick="window.open('https://t.me/phearak2003','Pho Phearak','width=600,height=400')"><small>Contact Admin</small></a>
                </div>
            </div>
        </div>
        <div class="copyright position-absolute bottom-0 start-50 mb-4 text-muted translate-middle">
            <p class="m-0"><small>©Copyright <?php $year = date("Y");
                                                echo $year; ?> INFINITY Institute</small></p>
        </div>
    </div>

    <?php
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // escape user input to prevent SQL injection attacks
        $txtUsername = mysqli_real_escape_string($conn, $_POST['username']);
        $txtPassword = mysqli_real_escape_string($conn, $_POST['password']);

        // Query to select data from tblUser
        $sqlLogin = "SELECT tblUser.ID, tblUser.Username, tblUser.Password, tblUser.Email, tblRole.Title AS Role, tblStatus.Title AS Status, tblUser.Profile 
            FROM tblUser
            INNER JOIN tblRole ON tblUser.Role = tblRole.ID
            INNER JOIN tblStatus ON tblUser.Status = tblStatus.ID
            WHERE tblUser.Username = '$txtUsername'";
        $resultLogin = mysqli_query($conn, $sqlLogin);
        // print_r($sqlLogin); die();

        // Get user account
        $row = mysqli_fetch_assoc($resultLogin);
        if ($row) {
            $id = $row['ID'];
            $username = $row['Username'];
            $hashedPassword = $row['Password'];
            $email = $row['Email'];
            $role = $row['Role'];
            $status = $row['Status'];
            $profile = $row['Profile'];

            // Check if the account is blocked
            if ($status == 'Inactive') {
                echo '<script>Swal.fire({title: \'Message\', text: \'Account Blocked\', icon: \'error\'})</script>';
                return;
            }

            // Validate to Login
            if (password_verify($txtPassword, $hashedPassword)) {
                // If account not blocked
                $_SESSION['userID'] = $id;
                $_SESSION["username"] = $txtUsername;
                $_SESSION['password'] = $hashedPassword;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $role;
                $_SESSION['status'] = $status;
                $_SESSION['profile'] = $profile;
                header('Location: dashboard.php');
            } else {
                $message = 'Invalid username or password.';
                if (password_verify($txtPassword, $hashedPassword)) {
                    $message .= ' Password matched.';
                } else {
                    $message .= ' Password did not match.';
                }
                echo '<script>Swal.fire({title: \'Message\', text: \'' . $message . '\', icon: \'error\'})</script>';
            }
        } else {
            echo '<script>Swal.fire({title: \'Message\', text: \'Invalid username or password.\', icon: \'error\'})</script>';
        }
    }
    ?>

    <!-- Vanilla JS -->
    <script type="text/javascript" src="assets/js/vanilla-tilt.js"></script>

    <!-- Script -->
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="assets/js/balls.js"></script>
</body>

</html>