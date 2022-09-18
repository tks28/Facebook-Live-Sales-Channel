<?php
    require "config.php";
    include('header.php');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "facebook";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $name = $_POST['itemName'];
    $code = $_POST['itemCode'];
    $price = $_POST['itemPrice'];
    $quantity = $_POST['itemQuantity'];

    $sql = "INSERT INTO inventory (name, code, price, quantity)
    VALUES ('$name', '$code', '$price', '$quantity')";

    $conn->query($sql);

    header('Location: inventory.php');
    
?>