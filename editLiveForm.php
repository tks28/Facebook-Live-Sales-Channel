<?php
    require "config.php";
    include('header.php');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "facebook";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $id = $_POST["id"];

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
    <style>
        h1 {
            text-align: center;
        }
    </style>

    <body>
        <div class="container">
            <h1>Edit Live for <?php echo $name ?></h1>
            <form method="post" action="editLive.php">
                <input name='id' type='hidden' value='<?php echo $id ?>'>
                <div class="form-group">
                    <label for="name">Live Name</label>
                    <input type="text" class="form-control" name="liveName" placeholder="Enter Facebook Live Name" value="<?php echo $name ?>">
                </div>
                <div class="form-group">
                    <label for="item">Item</label>
                    <select class="form-select" aria-label="Default" name="liveItems[]" multiple>
                        <?php
                            $sql = "SELECT id, name, code, price, quantity FROM inventory";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    if(in_array($row["name"],$items)){
                                        echo '<option selected value='.$row["name"].'>'.$row["name"].'</option>';
                                    }
                                    else{
                                        echo '<option value='.$row["name"].'>'.$row["name"].'</option>';
                                    }
                                }
                            } else {
                                echo "0 results";
                            } 
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
       
    </body>
</html>