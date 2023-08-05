<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>INFINITY Institute - Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/logo/infinity-logo.png" rel="icon">
    <link href="assets/img/logo/infinity-logo.png" rel="apple-touch-icon">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="assets/css/accordion.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/dashboard-component.css">
    <link rel="stylesheet" href="assets/css/dashboard_uncompress.css">
    <link rel="stylesheet" href="assets/css/loading.css">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
</head>

<body style="font-family: Poppins !important;">
    <?php
    session_start();

    $folder_profile = 'upload/users/profile/';

    if (empty($_SESSION['username'])) {
        header('Location: http://localhost:8080/application%20form/login.php');
    }

    include_once('include/connection.php');
    include_once('include/loading.php');

    $header = '<a href="http://localhost:8080/application%20form/index.php" class="btn w-full text-truncate rounded-0 py-2 border-0 position-relative" style="z-index: 1000; background-color: #0187906c; color: #fff">
                    Go to homepage →
                </a>';
    ?>

    <!-- Contents -->
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <!-- Vertical Navbar -->
        <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
            <div class="container-fluid">
                <!-- Toggler -->
                <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Brand -->
                <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0 d-flex flex-column align-items-center justify-content-center" href="#">
                    <img class="col-6 mb-3" src="assets/img/logo/infinity-logo.png" alt="...">
                    <h3>INFINITY Institute</h3>
                </a>
                <!-- User menu (mobile) -->
                <div class="navbar-user d-lg-none">
                    <!-- Dropdown -->
                    <div class="dropdown">
                        <!-- Toggle -->
                        <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar-parent-child">
                                <img alt="Image Placeholder" src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar- rounded-circle">
                                <span class="avatar-child avatar-badge bg-success"></span>
                            </div>
                        </a>
                        <!-- Menu -->
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarAvatar">
                            <a href="#" class="dropdown-item">Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Billing</a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">Logout</a>
                        </div>
                    </div>
                </div>

                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidebarCollapse">
                    <!-- Navigation -->
                    <ul class="navbar-nav">
                        <?php
                        // Query to select data from tblMarried
                        $sqlMenu = "SELECT tblMenu.* FROM tblMenu 
                                    INNER JOIN tblAccess ON tblMenu.ID = tblAccess.Menu 
                                    INNER JOIN tblRole ON tblAccess.Role = tblRole.ID 
                                    WHERE tblRole.Title = '" . $_SESSION['role'] . "';";

                        // Execute the query
                        $resultMenu = mysqli_query($conn, $sqlMenu);

                        // Count Users
                        $resultUser = mysqli_query($conn, "SELECT COUNT(*) FROM tblUser WHERE Role <> 1;");
                        $rowUser = mysqli_fetch_array($resultUser, MYSQLI_ASSOC);
                        $countUser = $rowUser['COUNT(*)'];

                        // Count Register Request
                        $resultRegister = mysqli_query($conn, "SELECT COUNT(*) FROM tblRegister;");
                        $rowRegister = mysqli_fetch_array($resultRegister, MYSQLI_ASSOC);
                        $countRegister = $rowRegister['COUNT(*)'];

                        // Display the results
                        if (mysqli_num_rows($resultMenu) > 0) {
                            while ($rowMenu = mysqli_fetch_assoc($resultMenu)) {
                                echo '<li class="nav-item">';
                                echo '<a id="' . $rowMenu['Menu_ID'] . '" data-section="' . $rowMenu['Div_ID'] . '" class="nav-link toggle-section-btn" href="#">';
                                echo $rowMenu['Icon'] . ' ' . $rowMenu['Title'];
                                if ($rowMenu['Span'] != '') {
                                    if ($rowMenu['Title'] == 'Users') {
                                        echo $rowMenu['Span'] . $countUser . '</span>';
                                    } else {
                                        echo $rowMenu['Span'] . $countRegister . '</span>';
                                    }
                                }
                                echo '</a>';
                                echo '</li>';
                            }
                        }
                        ?>
                    </ul>

                    <!-- Divider -->
                    <hr class="navbar-divider my-5 opacity-20">

                    <!-- Navigation -->
                    <!-- <ul class="navbar-nav mb-md-4">
                        <li>
                            <div class="nav-link text-xs font-semibold text-uppercase text-muted ls-wide" href="#">
                                New Subscribers
                                <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-4">13</span>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="nav-link d-flex align-items-center">
                                <div class="me-4">
                                    <div class="position-relative d-inline-block text-white">
                                        <img alt="Image Placeholder" src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar rounded-circle">
                                        <span class="position-absolute bottom-2 end-2 transform translate-x-1/2 translate-y-1/2 border-2 border-solid border-current w-3 h-3 bg-success rounded-circle"></span>
                                    </div>
                                </div>
                                <div>
                                    <span class="d-block text-sm font-semibold">
                                        Marie Claire
                                    </span>
                                    <span class="d-block text-xs text-muted font-regular">
                                        Paris, FR
                                    </span>
                                </div>
                                <div class="ms-auto">
                                    <i class="bi bi-chat"></i>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link d-flex align-items-center">
                                <div class="me-4">
                                    <div class="position-relative d-inline-block text-white">
                                        <span class="avatar bg-soft-warning text-warning rounded-circle">JW</span>
                                        <span class="position-absolute bottom-2 end-2 transform translate-x-1/2 translate-y-1/2 border-2 border-solid border-current w-3 h-3 bg-success rounded-circle"></span>
                                    </div>
                                </div>
                                <div>
                                    <span class="d-block text-sm font-semibold">
                                        Michael Jordan
                                    </span>
                                    <span class="d-block text-xs text-muted font-regular">
                                        Bucharest, RO
                                    </span>
                                </div>
                                <div class="ms-auto">
                                    <i class="bi bi-chat"></i>
                                </div>
                            </a>
                        </li>
                    </ul> -->

                    <!-- Push content down -->
                    <div class="mt-auto"></div>
                    <!-- User (md) -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a id="btnProfile" data-section="profile" class="nav-link toggle-section-btn" href="#">
                                <i class="bi bi-person-square"></i> Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="logout">
                                <i class="bi bi-box-arrow-left"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Dashboard -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto section" id="dashboard">
            <!-- Banner -->
            <?php
            echo $header;
            ?>
            <!-- Header -->
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight">Overview</h1>
                            </div>
                            <!-- Actions -->
                            <!-- <div class="col-sm-6 col-12 text-sm-end">
                                <div class="mx-n1">
                                    <a href="#" class="btn d-inline-flex btn-sm btn-neutral border-base mx-1">
                                        <span class=" pe-2">
                                            <i class="bi bi-pencil"></i>
                                        </span>
                                        <span>Edit</span>
                                    </a>
                                    <a href="#" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                        <span class=" pe-2">
                                            <i class="bi bi-plus"></i>
                                        </span>
                                        <span>Create</span>
                                    </a>
                                </div>
                            </div> -->
                        </div>
                        <!-- Nav -->
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">
                            <li class="nav-item ">
                                <a href="#" class="nav-link active">Summary</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    <!-- Card stats -->
                    <div class="row g-6 mb-6">
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <?php
                                            // Query to get number of records in batch 1 and batch 2
                                            $sql = "SELECT Batch, COUNT(*) AS NumRecords FROM tblRegister WHERE Batch IN (1, 2) GROUP BY Batch";
                                            $result = $conn->query($sql);

                                            // Initialize variables to store number of records in each batch
                                            $numRecordsBatch1 = 0;
                                            $numRecordsBatch2 = 0;

                                            // Loop through result of query and store number of records in each batch
                                            while ($row = $result->fetch_assoc()) {
                                                if ($row["Batch"] == 1) {
                                                    $numRecordsBatch1 = $row["NumRecords"];
                                                } else if ($row["Batch"] == 2) {
                                                    $numRecordsBatch2 = $row["NumRecords"];
                                                }
                                            }

                                            // Query to get number of records in current year and 10 years ago
                                            $sql = "SELECT COUNT(*) AS NumRecords FROM tblRegister WHERE YEAR(ReqDate) = YEAR(CURRENT_TIMESTAMP) AND Batch IN (1, 2)
                                                    UNION ALL
                                                    SELECT COUNT(*) AS NumRecords FROM tblRegister WHERE YEAR(ReqDate) = YEAR(CURRENT_TIMESTAMP) - 10 AND Batch IN (1, 2)";
                                            $result = $conn->query($sql);

                                            // Initialize variables to store number of records in current year and 10 years ago
                                            $numRecordsCurrentYear = 0;
                                            $numRecordsTenYearsAgo = 0;

                                            // Loop through result of query and store number of records in each year
                                            $i = 0;
                                            while ($row = $result->fetch_assoc()) {
                                                if ($i == 0) {
                                                    $numRecordsCurrentYear = $row["NumRecords"];
                                                } else if ($i == 1) {
                                                    $numRecordsTenYearsAgo = $row["NumRecords"];
                                                }
                                                $i++;
                                            }

                                            // Calculate percentage difference between number of records in batch 1 and batch 2
                                            $totalStudent = $numRecordsBatch1 + $numRecordsBatch2;
                                            $percentDifference = ($numRecordsBatch2 - $numRecordsBatch1) / $numRecordsBatch1 * 100;
                                            // Calculate percentage difference between number of records in current year and 10 years ago
                                            // $percentDifferenceTenYears = ($numRecordsCurrentYear - $numRecordsTenYearsAgo) / $numRecordsTenYearsAgo * 100;
                                            ?>

                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total Students</span>
                                            <span class="h3 font-bold mb-0"><?php echo $totalStudent; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                                                <i class="fa-solid fa-graduation-cap"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-0 text-sm">
                                        <span class="badge badge-pill bg-soft-danger text-danger me-2">N/A
                                            <?php
                                            /*if ($percentDifference < 0) {
                                                    echo '<span class="badge badge-pill bg-soft-danger text-danger me-2">';
                                                    echo '<i class="bi bi-arrow-down me-1"></i>' . round($percentDifference, 2) . '%';
                                                } else {
                                                    echo '<span class="badge badge-pill bg-soft-success text-success me-2">';
                                                    echo round($percentDifference, 2) . "%";
                                                    echo '<i class="bi bi-arrow-up me-1"></i>';
                                                }
                                                */
                                            ?>
                                        </span>
                                        <span class="text-nowrap text-xs text-muted">Overall</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">New Students</span>
                                            <span class="h3 font-bold mb-0"><?php echo $numRecordsBatch2; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                                <i class="bi bi-people"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-0 text-sm">
                                        <?php
                                        if ($percentDifference < 0) {
                                            echo '<span class="badge badge-pill bg-soft-danger text-danger me-2">';
                                            echo '<i class="bi bi-arrow-down me-1"></i>' . round($percentDifference, 2) . '%';
                                        } else {
                                            echo '<span class="badge badge-pill bg-soft-success text-success me-2">';
                                            echo round($percentDifference, 2) . "%";
                                            echo '<i class="bi bi-arrow-up me-1"></i>';
                                        }
                                        ?>
                                        </span>
                                        <span class="text-nowrap text-xs text-muted">Since last year</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Achievement</span>
                                            <span class="h3 font-bold mb-0">1.400</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-info text-white text-lg rounded-circle">
                                                <i class="bi bi-clock-history"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-0 text-sm">
                                        <span class="badge badge-pill bg-soft-danger text-danger me-2">
                                            <i class="bi bi-arrow-down me-1"></i>-5%
                                        </span>
                                        <span class="text-nowrap text-xs text-muted">Since last 10 year</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Work load</span>
                                            <span class="h3 font-bold mb-0">95%</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-warning text-white text-lg rounded-circle">
                                                <i class="bi bi-minecart-loaded"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-0 text-sm">
                                        <span class="badge badge-pill bg-soft-success text-success me-2">
                                            <i class="bi bi-arrow-up me-1"></i>10%
                                        </span>
                                        <span class="text-nowrap text-xs text-muted">Since last year</span>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <h5 class="mb-0">Applications</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Offer</th>
                                        <th scope="col">Meeting</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img alt="..." src="https://images.unsplash.com/photo-1502823403499-6ccfcf4fb453?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar-sm rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Robert Fox
                                            </a>
                                        </td>
                                        <td>
                                            Feb 15, 2021
                                        </td>
                                        <td>
                                            <img alt="..." src="https://preview.webpixels.io/web/img/other/logos/logo-1.png" class="avatar avatar-xs rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Dribbble
                                            </a>
                                        </td>
                                        <td>
                                            $3.500
                                        </td>
                                        <td>
                                            <span class="badge badge-lg badge-dot">
                                                <i class="bg-success"></i>Scheduled
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-neutral">View</a>
                                            <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img alt="..." src="https://images.unsplash.com/photo-1610271340738-726e199f0258?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar-sm rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Darlene Robertson
                                            </a>
                                        </td>
                                        <td>
                                            Apr 15, 2021
                                        </td>
                                        <td>
                                            <img alt="..." src="https://preview.webpixels.io/web/img/other/logos/logo-2.png" class="avatar avatar-xs rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Netguru
                                            </a>
                                        </td>
                                        <td>
                                            $2.750
                                        </td>
                                        <td>
                                            <span class="badge badge-lg badge-dot">
                                                <i class="bg-warning"></i>Postponed
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-neutral">View</a>
                                            <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img alt="..." src="https://images.unsplash.com/photo-1610878722345-79c5eaf6a48c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar-sm rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Theresa Webb
                                            </a>
                                        </td>
                                        <td>
                                            Mar 20, 2021
                                        </td>
                                        <td>
                                            <img alt="..." src="https://preview.webpixels.io/web/img/other/logos/logo-3.png" class="avatar avatar-xs rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Figma
                                            </a>
                                        </td>
                                        <td>
                                            $4.200
                                        </td>
                                        <td>
                                            <span class="badge badge-lg badge-dot">
                                                <i class="bg-success"></i>Scheduled
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-neutral">View</a>
                                            <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img alt="..." src="https://images.unsplash.com/photo-1612422656768-d5e4ec31fac0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar-sm rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Kristin Watson
                                            </a>
                                        </td>
                                        <td>
                                            Feb 15, 2021
                                        </td>
                                        <td>
                                            <img alt="..." src="https://preview.webpixels.io/web/img/other/logos/logo-4.png" class="avatar avatar-xs rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Mailchimp
                                            </a>
                                        </td>
                                        <td>
                                            $3.500
                                        </td>
                                        <td>
                                            <span class="badge badge-lg badge-dot">
                                                <i class="bg-dark"></i>Not discussed
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-neutral">View</a>
                                            <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img alt="..." src="https://images.unsplash.com/photo-1608976328267-e673d3ec06ce?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar-sm rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Cody Fisher
                                            </a>
                                        </td>
                                        <td>
                                            Apr 10, 2021
                                        </td>
                                        <td>
                                            <img alt="..." src="https://preview.webpixels.io/web/img/other/logos/logo-5.png" class="avatar avatar-xs rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Webpixels
                                            </a>
                                        </td>
                                        <td>
                                            $1.500
                                        </td>
                                        <td>
                                            <span class="badge badge-lg badge-dot">
                                                <i class="bg-danger"></i>Canceled
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-neutral">View</a>
                                            <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img alt="..." src="https://images.unsplash.com/photo-1502823403499-6ccfcf4fb453?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar-sm rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Robert Fox
                                            </a>
                                        </td>
                                        <td>
                                            Feb 15, 2021
                                        </td>
                                        <td>
                                            <img alt="..." src="https://preview.webpixels.io/web/img/other/logos/logo-1.png" class="avatar avatar-xs rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Dribbble
                                            </a>
                                        </td>
                                        <td>
                                            $3.500
                                        </td>
                                        <td>
                                            <span class="badge badge-lg badge-dot">
                                                <i class="bg-success"></i>Scheduled
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-neutral">View</a>
                                            <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img alt="..." src="https://images.unsplash.com/photo-1610271340738-726e199f0258?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar-sm rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Darlene Robertson
                                            </a>
                                        </td>
                                        <td>
                                            Apr 15, 2021
                                        </td>
                                        <td>
                                            <img alt="..." src="https://preview.webpixels.io/web/img/other/logos/logo-2.png" class="avatar avatar-xs rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Netguru
                                            </a>
                                        </td>
                                        <td>
                                            $2.750
                                        </td>
                                        <td>
                                            <span class="badge badge-lg badge-dot">
                                                <i class="bg-warning"></i>Postponed
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-neutral">View</a>
                                            <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img alt="..." src="https://images.unsplash.com/photo-1610878722345-79c5eaf6a48c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar-sm rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Theresa Webb
                                            </a>
                                        </td>
                                        <td>
                                            Mar 20, 2021
                                        </td>
                                        <td>
                                            <img alt="..." src="https://preview.webpixels.io/web/img/other/logos/logo-3.png" class="avatar avatar-xs rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Figma
                                            </a>
                                        </td>
                                        <td>
                                            $4.200
                                        </td>
                                        <td>
                                            <span class="badge badge-lg badge-dot">
                                                <i class="bg-success"></i>Scheduled
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-neutral">View</a>
                                            <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img alt="..." src="https://images.unsplash.com/photo-1612422656768-d5e4ec31fac0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar-sm rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Kristin Watson
                                            </a>
                                        </td>
                                        <td>
                                            Feb 15, 2021
                                        </td>
                                        <td>
                                            <img alt="..." src="https://preview.webpixels.io/web/img/other/logos/logo-4.png" class="avatar avatar-xs rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Mailchimp
                                            </a>
                                        </td>
                                        <td>
                                            $3.500
                                        </td>
                                        <td>
                                            <span class="badge badge-lg badge-dot">
                                                <i class="bg-dark"></i>Not discussed
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-neutral">View</a>
                                            <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img alt="..." src="https://images.unsplash.com/photo-1608976328267-e673d3ec06ce?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar-sm rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Cody Fisher
                                            </a>
                                        </td>
                                        <td>
                                            Apr 10, 2021
                                        </td>
                                        <td>
                                            <img alt="..." src="https://preview.webpixels.io/web/img/other/logos/logo-5.png" class="avatar avatar-xs rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Webpixels
                                            </a>
                                        </td>
                                        <td>
                                            $1.500
                                        </td>
                                        <td>
                                            <span class="badge badge-lg badge-dot">
                                                <i class="bg-danger"></i>Canceled
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-neutral">View</a>
                                            <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer border-0 py-5">
                            <span class="text-muted text-sm">Showing 10 items out of 250 results found</span>
                        </div>
                    </div> -->
                    </div>
            </main>
        </div>

        <!-- Request -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto section" id="request">
            <!-- Brand -->
            <?php echo $header ?>
            <!-- Header -->
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight">Academic Application Request</h1>
                            </div>
                            <!-- Actions -->
                            <div class="col-sm-6 col-12 text-sm-end">
                                <div class="mx-n1">
                                    <div class="d-inline-flex mx-1">
                                        <input type="text" id="search-box" placeholder="Search...">
                                        <div class="dropdown mx-1">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="search-column-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                All columns
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="search-column-dropdown">
                                                <li><a class="dropdown-item" href="#" data-column="all">All columns</a></li>
                                                <li><a class="dropdown-item" href="#" data-column="Ref">Ref</a></li>
                                                <li><a class="dropdown-item" href="#" data-column="Batch">Batch</a></li>
                                                <li><a class="dropdown-item" href="#" data-column="Khmer Name">Khmer Name</a></li>
                                                <li><a class="dropdown-item" href="#" data-column="English Name">English Name</a></li>
                                                <li><a class="dropdown-item" href="#" data-column="Sex">Sex</a></li>
                                                <li><a class="dropdown-item" href="#" data-column="DOB">DOB</a></li>
                                                <li><a class="dropdown-item" href="#" data-column="Email">Email</a></li>
                                                <li><a class="dropdown-item" href="#" data-column="Phone">Phone</a></li>
                                                <li><a class="dropdown-item" href="#" data-column="Level">Level</a></li>
                                                <li><a class="dropdown-item" href="#" data-column="Major">Major</a></li>
                                                <li><a class="dropdown-item" href="#" data-column="Requested Date">Requested Date</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Nav -->
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">
                            <li class="nav-item ">
                                <a href="#" class="nav-link active">All Request</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    <div class="table-responsive">
                        <table id="student-table" class="table table-hover table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Ref</th>
                                    <th scope="col">Batch</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Khmer Name</th>
                                    <th scope="col">English Name</th>
                                    <th scope="col">Sex</th>
                                    <th scope="col">DOB</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Major</th>
                                    <th scope="col">Requested Date</th>
                                    <th scope="col">Status</th>
                                    <!-- <th scope="col">Actions</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sqlReq = "SELECT r.ID, r.Batch, r.Photo, r.Sex, r.DOB, r.Email, r.Tel, r.Ref, r.First_Name_Kh, r.Last_Name_Kh, r.First_Name_En, r.Last_Name_En, s.Title AS Major, l.Title AS Level, sh.Title AS Shift, r.ReqDate, r.Status, pm.Title AS Payment_Method
                        FROM tblRegister r
                        JOIN tblMajor s ON r.Major = s.ID
                        JOIN tblLevel l ON r.Apply_For = l.ID
                        JOIN tblShift sh ON r.Shift = sh.ID
                        JOIN tblPayment pm ON r.Payment_Method = pm.ID ORDER BY ID DESC;";
                                $resultReq = mysqli_query($conn, $sqlReq);
                                $folder_reg = 'upload/register/';
                                if (mysqli_num_rows($resultReq) > 0) {
                                    while ($rowReq = mysqli_fetch_assoc($resultReq)) {
                                        echo '<td data-label="No"><span>' . $rowReq['ID'] . '</span></td>';
                                        echo '<td data-label="Ref"><span>' . $rowReq['Ref'] . '</span></td>';
                                        echo '<td data-label="Batch"><span>' . $rowReq['Batch'] . '</span></td>';
                                        echo '<td data-label="Photo"><img src="' . $folder_reg . $rowReq['Photo'] . '" class="avatar avatar-sm rounded-circle me-2" alt="...">';
                                        echo '<td data-label="Khmer Name"><a class="text-heading font-semibold" href="#">' . $rowReq['First_Name_Kh'] . ' ' . $rowReq['Last_Name_Kh'] . '</a></td>';
                                        echo '<td data-label="English Name"><a class="text-heading font-semibold" href="#">' . $rowReq['First_Name_En'] . ' ' . $rowReq['Last_Name_En'] . '</a></td>';
                                        echo '<td data-label="Sex"><span>' . $rowReq['Sex'] . '</span></td>';
                                        echo '<td data-label="DOB"><span>' . $rowReq['DOB'] . '</span></td>';
                                        echo '<td data-label="Email"><a class="text-current" href="mailto:' . $rowReq['Email'] . '">' . $rowReq['Email'] . '</a></td>';
                                        echo '<td data-label="Phone"><a class="text-current" href="' . $rowReq['Tel'] . '">' . $rowReq['Tel'] . '</a></td>';
                                        echo '<td data-label="Level"><span class="">' . $rowReq['Level'] . '</span></td>';
                                        echo '<td data-label="Major"><a class="text-current" href="#">' . $rowReq['Major'] . '</a></td>';
                                        echo '<td data-label="Requested Date"><span>' . $rowReq['ReqDate'] . '</span></td>';
                                        echo '<td data-label="Status"><span>' . $rowReq['Status'] . '</span></td>';
                                        // echo '<td data-label="Actions" class="text-end">';
                                        // echo '<div class="dropdown">';
                                        // echo '<a class="text-muted" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                        // echo '<i class="bi bi-three-dots-vertical"></i>';
                                        // echo '</a>';
                                        // echo '<div class="dropdown-menu dropdown-menu-end">';
                                        // echo '<a href="#!" class="dropdown-item">Action</a>';
                                        // echo '<a href="#!" class="dropdown-item">Another action</a>';
                                        // echo '<a href="#!" class="dropdown-item">Something else here</a>';
                                        // echo '</div>';
                                        // echo '</div>';
                                        // echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>

        <!-- Site Setting -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto section" id="setting">
            <!-- Brand -->
            <?php echo $header ?>
            <!-- Header -->
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight">Site Setting</h1>
                            </div>
                        </div>
                        <!-- Nav -->
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">
                            <li class="nav-item ">
                                <a href="#" class="nav-link active">All Actions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <div class="site-body">
                <div class="accordion">
                    <div class="accordion-item">
                        <div class="accordion-header active">
                            <h5>Choose Admission Form</h5><span class="accordion-arrow active"></span>
                        </div>
                        <div class="accordion-content" style="display: block;">
                            <?php
                            $sqlForm = "SELECT Form FROM tblFormReg WHERE ID = 1;";

                            // Execute the query
                            $resultForm = mysqli_query($conn, $sqlForm);

                            // Display the results
                            if (mysqli_num_rows($resultForm) > 0) {
                                while ($rowForm = mysqli_fetch_assoc($resultForm)) {
                                    $form = $rowForm['Form'];
                                }
                            }
                            ?>
                            <form action="forms/formstyle.php" id="formReg" name="formReg" class="form-inline" method="post">
                                <div class="form-group mb-3">
                                    <label for="formStyle" class="mr-2">Form Style:</label>
                                    <select class="form-control" name="formStyle" id="formStyle">
                                        <?php
                                        if ($form == 1) {
                                            echo '<option value="1" selected>Multi Steps</option>';
                                            echo '<option value="2">Normal</option>';
                                        } else {
                                            echo '<option value="1">Multi Steps</option>';
                                            echo '<option value="2" selected>Normal</option>';
                                        }
                                        ?>

                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary form-control">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comment -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto section" id="comment">
            <!-- Brand -->
            <?php echo $header ?>
            <!-- Header -->
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight">All Comments</h1>
                            </div>
                        </div>
                        <!-- Nav -->
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">
                            <li class="nav-item ">
                                <a href="#" class="nav-link active">All Request</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <table id="tblComment">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sqlComment = "SELECT * FROM ratings;";
                    $resultComment = mysqli_query($conn, $sqlComment);

                    if (mysqli_num_rows($resultComment) > 0) {
                        while ($rowComment = mysqli_fetch_assoc($resultComment)) {
                            $string = $rowComment["name"];
                            $words = explode(" ", ucwords($string));
                            $first_letters = "";

                            foreach ($words as $word) {
                                $first_letters .= substr($word, 0, 1);
                            }
                            echo '<tr>';
                            echo '<td>' . $rowComment["id"] . '</td>';
                            echo '<td class="profile">';
                            echo '<span class="rounded-circle">' . $first_letters . '</span>' . $rowComment["name"];
                            echo '</td>';
                            echo '<td>' . $rowComment["rating"] . '</td>';
                            echo '<td class="comment">' . $rowComment["comments"] . '</td>';
                            echo '<td>' . $rowComment["created_at"] . '</td>';
                            echo '<td>' . $rowComment["status"] . '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- News Letter -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto section" id="subscribe">
            <!-- Brand -->
            <?php echo $header ?>
            <!-- Header -->
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight">News Letter</h1>
                            </div>
                            <!-- Actions -->
                            <div class="col-sm-6 col-12 text-sm-end">
                                <div class="mx-n1">
                                    <?php
                                    // Query to retrieve email addresses
                                    $sql = "SELECT Email FROM tblSubscribe";

                                    $result = $conn->query($sql);

                                    $emails = array();

                                    if ($result->num_rows > 0) {
                                        // Loop through results and add email addresses to array
                                        while ($row = $result->fetch_assoc()) {
                                            $emails[] = $row["Email"];
                                        }
                                    } else {
                                        echo "No results found";
                                    }
                                    ?>
                                    <a id="sendMail" href="mailto:<?php echo implode(',', $emails); ?>" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                        <span class=" pe-2">
                                            <i class="fa-solid fa-envelope-open-text"></i>
                                        </span>
                                        <span>Send Mail</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Nav -->
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">
                            <li class="nav-item ">
                                <a href="#" class="nav-link active">All Subscribers</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subscribe Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sqlComment = "SELECT * FROM tblSubscribe;";
                    $resultComment = mysqli_query($conn, $sqlComment);

                    if (mysqli_num_rows($resultComment) > 0) {
                        while ($rowComment = mysqli_fetch_assoc($resultComment)) {
                            $string = $rowComment["Name"];
                            $words = explode(" ", ucwords($string));
                            $first_letters = "";

                            foreach ($words as $word) {
                                $first_letters .= substr($word, 0, 1);
                            }
                            echo '<tr>';
                            echo '<td>' . $rowComment["ID"] . '</td>';
                            echo '<td class="profile">';
                            echo '<span class="rounded-circle">' . $first_letters . '</span>' . $rowComment["Name"];
                            echo '</td>';
                            echo '<td>' . $rowComment["Email"] . '</td>';
                            echo '<td>' . $rowComment["Subscribe_Date"] . '</td>';
                            echo '<td>' . $rowComment["Status"] . '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Users -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto section" id="user">
            <!-- Brand -->
            <?php echo $header ?>
            <!-- Header -->
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight">User Account</h1>
                            </div>
                            <!-- Actions -->
                            <div class="col-sm-6 col-12 text-sm-end">
                                <div class="mx-n1">
                                    <button id="btnCreate" type="button" class="btn d-inline-flex btn-sm btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <span class=" pe-2">
                                            <i class="bi bi-plus"></i>
                                        </span>
                                        <span>Add</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Create User -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create User</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form name="createForm" id="createForm" method="POST" enctype="multipart/form-data">
                                            <div class="mb-5 d-flex justify-content-center">
                                                <input class="form-control" type="file" id="createProfile" name="createProfile" accept="image/jpg, image/jpeg, image/png" required />
                                                <label id="createAvatar" for="createProfile" class="form-label"></label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input name="createUsername" type="text" class="form-control shadow-none" id="createUsername" placeholder="Enter Username" required />
                                                <label for="createUsername">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input name="createPassword" type="password" class="form-control shadow-none" id="createPassword" placeholder="Enter Password" required />
                                                <label for="createPassword">Password</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input name="createEmail" type="email" class="form-control shadow-none" id="createEmail" placeholder="Enter Email" required />
                                                <label for="createEmail">Email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select name="createRole" class="form-select shadow-none" id="createRole" aria-label="Floating label select example" required />
                                                <option value="" selected>---</option>
                                                <option value="2">Admin</option>
                                                </select>
                                                <label for="createRole">Role</label>
                                            </div>
                                            <div class="form-floating">
                                                <select name="createStatus" class="form-select shadow-none" id="createStatus" aria-label="Floating label select example" required />
                                                <option value="" selected>---</option>
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                                </select>
                                                <label for="createStatus">Status</label>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" id="btnAddUser" name="btnAddUser" class="btn btn-primary">Create</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Nav -->
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">
                            <li class="nav-item ">
                                <a href="#" class="nav-link active">All User Account</a>
                            </li>
                        </ul>
                    </div>
            </header>
            <div class="table-responsive">
                <table id="tblUsers" class="table table-hover table-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Username</th>
                            <!-- <th class="password" scope="col">Password</th> -->
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($_SESSION['role'] == "Owner") {
                            // Query to select data from tblMarried
                            $sqlGetUser = "CALL getUsers()";

                            // Execute the query
                            $resultGetUser = mysqli_query($conn, $sqlGetUser);

                            // Display the results
                            if (mysqli_num_rows($resultGetUser) > 0) {
                                while ($users = mysqli_fetch_assoc($resultGetUser)) {
                                    $password = str_repeat('*', strlen($users['Password']));
                                    echo '<tr>';
                                    echo '<td data-label="ID">' . $users['ID'] . '</td>';
                                    echo '<td data-label="Username">';
                                    echo '<img alt="..." src="' . $folder_profile . $users['Profile'] . '" class="avatar avatar-sm rounded-circle me-2">';
                                    echo '<a class="text-heading font-semibold" href="#">';
                                    echo $users['Username'];
                                    echo '</a>';
                                    echo '</td>';
                                    // echo '<td data-label="Password">';
                                    // echo '<span>' . $password . '</span>';
                                    // echo '</td>';
                                    echo '<td data-label="Email">';
                                    echo '<a class="text-current" href="mailto:' . $users['Email'] . '">' . $users['Email'] . '</a>';
                                    echo '</td>';
                                    echo '<td data-label="Role">';
                                    echo '<a class="badge bg-opacity-30 bg-success text-success text-current" href="#">' . $users['Role'] . '</a>';
                                    echo '</td>';
                                    echo '<td data-label="Status">';
                                    echo '<a class="text-current" href="#">' . $users['Status'] . '</a>';
                                    echo '</td>';
                                    echo '<td data-label="Actions" class="">';
                                    echo '<a href="#" class="btn btn-sm btn-neutral">Edit</a>';
                                    // echo '<button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">';
                                    // echo '<i class="bi bi-trash"></i>';
                                    // echo '</button>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            }
                        } else {
                            echo "Hello";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Profile -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto section" id="profile">
            <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
                <!-- Main content -->
                <div class="h-screen flex-grow-1 overflow-y-lg-auto">
                    <!-- Brand -->
                    <?php echo $header ?>
                    <!-- Header -->
                    <header class="bg-surface-primary border-bottom pt-6">
                        <div class="container-fluid">
                            <div class="mb-npx">
                                <div class="row align-items-center">
                                    <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                        <!-- Title -->
                                        <h1 class="h2 mb-0 pb-5 ls-tight">Account Settings</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main -->
                    <main class="py-6 bg-surface-secondary">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xl-7 mx-auto">
                                    <!-- Profile picture -->
                                    <div class="card shadow border-0 mt-4 mb-10">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar avatar-lg bg-warning rounded-circle text-white">
                                                        <?php echo '<img alt="..." src="' . $folder_profile . $_SESSION['profile'] . '"/></a>'; ?>
                                                </div>

                                                <div class="ms-4">
                                                    <span class="h4 d-block mb-0"> <?php echo $_SESSION['username']; ?> </span>
                                                    <a href="#" class="text-sm font-semibold text-muted"> <?php echo $_SESSION['role'] ?> </a>
                                                </div>
                                            </div>
                                            <div class="ms-auto">
                                                <button id="btnEdit" type="button" class="btn btn-sm btn-neutral shadow-none">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form -->
                                <div id="editForm" class="col-xl-7 mx-auto">
                                    <div class="row">
                                        <div class="mb-5">
                                            <h5 class="mb-0">Update Profile</h5>
                                        </div>
                                        <form id="updateProForm" class="mb-6" action="" method="post" enctype="multipart/form-data">
                                            <div class="row mb-5">
                                                <div class="col-md-3 mx-auto">
                                                    <div class="">
                                                        <?php echo '<img class="rounded-circle" alt="..." src="' . $folder_profile . $_SESSION['profile'] . '" /></a>' ?>
                                                        <input type="file" id="editProfile" name="editProfile" accept="image/jpg, image/jpeg, image/png">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <label class="form-label" for="username">Username</label>
                                                        <?php echo '<input type="text" class="form-control" id="username" value="' . $_SESSION['username'] . ' " disabled required>' ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <label class="form-label" for="password">Password</label>
                                                        <input type="password" class="form-control" name="password" id="password" value="<?php echo $_SESSION['password'] ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-5">
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <label class="form-label" for="role">Role</label>
                                                        <select class="form-select" id="role" disabled required>
                                                            <option selected><?php echo $_SESSION['role'] ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <label class="form-label" for="status">Status</label>
                                                        <select class="form-select" id="status" disabled required>
                                                            <option selected><?php echo $_SESSION['status'] ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="ckbxConfirm" id="ckbxConfirm" required>
                                                        <label class="form-check-label" for="ckbxConfirm">
                                                            Confirm update
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <button id="btnCancelEdit" type="button" class="btn btn-sm btn-neutral me-2">Cancel</button>
                                                <button id="btnSubmitEdit" type="submit" class="btn btn-sm btn-primary disabled">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                    <hr class="my-2" />
                                    <!-- Individual switch cards -->
                                    <!-- <div class="row g-6">
                                        <div class="col-md-6">
                                            <div class="card shadow border-0">
                                                <div class="card-body">
                                                    <h5 class="mb-2">Public profile</h5>
                                                    <p class="text-sm text-muted mb-6">
                                                        Making your profile public means that anyone on the network will be able to find you.
                                                    </p>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card shadow border-0">
                                                <div class="card-body">
                                                    <h5 class="mb-2">Show my email</h5>
                                                    <p class="text-sm text-muted mb-6">
                                                        Showing your e-mail addresses means that anyone on the network will be able to find you.
                                                    </p>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card shadow border-0">
                                                <div class="card-body d-flex align-items-center">
                                                    <div>
                                                        <h5 class="text-danger mb-2">Deactivate account</h5>
                                                        <p class="text-sm text-muted">
                                                            Once you delete your account, there is no going back. Please be certain.
                                                        </p>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <button type="button" class="btn btn-sm btn-danger">Deactivate</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>

        <!-- JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/302987efd2.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>


        <script src="include/loading.php"></script>
        <script src="assets/js/accordion.js"></script>
        <script src="assets/js/dashboard.js"></script>
        <script>
            /*
             * Preloader
             */
            let preloader = $("#preloader");
            if (preloader.length) {
                $(window).on("load", () => {
                    preloader.remove();
                });
            }

            $(document).ready(function() {
                $('#search-box').on('keyup', function() {
                    var searchTerm = $(this).val();
                    var searchColumn = $('#search-column-dropdown').data('column');
                    searchTable(searchTerm, searchColumn);
                });

                $('.dropdown-menu a').on('click', function(e) {
                    e.preventDefault();
                    var selectedColumn = $(this).data('column');
                    $('#search-column-dropdown').text(selectedColumn);
                    $('#search-column-dropdown').data('column', selectedColumn);
                    var searchTerm = $('#search-box').val();
                    searchTable(searchTerm, selectedColumn);
                });

                function searchTable(searchTerm, searchColumn) {
                    $('tbody tr').show();
                    if (searchTerm.length > 0) {
                        $('tbody tr').filter(function() {
                            var text = $(this).find('td[data-label="' + searchColumn + '"]').text().toLowerCase();
                            return !text.includes(searchTerm.toLowerCase());
                        }).hide();
                    }
                };

                $('#btnCancelEdit').on('click', function() {
                    $('#editProfile').val('');
                    $('#editAvatar').text('');
                    $('#password').val('');
                    $('#btnSubmitEdit').addClass('disabled');
                })

                $("#btnProfile").on('click', function() {
                    $(".section").hide();
                    $("#profile").show();
                    $('#btnEdit').text("Edit");
                    $("#editForm").hide();
                })

                $('#btnEdit').click(function() {
                    var text = $(this).text();
                    if (text == "Edit") {
                        $(this).text("Cancel");
                        $("#editForm").show();
                    } else {
                        $(this).text("Edit");
                        $("#editForm").hide();
                    }
                })

                $("#btnCancelEdit").on('click', function() {
                    $('#btnEdit').text("Edit");
                    $("#editForm").hide();
                })

                $('#ckbxConfirm').change(function() {
                    if ($(this).is(":checked")) {
                        $('#btnSubmitEdit').removeClass('disabled');
                    } else {
                        $('#btnSubmitEdit').addClass('disabled');
                    }
                })

                $("#logout").on('click', function(e) {
                    e.preventDefault();

                    // Use SweetAlert2 to ask for confirmation
                    Swal.fire({
                        title: 'Are you sure you want to log out?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, log out',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "forms/logout.php",
                                method: "POST",
                                success: function(response) {
                                    window.location.href = "login.php";
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log(textStatus, errorThrown);
                                }
                            });
                        }
                    });
                });

                $(".section:not(#dashboard)").hide();

                $(".toggle-section-btn").on('click', function() {
                    var sectionId = $(this).attr("data-section");
                    $(".section").hide();
                    console.log("#" + sectionId);
                    $("#" + sectionId).show();
                });

                $("#createProfile").change(function() {
                    if (this.files && this.files[0]) {
                        console.log(this.files[0]['name']);
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $("#createAvatar").css("background-image", "url(" + e.target.result + ")");
                        };
                        reader.readAsDataURL(this.files[0]);
                    }
                });

                $('#createForm').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        url: 'forms/add-user.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            var response = JSON.parse(data); // Parse the JSON response
                            if (response.status == 'Success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'User account has been created'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message
                                })
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Error: ' + textStatus + ' - ' + errorThrown,
                                footer: '<a href="">Why do I have this issue?</a>'
                            })
                        }
                    });
                });

                $('#updateProForm').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        url: 'forms/update-profile.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            // alert(data);
                            location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error: ' + textStatus + ' - ' + errorThrown);
                        }
                    });
                });

                $('#student-table, #tblUsers').DataTable({
                    paging: true,
                    searching: false
                });

                $('#editProfile').on('change', function() {
                    var fileName = $(this).val().split('\\').pop();
                    $('#editAvatar').text(fileName);
                })

                $('#password').on('change', function() {
                    $('#btnSubmitEdit').removeClass('disabled');
                })

                $('#student-table tbody').on('click', 'tr', function() {
                    var currentRow = $(this).closest("tr");
                    var studentId = currentRow.find("td:eq(0)").text().trim();
                    var ref = currentRow.find("td:eq(1)").text().trim();
                    Swal.fire({
                        icon: 'info',
                        title: 'Success',
                        html: 'What is your decision for this request?<br><b>ID: ' + studentId + ' Ref: ' + ref + "</b>",
                        showCancelButton: true,
                        cancelButtonText: 'Reject',
                        confirmButtonText: 'Approve',
                        allowOutsideClick: false,
                        allowEscapeKey: true
                    }).then((result) => {
                        let status = '';
                        if (result.isConfirmed) {
                            status = 'Approved';
                        } else {
                            status = 'Rejected';
                        }
                        $.ajax({
                            url: 'forms/update_request_status.php',
                            type: 'POST',
                            data: {
                                request_id: studentId,
                                status: status
                            },
                            success: function(response) {
                                // Reload page after updating request status
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                // Handle error response from server
                                console.error(error);
                            }
                        });
                    });
                });
            })
        </script>
</body>

</html>