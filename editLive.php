<?php
    require "config.php";
    include('header.php');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "facebook";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $name = $_POST['liveName']; 
    $items = $_POST['liveItems'];
    $item = implode("|", $items);
    $id = $_POST['id'];

    $sql = "UPDATE live SET name='$name', items='$item'
    WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    header('Location: liveSelect.php');
    
?>