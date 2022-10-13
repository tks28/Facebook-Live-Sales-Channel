<?php
    session_start();
    $_SESSION['posted'] = "false";
    include('header.php');

    $counter = 1;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "facebook";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if(isset($_SESSION['liveID'])){
        $id = $_SESSION['liveID'];
        unset($_SESSION['liveID']); 
    }
    else{
        $id = $_POST["id"];
    }

    $sql = "SELECT name, items, link FROM live WHERE id='$id'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $name = $row["name"]; 
            $item = $row["items"];
            $link = $row["link"];
        }
    }

    $items = explode("|", $item);
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Live</title>
    </head>

    <body>
        <p align="center">
            <?php echo $link; ?>
        </p>

        <div class="container text-center">
            <div class="row">
                <div class="col border">
                    Item
                </div>
                <div class="col border">
                    Action
                </div>
                <div class="col border">
                    Item Quantity
                </div>
                <div class="col border">
                    Current Stock Count
                </div>
            </div>
            <?php
                if(!empty($items)){
                    foreach($items as $object){
                        echo '<div class="row">
                            <div class="col border">'
                            .$object.
                            '</div>
                            <div class="col border">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio'.$counter.'">
                            <label class="btn btn-outline-success" for="btnradio'.$counter.'">Select</label>';

                            $counter = $counter +1;

                        echo'<input type="radio" class="btn-check" name="btnradio" id="btnradio'.$counter.'">
                            <label class="btn btn-outline-danger" for="btnradio'.$counter.'">Remove</label>
                            </div>
                            </div>';

                        $sql = "SELECT quantity FROM inventory WHERE name='$object'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo'<div class="col border">'
                                    .$row["quantity"].
                                    '</div>';
                                echo'<div class="col border">'
                                    .$row["quantity"].
                                    '</div>';
                            }
                        } 
                        echo'</div>';
                        $counter = $counter + 1; 
                    }
                }
            ?>
             <form method="post" action="collectOrder.php">
                <div class="form-group">
                    <input type="hidden" class="form-control" name="liveID" value="<?php echo $id; ?>">
                </div>
                <button type="submit" class="btn btn-success">Edit</button>
            </form>
    </body>
</html>