<?php
    $_SESSION['posted'] = "false";
    include('header.php');
    require_once("config.php");

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "facebook";

    $conn = new mysqli($servername, $username, $password, $dbname);



    $facebookID = $_SESSION['userData']['id'];
    $response = $FBObject->get("/$facebookID?fields=accounts", $_SESSION['access_token']);
    $pageData = $response->getGraphNode()->asArray();
    $_SESSION['pageData'] = $pageData;

    $pageID = $_SESSION['pageData']['accounts']['0']['id'];

    $response = $FBObject->get("/$pageID?fields=live_videos", $_SESSION['access_token']);
    $liveData = $response->getGraphNode()->asArray();
    
    $liveID = $liveData['live_videos']['0']['id'];

    $response = $FBObject->get("/$pageID?fields=access_token", $_SESSION['access_token']);
    $accessT = $response->getGraphNode()->asArray();
    $pageAcessToken = $accessT['access_token'];

    $response = $FBObject->get("/$liveID?fields=comments", $pageAcessToken);
    $comments = $response->getGraphNode()->asArray();



    ?>

<!doctype html>
<html lang="en">
    <style>
        h1, h2 {
            text-align: center;
        }
    </style>
    <body>
        <div class="container">
            <h1>Order</h1>
            <table class="table table-striped">                     
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Order ID</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
            </table>
            <?php
                echo $comments['comments']['0']['message']. " by " .$comments['comments']['0']['from']['name'];
            ?>
            <br>
            <?php
                echo $comments['comments']['1']['message']. " by " .$comments['comments']['1']['from']['name'];
            ?>
        </div>
    </body>
</html>