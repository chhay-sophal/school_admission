<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Search</title>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://kit.fontawesome.com/302987efd2.js" crossorigin="anonymous"></script>

    <style>
        @font-face {
            font-family: Poppins;
            src: url(assets/fonts/Poppins.ttf);
        }

        @font-face {
            font-family: Krasar;
            src: url(assets/fonts/Krasar.ttf);
        }

        * {
            font-family: Poppins;
        }

        /* Define the color variables in :root */
        :root {
            --primary: #018690;
            --dark: #006b73;
            --white: #fff;
            --gold: rgb(255, 217, 0);
        }

        body {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .kh {
            font-family: Krasar !important;
        }

        #qr-code {
            display: block;
            margin: 0 auto;
            margin-top: 40px;
            border-radius: 5px;
            border: 2px solid #000;
            padding: 10px;
        }

        .search-container {
            width: 300px;
            margin: 0 auto;
        }

        .container {
            /* width: 1000px; */
        }

        #search {
            background-color: #fff;
            border: 1px solid #000;
        }

        #loader {
            width: 100vw;
            height: 100vh;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 99;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #caf0f8;
            overflow: hidden;
        }

        .loader {
            animation: rotate 2s infinite;
            height: 50px;
            width: 50px;
        }

        .loader:before,
        .loader:after {
            border-radius: 50%;
            content: '';
            display: block;
            height: 20px;
            width: 20px;
        }

        .loader:before {
            animation: ball1 1s infinite;
            background-color: var(--primary);
            box-shadow: 30px 0 0 var(--gold);
            margin-bottom: 10px;
        }

        .loader:after {
            animation: ball2 1s infinite;
            background-color: var(--dark);
            box-shadow: 30px 0 0 var(--white);
        }

        /* Define the keyframes using the variable names */
        @keyframes rotate {
            0% {
                -webkit-transform: rotate(0deg) scale(0.8);
                -moz-transform: rotate(0deg) scale(0.8);
            }

            50% {
                -webkit-transform: rotate(360deg) scale(1.2);
                -moz-transform: rotate(360deg) scale(1.2);
            }

            100% {
                -webkit-transform: rotate(720deg) scale(0.8);
                -moz-transform: rotate(720deg) scale(0.8);
            }
        }

        @keyframes ball1 {
            0% {
                box-shadow: 30px 0 0 var(--gold);
            }

            50% {
                box-shadow: 0 0 0 var(--gold);
                margin-bottom: 0;
                -webkit-transform: translate(15px, 15px);
                -moz-transform: translate(15px, 15px);
            }

            100% {
                box-shadow: 30px 0 0 var(--gold);
                margin-bottom: 10px;
            }
        }

        @keyframes ball2 {
            0% {
                box-shadow: 30px 0 0 var(--white);
            }

            50% {
                box-shadow: 0 0 0 var(--white);
                margin-top: -20px;
                -webkit-transform: translate(15px, 15px);
                -moz-transform: translate(15px, 15px);
            }

            100% {
                box-shadow: 30px 0 0 var(--white);
                margin-top: 0;
            }
        }
    </style>
</head>

