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
    $oldCode = $_POST['oldCode'];

    $sql = "UPDATE inventory SET name='$name', code='$code', price='$price', quantity='$quantity'
    WHERE code='$oldCode'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    header('Location: inventory.php');
    
?>