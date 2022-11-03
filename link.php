<?php
    require "config.php";
    include('header.php');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "facebook";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sent = array();
    $liveID = $_POST['liveID'];

    $pageID = $_SESSION['pageData']['accounts']['0']['id'];


    $response = $FBObject->get("/$pageID?fields=access_token", $_SESSION['access_token']);
    $accessT = $response->getGraphNode()->asArray();
    $pageAcessToken = $accessT['access_token'];


    $response = $FBObject->get("/$pageID?fields=conversations{senders}", $pageAcessToken);
    $senders = $response->getGraphNode()->asArray();

    $senderID = $senders['conversations']['0']['senders']['0']['id'];
    $senderName = $senders['conversations']['0']['senders']['0']['name'];

    $sql = "SELECT fbID, fbName FROM orders WHERE live='$liveID'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            if($row['fbName'] == $senderName && !in_array($row['fbName'], $sent)){
                $array = array("messaging_type"=>"RESPONSE", "recipient"=>"{'id':'$senderID'}");
                $url = urlencode("http://localhost/Test/checkout.php?fbID=$row[fbID]&liveID=$liveID");

                $response = $FBObject->post("/$pageID/messages?message={'text':'$url'}", $array, $pageAcessToken);

                array_push($sent, $row['fbName']);
            }
        }
    }

    // $array = array("messaging_type"=>"RESPONSE", "recipient"=>"{'id':'$senderID'}");
    // $url = urlencode("http://localhost/Test/checkout.php?fbID=103316739133105&liveID=1");

    // $response = $FBObject->post("/$pageID/messages?message={'text':'$url'}", $array, $pageAcessToken);



    

  

    //header('Location: live.php');
    
?>