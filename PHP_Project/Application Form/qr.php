<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
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

        .qr-container img{
            border: 2px solid #000;
            padding: 15px;
            border-radius: 10px;
        }

        h1 {
            font-size: 1.5rem;
        }

        p{
            font-size: 2rem;
        }
    </style>
</head>

<body>
    <div class="qr-container">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=Example" alt="QR code">
        <h1>BBA-20230515185227476</h1>
    </div>
</body>

</html>