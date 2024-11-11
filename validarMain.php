<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <script src="js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación</title>
</head>

<body>
    <center>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                </div>
                <div class="col-7">
                    <h2>Validación</h2>
                    <?php
                    session_start();

                    if (!isset($_SESSION['id'])) {
                        header("Location: login.php");
                        exit();
                    }

                    
                    ?>
                </div>
                <div class="col">
                </div>
            </div>
        </div>
    </center>
</body>

</html>