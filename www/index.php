<?php
session_name('curavoice');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap 4.4.1 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Bootstrap 3.4.1 jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap 4.4.1 JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- FontAwesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/mic-favicon.svg">
    <link rel="stylesheet" type="text/css" href="../includes/css/main.css">
    <script type="text/javascript" charset="utf-8" src="../includes/js/main.js"></script>

    <title>CURAVoice</title>

</head>

<body>

    <?php
        if (isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['fn']) && isset($_SESSION['ln'])) {

            require '../includes/php/pages/app.php';

        } else {

            require '../includes/php/pages/modal.php';

        }
    ?>

</body>

<footer>

</footer>

</html>