<?php
	session_start();
    $_SESSION['posted'] = "false";
    include('header.php');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "facebook";

    $conn = new mysqli($servername, $username, $password, $dbname);
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
            <h1>Live Stream Setup</h1>
            <h2>Please enter the Facebook Live embed link</h2>
            <form method="post" action="live.php">
                <div class="form-group">
                    <label for="link">Embed Link</label>
                    <input type="text" class="form-control" name="link" placeholder="Enter Facebook Live Embed Link">
                </div>
                <br>
                <div class="form-group">
                    <select class="form-select" aria-label="Default" name="items[]" multiple>
                        <?php
                            $sql = "SELECT id, name, code, price, quantity FROM inventory";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '<option value='.$row["name"].'>'.$row["name"].'</option>';
                                }
                            } else {
                                echo "0 results";
                            } 
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
        
    </body>
</html>
