<?php
	session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "facebook";

    $conn = new mysqli($servername, $username, $password, $dbname);

?>
<!doctype html>
<html lang="en">
    <style>
        h1, h2 {
            text-align: center;
        }
    </style>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">ETCM</a>
            </div>
        </nav>
       
        <div class="container">
            <h1>Checkout Successful.</h1>
            <h1>Thank you for choosing ETCM</h1>
        </div>
    </body>
</html>