<?php
    require "config.php";
    include('header.php');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "facebook";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if(isset($_POST['itemCode'])){
        $itemCode = $_POST['itemCode'];
        $_SESSION['itemCode'] = $itemCode;
        echo $_SESSION['itemCode'];
    }
    else{
        unset($_SESSION['itemCode']); 
        echo "Sucess";
    }


    $live = $_POST['liveID'];
    $_SESSION['liveID'] = $live;
    

    header('Location: live.php');
    
?>