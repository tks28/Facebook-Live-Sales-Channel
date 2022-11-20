<?php
    require "config.php";
    include('header.php');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "facebook";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $live = $_POST['liveID'];
    $_SESSION['liveID'] = $live;
    
    $itemSelected = $_SESSION['itemCode'];

    $sql = "SELECT items FROM live WHERE id='$live'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $arr = $row["items"];
        }
    }
    $itemArray = explode("|", $arr);

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
    
    if(empty($_SESSION['counter'])){
         $_SESSION['counter'] = 0;
    }

    $len = count($comments['comments']);
    $date = date("Y/m/d");

    if(!empty($comments)){
        while($_SESSION['counter'] < $len){
            $temp = $comments['comments'][$_SESSION['counter']]['message'];
            $message = explode(" ", $temp);
            $item = $message['0'];

            $sql = "SELECT name FROM inventory WHERE code='$item'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $name = $row["name"]; 
                }
            }

            if(in_array($name, $itemArray) && $name == $itemSelected){
                $fbID = $comments['comments'][$_SESSION['counter']]['from']['id'];
                $fbName = $comments['comments'][$_SESSION['counter']]['from']['name'];
    
                $num = $message['1'];
                ltrim($num, $num['0']);
                $quantity = $num;
    
                $sql = "SELECT price FROM inventory WHERE code='$item'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $price = $row["price"] * $quantity;
                    }
                } 
                echo $_SESSION['counter'];

                $sql = "SELECT * FROM orders WHERE fbID='$fbID' AND item='$item' AND live='$live'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $oldQuantity = $row['quantity'];
                        $sql = "UPDATE orders SET quantity='$quantity' price='$price' WHERE fbID='$fbID' AND item='$item' AND live='$live'";                 
                        
                        if ($conn->query($sql) === TRUE) {
                            echo "New record created successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                        
                        $sql = "UPDATE inventory SET quantity = quantity - '$quantity' + '$oldQuantity' WHERE code = '$item'";
                        $conn->query($sql);

                        $_SESSION['itemCount'][$item] = $_SESSION['itemCount'][$item] - $oldQuantity + $quantity;
                    }
                }
                else{
                    $sql = "INSERT INTO orders (fbID, fbName, item, price, live, quantity, date)
                    VALUES ('$fbID', '$fbName', '$item', '$price', '$live', '$quantity', '$date')";
                    
    
                    if ($conn->query($sql) === TRUE) {
                        echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                    $sql = "UPDATE inventory SET quantity = quantity - '$quantity' WHERE code = '$item'";
                    $conn->query($sql);

                    $_SESSION['itemCount'][$item] = $quantity;
                } 

                $name = "";
            }
            else{

            }
            $_SESSION['counter']++;
        }
    }

    header('Location: live.php');
    
?>