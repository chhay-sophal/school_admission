<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <style>
        body {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .rating {
            float: left;
        }

        .rating label {
            color: #e1e1e1;
            float: right;
            font-size: 2em;
            margin-left: 1rem;
        }

        .rating input[type="radio"] {
            display: none;
        }

        .rating label.star:hover {
            transform: scale(1.2);
        }

        .rating input[type="radio"]:checked~label,
        .rating input[type="radio"]:hover~label {
            color: orange;
            transition: .1s all;
        }
    </style>
</head>

<body>
    <form id="rating-form" method="post">
        <div class="form-group">
            <div class="rating">
                <input type="radio" id="star5" name="rating" value="5" />
                <label class="star" for="star5"><span class="fa fa-star"></span></label>
                <input type="radio" id="star4" name="rating" value="4" />
                <label class="star" for="star4"><span class="fa fa-star"></span></label>
                <input type="radio" id="star3" name="rating" value="3" />
                <label class="star" for="star3"><span class="fa fa-star"></span></label>
                <input type="radio" id="star2" name="rating" value="2" />
                <label class="star" for="star2"><span class="fa fa-star"></span></label>
                <input type="radio" id="star1" name="rating" value="1" />
                <label class="star" for="star1"><span class="fa fa-star"></span></label>
            </div>
        </div>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="comments">Comments:</label>
            <textarea class="form-control" name="comments" id="comments"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // optional 
        // just a value selector 
        let rating = document.getElementsByName('rating');
        rating.forEach((e) => {
            e.addEventListener('click', function() {
                console.log(e.value);
            })
        })

        $(document).ready(function() {
            // Submit the form data using Ajax
            $('#rating-form').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: 'forms/submit_rating.php',
                    data: $('#rating-form').serialize(),
                    success: function(response) {
                        if (response === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thank you for your rating!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Rating submit error!',
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>