<body>
    <div id="loader" class="loading-container">
        <div class="loader"></div>
    </div>

    <div class="container mt-4">
        <div class="search-container">
            <div class="button-container text-center mb-3">
                <a href="index.php"><button type="button" class="btn btn-secondary"><i class="fa-solid fa-house"></i> &#160; &#160;HOME</button></a>
            </div>
            <form method="get">
                <div class="input-group">
                    <div class="form-outline">
                        <input type="text" class="form-control mr-sm-2" id="search" name="search" placeholder="Ref Number..." required />
                    </div>
                    <button type="submit" class="btn btn-primary d-inline-block" id="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <div id="status" class="status"></div>

        <div id="card" class="card my-5">
            <div class="card-body">
                <div class="row" id="card-container">

                    <div id="info-header" class="col-md-3">
                    </div>

                    <div id="info" class="col-md-9 col-sm-12">
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <!-- // Import the html2canvas library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>
    <script>
        $(window).on('load', function() {
            $('#loader').hide();
        });
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var search = $(this).val().trim();
                if (search === '') {
                    $('#card').hide();
                }
            });

            // Get search query from URL and populate search box
            var urlParams = new URLSearchParams(window.location.search);
            var searchQuery = urlParams.get('search');
            if (searchQuery) {
                $('#search').val(searchQuery);
                performSearch(searchQuery);
            }

            // Search function
            function performSearch(searchQuery) {
                $.ajax({
                    url: 'forms/get_register_data.php',
                    type: 'get',
                    data: {
                        search: searchQuery
                    },
                    success: function(response) {
                        if (response !== '') {
                            var data = JSON.parse(response);
                            console.log(data)
                            var html = '';
                            var header = '';
                            if (data.length > 0) {
                                $.each(data, function(index, row) {
                                    if (row.Status == 'Under Review') {
                                        style = 'info';
                                    } else if (row.Status == 'Rejected') {
                                        style = 'danger';
                                    } else {
                                        style = 'success';
                                    }
                                    header += '<div class="text-center"><img class="rounded-circle img-fluid" src="upload/register/' + row.Photo + '" alt="photo" style="width: 150px; height: 150px; object-fit: cover;"></div>';
                                    header += '<?php
                                                if (isset($_GET['search'])) {
                                                    $current_url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                                    echo '<img class="mx-auto" id="qr-code" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $current_url . '" alt="QR Code">';
                                                }
                                                ?>';
                                    html += '<div class="table-responsive">';
                                    html += '<table class="table table-bordered">';
                                    html += '<h3 class="text-center fw-bolder my-4">Admission Application</h3>';
                                    html += '<tbody>';
                                    html += '<tr><td>Register ID</td><td>' + row.ID + '</td></tr>';
                                    html += '<tr><td>Batch</td><td>' + row.Batch + '</td></tr>';
                                    html += '<tr><td>Ref</td><td>' + row.Ref + '</td></tr>';
                                    html += '<tr><td>Khmer Name</td><td class="kh">' + row.First_Name_Kh + " " + row.Last_Name_Kh + '</td></tr>';
                                    html += '<tr><td>English Name</td><td>' + row.First_Name_En + " " + row.Last_Name_En + '</td></tr>';
                                    html += '<tr><td>Gender</td><td>' + row.Sex + '</td></tr>';
                                    html += '<tr><td>Marital Status</td><td>' + row.Marital_Status + '</td></tr>';
                                    html += '<tr><td>Date of Birth</td><td>' + row.DOB + '</td></tr>';
                                    html += '<tr><td>Place of Birth</td><td>' + row.Village_POB + ", " + row.Commune_POB + ", " + row.District_POB + ", " + row.Province_POB + '</td></tr>';
                                    html += '<tr><td>Current Address</td><td>' + row.Village_Current + ", " + row.Commune_Current + ", " + row.District_Current + ", " + row.Province_Current + '</td></tr>';
                                    html += '<tr><td>Nationality</td><td>' + row.Nationality + '</td></tr>';
                                    html += '<tr><td>Father Name</td><td>' + row.Father_Name + '</td></tr>';
                                    html += '<tr><td>Father Tel</td><td>' + row.Father_Tel + '</td></tr>';
                                    html += '<tr><td>Mother Name</td><td>' + row.Mother_Name + '</td></tr>';
                                    html += '<tr><td>Mother Tel</td><td>' + row.Mother_Tel + '</td></tr>';
                                    html += '<tr><td>Emergency Contact</td><td>' + row.Emergency_Contact_Name + '</td></tr>';
                                    html += '<tr><td>Relationship</td><td>' + row.Emergency_Contact_Relation + '</td></tr>';
                                    html += '<tr><td>Tel</td><td>' + row.Emergency_Contact_Tel + '</td></tr>';
                                    html += '<tr><td>Diploma</td><td>' + row.Diploma_Certificate + '</td></tr>';
                                    html += '<tr><td>Student ID</td><td>' + row.Student_ID_File + '</td></tr>';
                                    html += '<tr><td>ID Card</td><td>' + row.Khmer_ID_File + '</td></tr>';
                                    html += '<tr><td>Level</td><td>' + row.Level + '</td></tr>';
                                    html += '<tr><td>Major</td><td>' + row.Major + '</td></tr>';
                                    html += '<tr><td>Shift</td><td>' + row.Shift + '</td></tr>';
                                    html += '<tr><td>Payment Method</td><td>' + row.Payment_Method + '</td></tr>';
                                    html += '<tr><td>Request Date</td><td>' + row.ReqDate + '</td></tr>';
                                    html += '<tr><td>Status</td><td><span class="badge badge-' + style + ' rounded-pill d-inline">' + row.Status + '</span></td></tr>';
                                    html += '<tr><td>By</td><td>' + row.dBy + '</td></tr>';
                                    html += '<tr><td>Date</td><td>' + row.dDate + '</td></tr>';
                                    html += '<tr><td>Reason</td><td>' + row.Reason + '</td></tr>';
                                    html += '</tbody>';
                                    html += '</table>';
                                    html+= '</div>';
                                });
                            } else {
                                $('#card').hide();
                                html += '<p id="not-found" class="text-center text-danger bg-black">No results found</p>';
                            }
                            $('#info-header').html(header);
                            $('#info').html(html);
                        } else {
                            $('#info').html('<p id="not-found" class="text-center text-danger bg-black">No results found</p>');
                            $('#card').hide();
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error response from server
                        console.error(error);
                    }
                });
            }

            // Event listener for search form submission
            $('#search-form').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission behavior
                var search = $('#search').val().trim();
                if (search !== '') {
                    performSearch(search);
                }
            });
        })
    </script>
</body>

</html>