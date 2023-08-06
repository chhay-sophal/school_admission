<?php
include_once('include/connection.php');
include_once('include/loading.php');
session_start();
// Query to select data from tblMarried
$sql = "SELECT * FROM tblContact WHERE ID = 1;";

// Execute the query
$result = mysqli_query($conn, $sql);

// Display the results
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['Name'];
        $logo = $row['Icon'];
    }
}

$sqlForm = "SELECT Form FROM tblFormReg WHERE ID = 1;";

// Execute the query
$resultForm = mysqli_query($conn, $sqlForm);

// Display the results
if (mysqli_num_rows($resultForm) > 0) {
    while ($rowForm = mysqli_fetch_assoc($resultForm)) {
        $form = $rowForm['Form'];
    }
}
if ($form == 1) {
    $linkRegister = 'register-multi.php';
} else {
    $linkRegister = 'register.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo $name ?> - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <?php
    echo '<link href="assets/img/logo/' . $logo . '" rel="icon">';
    echo '<link href="assets/img/logo/' . $logo . '" rel="apple-touch-icon">';
    ?>

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/loading.css">

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center">

            <!-- <h1 class="logo me-auto"><a href="index.php"><?php echo $name ?></a></h1> -->
            <a href="index.php" class="logo me-auto"><img src="assets/img//logo/infinity-logo.png" alt="" class="img-fluid"></a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#startPage">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#scholarship">Scholarship</a></li>
                    <li><a class="nav-link scrollto" href="#department">Department</a></li>
                    <li><a class="nav-link   scrollto" href="#event">Events</a></li>
                    <li><a class="nav-link scrollto" href="#professor">Professor</a></li>
                    <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="#">Drop Down 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Drop Down 2</a></li>
                            <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li>
                        </ul>
                    </li> -->
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <li><a class="nav-link scrollto" href="http://localhost:8080/application%20form/admission_search.php" target="_blank" title="Search Admission">Search</a></li>
                    <li><a class="nav-link scrollto" href="http://localhost:8080/application%20form/dashboard.php" target="_blank">Login</a></li>
                    <li><?php echo '<a class="getstarted scrollto" href="' . $linkRegister . '">Register <i class="fa-solid fa-arrow-up-right-from-square"></i></a>'; ?></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Start Section ======= -->
    <section id="startPage" class="d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                    <h1>Nursery of ideas,<br>knowledge and skills </h1>
                    <h5>Create, Discover, Develop and Bright the World WITH US</h5>

                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="<?php echo $linkRegister; ?>" target="_blank" class="btn-get-started scrollto">Register Now <i class="fa-sharp fa-solid fa-arrow-right"></i></a>
                        <a href="https://youtu.be/7IL8EuPNCoE" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Our Achievement</span></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img mt-5" data-aos="zoom-in" data-aos-delay="200">
                    <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>
    </section><!-- End Start -->

    <main id="main">
        <!-- ======= Countdown Section ======= -->
        <section id="countdown" class="countdown">
            <div class="container" data-aos="zoom-in">

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="registerDate">
                            <?php
                            // Query to select data from tblMarried
                            $sql = "SELECT * FROM tblExpired WHERE Year = YEAR(NOW())";

                            // Execute the query
                            $result = mysqli_query($conn, $sql);

                            // Display the results
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $expiredDate = $row['ExpiredDate'];
                                    $startClass = $row['StartClass'];

                                    echo '<p>Academic ' . $row['Year'] . ' deadline on  <b>' . date("F d, Y", strtotime($expiredDate)) . '</b></p>';
                                    echo '<p>Start class on <b>' . date("F d, Y", strtotime($startClass)) . '</b></p>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4 text-center col-sm-12 d-flex flex-row justify-content-between">
                        <div class="countdown-item col-3">
                            <div id="days" class="countdown-value"></div>
                        </div>
                        <div class="countdown-item col-3">
                            <div id="hours" class="countdown-value"></div>
                        </div>
                        <div class="countdown-item col-3">
                            <div id="minutes" class="countdown-value"></div>
                        </div>
                        <div class="countdown-item col-3">
                            <div id="seconds" class="countdown-value"></div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12 d-flex flex-row justify-content-center align-items-center mt-sm-3">
                        <?php echo '<a href="' . $linkRegister . '" target="_blank">'; ?>
                        <button class="btn btn-hover form-control">Register</button>
                        </a>
                    </div>
                </div>
            </div>
            <!-- WAVE -->
            <div class="ocean">
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
            </div>
        </section><!-- End Countdown Section -->

        <!-- ======= Partnership Section ======= -->
        <section id="partnership" class="partnership section-bg">
            <div class="container">

                <div class="row" data-aos="zoom-in">
                    <div class="section-title">
                        <h2>OUR PARTNERSHIP</h2>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-4">
                        <img src="assets/img/logo/Artboard 1.png" class="" alt="" />
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-4">
                        <img src="assets/img/logo/Artboard 2.png" class="" alt="" />
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-4">
                        <img src="assets/img/logo/Artboard 3.png" class="" alt="" />
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-4">
                        <img src="assets/img/logo/Artboard 4.png" class="" alt="" />
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-4">
                        <img src="assets/img/logo/Artboard 5.png" class="" alt="" />
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-4">
                        <img src="assets/img/logo/Artboard 6.png" class="" alt="" />
                    </div>

                </div>

            </div>
        </section><!-- End Clients Section -->

        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>About Us</h2>
                </div>

                <div class="row content">
                    <div class="col-lg-6">
                        <ul>
                            <li><i class="ri-check-double-line"></i><b>Vision:</b> A Leading Science and Technology University in Southeast Asia with Excellent education, Cutting Edge research, and a commitment to green development and a multicultural community.</li>
                            <li><i class="ri-check-double-line"></i><b>Mission:</b> Provide life-changing academic and career opportunities for all students, regardless of their family socio-economic backgrounds;
                                Foster innovation, creativity and team spirit among students;
                                Establish a diverse and multicultural community conducive to studying, living and working
                                Produce young leaders with a local and global understanding and respect;
                                Serve national and regional needs for a digital workforce with the fast-changing context of digital transformation and Industry 4.0.</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0">
                        <p>
                            The <b><?php echo $name ?></b> is a national research university of Cambodia, located in the Phnom Penh capital. Established in 1960, it is the country's largest university. It hosts around 20,000 students in undergraduate and postgraduate programmes.
                        </p>
                        <h5><b>Motto: </b>Nursery of ideas, knowledge and skills</h5>
                        <p></p>
                        <a href="#" class="btn-learn-more">Learn More</a>
                    </div>
                </div>

            </div>
        </section><!-- End About Us Section -->

        <!-- ======= Scholarship Section ======= -->
        <section id="scholarship" class="why-us section-bg">
            <div class="container-fluid" data-aos="fade-up">

                <div class="row">

                    <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                        <div class="content">
                            <h3>Scholarship</strong></h3>
                            <p>Benefits of scholarship: 100% scholarship covering all tuition fees, Job opportunity once graduation, Exchange department (locally and internationally).</p>
                        </div>

                        <div class="accordion-list">
                            <ul>
                                <li>
                                    <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"><span>STEP 1</span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                                        <p>Complete the <a class="d-inline m-0 p-0" href="<?php echo $linkRegister; ?>" target="_blank">Registration</a> Process</p>
                                    </div>
                                </li>

                                <li>
                                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed"><span>STEP 2</span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                                        <p>
                                            Submit all required documents
                                        </p>
                                    </div>
                                </li>

                                <li>
                                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>STEP 3</span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                                        <p>
                                            Wait for our decision (Vai Email or Phone)
                                        </p>
                                    </div>
                                </li>

                            </ul>
                        </div>

                    </div>

                    <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("assets/img/scholarship.png");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
                </div>

            </div>
        </section><!-- End Scholarship Section -->

        <!-- ======= Department Section ======= -->
        <section id="department" class="department section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Department</h2>
                    <p>University departments are academic units within a university that focus on a specific field of study. They offer courses, conduct research, and provide resources for students and faculty in their respective fields.</p>
                </div>

                <div class="row">
                    <?php
                    $sqlJoin = "SELECT tblMajor.ID, tblMajor.Title AS Major, tblMajor.Description, tblDepartment.Title AS Department, tblDepartment.Icon
                    FROM tblDepartment
                    JOIN tblMajor ON tblMajor.Department = tblDepartment.ID";
                    $resultsqlJoin = mysqli_query($conn, $sqlJoin);

                    $majorsByDepartment = array();
                    while ($row = mysqli_fetch_assoc($resultsqlJoin)) {
                        $department = $row['Department'];
                        if (!isset($majorsByDepartment[$department])) {
                            $majorsByDepartment[$department] = array();
                        }
                        $majorsByDepartment[$department][] = $row;
                    }

                    $sqlDepartment = "SELECT * FROM tblDepartment";
                    $resultDepartment = mysqli_query($conn, $sqlDepartment);

                    if (mysqli_num_rows($resultDepartment) > 0) {
                        while ($rowDepartment = mysqli_fetch_assoc($resultDepartment)) {
                            $department = $rowDepartment['Title'];
                            $icon = $rowDepartment['Icon'];
                            $majors = isset($majorsByDepartment[$department]) ? $majorsByDepartment[$department] : array();

                            echo '<div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">';
                            echo '<div class="icon-box">';
                            echo '<div class="icon">' . $icon . '</div>';
                            echo '<h4><a href="">' . $department . '</a></h4>';
                            echo '<ol class="p-0">';
                            foreach ($majors as $major) {
                                echo '<li>';
                                echo '<p><b>' . $major['Major'] . ':</b> ' . $major['Description'] . '</p>';
                                echo '</li>';
                            }
                            echo '</ol>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>

            </div>
        </section><!-- End Department Section -->

        <!-- ======= Event Section ======= -->
        <section id="event" class="portfolio">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Upcoming Events</h2>
                    <p>The <?php echo $name ?> is a busy place - every day offers new opportunities to explore, experience and learn about what makes U of T special. Here are just some of the upcoming events happening across our community.</p>
                </div>

                <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active">All</li>
                    <li data-filter=".filter-newyear">NYE</li>
                    <li data-filter=".filter-sangkranta">KNY</li>
                    <li data-filter=".filter-anniversary">Anniverssary</li>
                    <li data-filter=".filter-christmas">Christmas</li>
                </ul>

                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-lg-4 col-md-6 portfolio-item filter-newyear">
                        <div class="portfolio-img"><img src="assets/img/event/new_year_2.jpg" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                            <h4>New Year's Eve</h4>
                            <p>2023</p>
                            <a href="assets/img/event/new_year_2.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 2"><i class="bx bx-plus"></i></a>
                            <a href="inner-page.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-christmas">
                        <div class="portfolio-img"><img src="assets/img/event/christmas_2.jpg" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                            <h4>Christmas</h4>
                            <p>Time to give</p>
                            <a href="assets/img/portfolio/christmas_2.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
                            <a href="inner-page.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-newyear">
                        <div class="portfolio-img"><img src="assets/img/event/new_year_1.jpg" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                            <h4>New Year's Eve</h4>
                            <p>2023</p>
                            <a href="assets/img/portfolio/new_year_1.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
                            <a href="inner-page.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-sangkranta">
                        <div class="portfolio-img"><img src="assets/img/event/khmer_new_year_1.jpg" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                            <h4>Khmer New Year</h4>
                            <p>Sangkranta</p>
                            <a href="assets/img/portfolio/khmer_new_year_1.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>
                            <a href="inner-page.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-anniversary">
                        <div class="portfolio-img"><img src="assets/img/event/anniversary.jpg" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                            <h4>School Anniversary</h4>
                            <p>63<sup>th</sup></p>
                            <a href="assets/img/portfolio/anniversary.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
                            <a href="inner-page.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-christmas">
                        <div class="portfolio-img"><img src="assets/img/event/christmas_1.jpg" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                            <h4>Christmas</h4>
                            <p>Time to give</p>
                            <a href="assets/img/portfolio/christmas_1.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
                            <a href="inner-page.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-sangkranta">
                        <div class="portfolio-img"><img src="assets/img/event/khmer_new_year_3.jpg" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                            <h4>Khmer New Year</h4>
                            <p>Sangkranta</p>
                            <a href="assets/img/portfolio/khmer_new_year_3.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
                            <a href="inner-page.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-christmas">
                        <div class="portfolio-img"><img src="assets/img/event/christmas_3.jpg" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                            <h4>Christmas</h4>
                            <p>Time to give</p>
                            <a href="assets/img/portfolio/christmas_3.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
                            <a href="inner-page.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-newyear">
                        <div class="portfolio-img"><img src="assets/img/event/new_year_3.jpg" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                            <h4>New Year's Eve</h4>
                            <p>2023</p>
                            <a href="assets/img/portfolio/new_year.jpeg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
                            <a href="inner-page.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </section><!-- End Event Section -->

        <!-- ======= Professor Section ======= -->
        <section id="professor" class="team section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Professor</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="row">

                    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="professor d-flex align-items-start">
                            <div class="pic"><img src="assets/img/Mathin-Jazz.png" class="img-fluid" alt=""></div>
                            <div class="professor-info">
                                <h4>Mathew Jazz</h4>
                                <span>Ph.D. in Computer Science and Engineering</span>
                                <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
                                <div class="social">
                                    <a href="#"><i class="ri-twitter-fill"></i></a>
                                    <a href="#"><i class="ri-facebook-fill"></i></a>
                                    <a href="#"><i class="ri-instagram-fill"></i></a>
                                    <a href="#"> <i class="ri-linkedin-box-fill"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="200">
                        <div class="professor d-flex align-items-start">
                            <div class="pic"><img src="assets/img/Guo_Lei.jpg" class="img-fluid" alt=""></div>
                            <div class="professor-info">
                                <h4>Guo Lei</h4>
                                <span>Expertist of Finance</span>
                                <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                                <div class="social">
                                    <a href="#"><i class="ri-twitter-fill"></i></a>
                                    <a href="#"><i class="ri-facebook-fill"></i></a>
                                    <a href="#"><i class="ri-instagram-fill"></i></a>
                                    <a href="#"> <i class="ri-linkedin-box-fill"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mt-4" data-aos="zoom-in" data-aos-delay="300">
                        <div class="professor d-flex align-items-start">
                            <div class="pic"><img src="assets/img/Kelly Kate.jpg" class="img-fluid" alt=""></div>
                            <div class="professor-info">
                                <h4>Kelly Kate</h4>
                                <span>Master Degree in Banking</span>
                                <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
                                <div class="social">
                                    <a href="#"><i class="ri-twitter-fill"></i></a>
                                    <a href="#"><i class="ri-facebook-fill"></i></a>
                                    <a href="#"><i class="ri-instagram-fill"></i></a>
                                    <a href="#"> <i class="ri-linkedin-box-fill"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mt-4" data-aos="zoom-in" data-aos-delay="400">
                        <div class="professor d-flex align-items-start">
                            <div class="pic"><img src="assets/img/john doe.jpg" class="img-fluid" alt=""></div>
                            <div class="professor-info">
                                <h4>John Doe</h4>
                                <span>Professional Speaker in English, French and Chinese</span>
                                <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>
                                <div class="social">
                                    <a href="#"><i class="ri-twitter-fill"></i></a>
                                    <a href="#"><i class="ri-facebook-fill"></i></a>
                                    <a href="#"><i class="ri-instagram-fill"></i></a>
                                    <a href="#"> <i class="ri-linkedin-box-fill"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Professor Section -->

        <!-- ======= Pricing Section ======= -->
        <section id="pricing" class="pricing">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Tuition Fee</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="row">

                    <?php
                    $sqlTuition = "SELECT tblTuitionFee.ID, tblLevel.Title, tblTuitionFee.Price, tblTuitionFee.Description FROM tblTuitionFee
               JOIN tblLevel ON tblTuitionFee.Level = tblLevel.ID;";
                    $resultTuition = mysqli_query($conn, $sqlTuition);

                    if (mysqli_num_rows($resultTuition) > 0) {
                        while ($rowTuition = mysqli_fetch_assoc($resultTuition)) {
                            echo '<div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">';
                            echo '<div class="box featured">';
                            echo '<h3>' . $rowTuition['Title'] . '</h3>';
                            echo '<h4><sup>$</sup>' . $rowTuition['Price'] . '<span>per year</span></h4>';
                            echo '<ul>';
                            echo '<li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>';
                            echo '<li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>';
                            echo '<li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>';
                            echo '<li class="na"><i class="bx bx-x"></i> <span>Pharetra massa massa ultricies</span></li>';
                            echo '<li class="na"><i class="bx bx-x"></i> <span>Massa ultricies mi quis hendrerit</span></li>';
                            echo '</ul>';
                            echo '<a href="#" class="buy-btn">Get Started</a>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>

            </div>
        </section><!-- End Pricing Section -->

        <!-- ======= Frequently Asked Questions Section ======= -->
        <section id="faq" class="faq section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Frequently Asked Questions</h2>
                    <p>Our FAQ section provides answers to common questions about our institution, including admission requirements, financial aid, and more.</p>
                </div>

                <div class="faq-list">
                    <ul>

                        <li data-aos="fade-up" data-aos-delay="100">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">When is the enrollment date for academic 2023?<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                                <p>For academic 2023 Batch 20, We will open for enrollment from 2023-01-16 until 2023-05-12 and start class on 2023-05-20.</p>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="200">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Can I apply online for admission?<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                                <p>You can apply online for admission or simply walk into our campus to apply. Assistance is provided for walk-in applicants.</p>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="300">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Can I withdraw my application?<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                                <p>Yes, you can do so. However, the application and registration fees are non-refundable.</p>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="400">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Is there an entrance exam for admission to <?php echo $name ?>?<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                                <p>High school graduates, who have successfully passed their “BACII” exam, are eligible to apply for admission to Paragon International University. There is not a separate entrance exam required for admission.</p>
                            </div>
                        </li>

                    </ul>
                </div>

            </div>
        </section><!-- End Frequently Asked Questions Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Contact</h2>
                    <p>Just send us your questions or concerns by starting a new case and we will give you the help you need.</p>
                </div>

                <div class="row">

                    <div class="col-lg-5 d-flex align-items-stretch">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Location:</h4>
                                <p><a href="https://www.google.com/maps/place/Glory+International+School+in+Oudong/@11.8229794,104.76758,15z/data=!4m6!3m5!1s0x310eb0e3c61ba661:0x2c4c593264eeefbc!8m2!3d11.8210473!4d104.7832061!16s%2Fg%2F11c6cbgyq0" target="_blank">St. 5th, Vinhear Loung, Ponhea Leu, Kandal, Cambodia</a></p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p><a href="mailto:phearakph2003@gmail.com">phearakph2003@gmail.com</a></p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Call:</h4>
                                <p><a href="tel:(+855)968484940">(+855) 96 848 4940</a></p>
                            </div>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3905.203060069509!2d104.7832061!3d11.821047300000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310eb0e3c61ba661%3A0x2c4c593264eeefbc!2sGlory%20International%20School%20in%20Oudong!5e0!3m2!1sen!2skh!4v1682747745780!5m2!1sen!2skh" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                        </div>

                    </div>

                    <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up">
                        <form action="forms/subscribe.php" method="post" id="subscribeForm" class="subscribe-form">
                            <div class="row">
                                <h2>Stay connect with us</h2>
                                <h6 class="mb-4">Subscribe to our community to get exclusive offer, content and update</h6>

                                <div class="form-group col-md-12">
                                    <label for="name">Your Name</label>
                                    <input type="text" name="nameSub" class="form-control" id="nameSub" required />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="name">Your Email</label>
                                    <input type="email" class="form-control" name="emailSub" id="emailSub" required />
                                </div>
                                <div class="text-center">
                                    <button type="submit">Subscribe</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </section><!-- End Contact Section -->

        <!-- ======= Rating Section ======= -->
        <section id="rating" class="rating">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Feedback</h2>
                    <p>How was your experience using our application? Your rating matter!</p>
                </div>

                <div class="row">
                    <div id="rating-container" class="col-md-8">
                        <div class="row d-flex justify-content-between flex-fill">
                            <?php
                            $sqlRater = "SELECT * FROM ratings ORDER BY created_at DESC LIMIT 3;";
                            $resultRater = mysqli_query($conn, $sqlRater);

                            while ($rowRater = mysqli_fetch_assoc($resultRater)) {
                                $time = 100;
                                echo '<div class="col-md-4">';
                                echo '<div class="rateContent mx-md-2 my-sm-2 my-2 p-3 d-flex flex-column justify-content-between" data-aos="zoom-in" data-aos-delay="' . $time . '">';
                                echo '<div>';
                                echo '<div class="stars mb-3">';

                                $ratingStar = $rowRater['rating'];
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $ratingStar) {
                                        echo '<i class="fa-solid fa-star" style="color: var(--primary);"></i>';
                                    } else {
                                        echo '<i class="far fa-star" style="color: var(--primary);"></i>';
                                    }
                                }

                                echo '</div>';
                                echo '<h5 class="rater">' . $rowRater['name'] . '</h5>';
                                echo '<p class="feedback">' . $rowRater['comments'] . '</p>';
                                echo '</div>';
                                echo '<div class="rateDate text-muted"><div><hr></div><small>' . date("F d, Y h:i:s A", strtotime($rowRater['created_at'])) . '</small></div>';
                                echo '</div>';
                                echo '</div>';
                                $time = $time + 100;
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Rating Form -->
                    <div class="col-md-4">
                        <div class="row">
                            <form id="rating-form" method="post" data-aos="zoom-in" data-aos-delay="400">
                                <h3 class="text-center">Leave your comment here</h3>
                                <div class="ratingStar form-control outline-none border-0 d-flex justify-content-center mb-2">
                                    <input type="radio" id="star5" name="rate" value="5" required />
                                    <label class="star" for="star5"><span class="fa fa-star"></span></label>
                                    <input type="radio" id="star4" name="rate" value="4" required />
                                    <label class="star" for="star4"><span class="fa fa-star"></span></label>
                                    <input type="radio" id="star3" name="rate" value="3" required />
                                    <label class="star" for="star3"><span class="fa fa-star"></span></label>
                                    <input type="radio" id="star2" name="rate" value="2" required />
                                    <label class="star" for="star2"><span class="fa fa-star"></span></label>
                                    <input type="radio" id="star1" name="rate" value="1" required />
                                    <label class="star" for="star1"><span class="fa fa-star"></span></label>
                                </div>

                                <div id="fields">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control shadow-none" name="nameRating" id="nameRating" maxlength="50" placeholder=" " required />
                                        <label for="nameRating">*Name</label>
                                    </div>

                                    <div class="form-floating mb-4">
                                        <textarea class="form-control shadow-none" name="commentsRating" id="commentsRating" placeholder=" " maxlength="120" rows="5" required /></textarea>
                                        <label for="commentsRating">*Comments:</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button id="btnSubmitRating" type="submit" class="btn btn-primary form-control">Comment</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section><!-- End Rating Section -->

    </maina><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top" style="background-color: #f3f5fa;">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6 footer-contact">
                        <?php
                        // Query to select data from tblContact
                        $sql = "SELECT * FROM tblContact WHERE ID = 1;";

                        // Execute the query
                        $result = mysqli_query($conn, $sql);

                        // Display the results
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<h3>' . $row['Name'] . '</h3>';
                            }
                        }
                        ?>

                        <?php
                        // Query to select data from tblContact
                        $sqlC = "SELECT * FROM tblContact WHERE ID BETWEEN 2 AND 4 ORDER BY ID DESC;";

                        // Execute the query
                        $resultC = mysqli_query($conn, $sqlC);

                        // Display the results
                        if (mysqli_num_rows($resultC) > 0) {
                            while ($rowC = mysqli_fetch_assoc($resultC)) {
                                echo '<strong>' . $rowC['Name'] . '</strong>';
                                echo '<p><a href="' . $rowC['Link'] . '" target="_blank">' . $rowC['Text'] . '</a></p>';
                            }
                        }
                        ?>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-links">
                        <div class="row">
                            <div class="col-12">
                                <h4>Useful Links</h4>
                            </div>
                            <div class="col-6">
                                <ul>
                                    <li><i class="bx bx-chevron-right"></i> <a href="#about">About</a></li>
                                    <li><i class="bx bx-chevron-right"></i> <a href="#scholarship">Scholarship</a></li>
                                    <li><i class="bx bx-chevron-right"></i> <a href="#department">Programs</a></li>
                                    <li><i class="bx bx-chevron-right"></i> <a href="#event">Event</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul>
                                    <li><i class="bx bx-chevron-right"></i> <a href="#professor">Professor</a></li>
                                    <li><i class="bx bx-chevron-right"></i> <a href="#contact">Contact</a></li>
                                    <li><i class="bx bx-chevron-right"></i> <a href="http://localhost:8080/application%20form/login.php" target="_blank">Login</a></li>
                                    <li><i class="bx bx-chevron-right"></i> <a href="<?php echo $linkRegister; ?>" target="_blank"><b>Register Now</b></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-links">
                        <h4>Our Social Networks</h4>
                        <p>Stay connect with us:</p>
                        <div class="social-links mt-3">
                            <?php
                            // Query to select data from tblMarried
                            $sql = "SELECT * FROM tblContact WHERE ID <> 1;";

                            // Execute the query
                            $result = mysqli_query($conn, $sql);

                            // Display the results
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<a href="' . $row['Link'] . '" class="" title="' . $row['Name'] . '" target="_blank">' . $row['Icon'] . '</a>';
                                }
                            }

                            ?>
                            <!-- <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="twitter"><i class="bx bxl-telegram"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-youtube"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-tiktok"></i></a> -->
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container footer-bottom clearfix">
            <div class="copyright">&copy;
                <?php $current_year = date('Y');
                echo $current_year . " "; ?> <strong><span><?php echo $name ?></span></strong>. All Rights Reserved
            </div>
            <!-- <div class="credits">Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
        </div>
        </div>
    </footer><!-- End Footer -->

    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <!-- <script src="assets/vendor/php-email-form/validate.js"></script> -->

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/302987efd2.js" crossorigin="anonymous"></script>

    <!-- Script -->
    <script src="assets/js/script.js"></script>
    <script src="assets/js/subscribe.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // calculate the height of the rating-form div
            var formHeight = $("#rating-form").outerHeight();
            // set the height of all rateContent divs to the height of the rating-form div
            $(".rateContent").css('height', formHeight + 'px');

            // hide the input fields initially
            $('#fields').hide();
            $('.ratingStar input[type="radio"], #btnSubmitRating').click(function() {
                if (!$('.ratingStar input[type="radio"]:checked').length) {
                    Swal.fire({
                        icon: "info",
                        title: "Information!",
                        text: 'Please choose a rating level first!',
                        showConfirmButton: true,
                        confirmButtonColor: '#018690',
                        allowEscapeKey: true,
                        allowOutsideClick: false,
                    });
                } else {
                    $('#btnSubmitRating').text('Submit');
                    $('#fields').show();
                    $(".rateContent").css('height', $("#rating-form").Height() + 'px');
                }
            });

            // Timer
            function makeTimer() {
                var endTime = new Date('<?php echo $expiredDate . " 00:00:00"; ?>');

                endTime = Date.parse(endTime) / 1000;

                var now = new Date();
                now = Date.parse(now) / 1000;

                var timeLeft = endTime - now;

                var days = Math.floor(timeLeft / 86400);
                var hoursLeft = Math.floor(timeLeft - days * 86400);
                var hours = Math.floor(hoursLeft / 3600);
                var minutesLeft = Math.floor(hoursLeft - hours * 3600);
                var minutes = Math.floor(minutesLeft / 60);
                var seconds = Math.floor(
                    timeLeft - days * 86400 - hours * 3600 - minutes * 60
                );

                if (days < 10) {
                    days = "0" + days;
                }
                if (hours < 10) {
                    hours = "0" + hours;
                }
                if (minutes < 10) {
                    minutes = "0" + minutes;
                }
                if (seconds < 10) {
                    seconds = "0" + seconds;
                }

                $("#days").html(days);
                if (!$("#days").next().hasClass("countdown-label")) {
                    if (days <= 1) {
                        $("#days").after('<span class="countdown-label">Day</span>');
                    } else {
                        $("#days").after('<span class="countdown-label">Days</span>');
                    }
                }
                $("#hours").html(hours);
                if (!$("#hours").next().hasClass("countdown-label")) {
                    if (hours <= 1) {
                        $("#hours").after('<span class="countdown-label">Hour</span>');
                    } else {
                        $("#hours").after('<span class="countdown-label">Hours</span>');
                    }
                }
                $("#minutes").html(minutes);
                if (!$("#minutes").next().hasClass("countdown-label")) {
                    if (minutes <= 1) {
                        $("#minutes").after(
                            '<span class="countdown-label">Minute</span>'
                        );
                    } else {
                        $("#minutes").after(
                            '<span class="countdown-label">Minutes</span>'
                        );
                    }
                }
                $("#seconds").html(seconds);
                if (!$("#seconds").next().hasClass("countdown-label")) {
                    if (seconds <= 1) {
                        $("#seconds").after(
                            '<span class="countdown-label">Second</span>'
                        );
                    } else {
                        $("#seconds").after(
                            '<span class="countdown-label">Seconds</span>'
                        );
                    }
                }
            }

            setInterval(function() {
                makeTimer();
            }, 1000);

            // Subscribe
            $("#subscribeForm").submit(function(event) {
                // Prevent the form from submitting normally
                event.preventDefault();

                // Get the form data
                var formData = {};
                formData.name = $("#nameSub").val();
                formData.email = $("#emailSub").val();

                // Send the AJAX request
                $.ajax({
                    url: "forms/subscribe.php",
                    method: "post",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: 'Thank you for your subscription!',
                                showConfirmButton: true,
                                confirmButtonColor: '#018690',
                                allowEscapeKey: true,
                                allowOutsideClick: false,
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...Process Declinded",
                                text: response.message,
                                showConfirmButton: true,
                                confirmButtonColor: '#018690',
                                allowEscapeKey: true,
                                allowOutsideClick: false,
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Display error message
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Your subscription failed: " + errorThrown,
                            showConfirmButton: true,
                            confirmButtonColor: '#018690',
                            allowEscapeKey: true,
                            allowOutsideClick: false,
                        });
                    }
                });
            });

            // just a value selector
            // $('input[name="rate"]').click(function() {
            //     console.log($(this).val());
            // });

            // Rate
            $("#rating-form").submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: "forms/rating.php",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: 'Thank you for your rating!',
                                showConfirmButton: true,
                                confirmButtonColor: '#018690',
                                allowEscapeKey: true,
                                allowOutsideClick: false,
                            });
                            var ratingHtml = '<div class="col-md-4">';
                            ratingHtml += '<div class="rateContent mx-md-2 my-sm-2 my-2 p-3 d-flex flex-column justify-content-between" data-aos="zoom-in">';
                            ratingHtml += '<div>';
                            ratingHtml += '<div class="stars mb-3">';

                            var ratingStar = response.data.rating;
                            for (var i = 1; i <= 5; i++) {
                                if (i <= ratingStar) {
                                    ratingHtml += '<i class="fa-solid fa-star" style="color: var(--primary);"></i>';
                                } else {
                                    ratingHtml += '<i class="far fa-star" style="color: var(--primary);"></i>';
                                }
                            }

                            ratingHtml += '</div>';
                            ratingHtml += '<h5 class="rater">' + response.data.name + '</h5>';
                            ratingHtml += '<p class="feedback">' + response.data.comments + '</p>';
                            ratingHtml += '</div>';
                            ratingHtml += '<div class="rateDate text-muted"><div><hr></div><small>' + new Date(response.data.created_at).toLocaleString() + '</small></div>';
                            ratingHtml += '</div>';
                            ratingHtml += '</div>';

                            $('#rating-container .row').prepend(ratingHtml);
                            $(".rateContent").css('height', $("#rating-form").Height() + 'px');
                            // Get the row element
                            let row = $('.row.d-flex.justify-content-between.flex-fill');

                            // Remove the last col-md-4 element
                            row.find('.col-md-4').last().remove();
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Fail",
                                text: 'Your rating failed.',
                                showConfirmButton: true,
                                confirmButtonColor: '#018690',
                                allowEscapeKey: true,
                                allowOutsideClick: false,
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Display error message
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Your subscription failed: " + errorThrown,
                            showConfirmButton: true,
                            confirmButtonColor: '#018690',
                            allowEscapeKey: true,
                            allowOutsideClick: false,
                        });
                    },
                });
            });
        })
    </script>
</body>

</html>