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
    $link = $_POST['liveLink'];
    $item = implode("|", $items);
   
    $sql = "INSERT INTO live (name, items, link)
    VALUES ('$name', '$item', '$link')";

    $conn->query($sql);
    echo "Record sucessful";
    //header('Location: inventory.php');
    
?>