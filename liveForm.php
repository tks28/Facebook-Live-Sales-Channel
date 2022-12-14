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
    <script src="validation.js"></script>     
    <body>
        <div class="container" style="margin-top: 50px">
            <h1>Live Stream Setup</h1>
            <h2>Please enter the Facebook Live embed link</h2>
            <form method="post" action="addLive.php" class="needs-validation"  novalidate="">
                <div class="form-group">
                    <label for="name">Live Name</label>
                    <input type="text" class="form-control" name="liveName" placeholder="Enter Facebook Live Name" required>
                    <div class="invalid-feedback"> Valid name is required. </div>
                </div>
                <div class="form-group">
                    <label for="link">Embed Link</label>
                    <input type="text" class="form-control" name="liveLink" placeholder="Enter Facebook Live Embed Link" required>
                    <div class="invalid-feedback"> Valid link is required. </div>
                </div>
                <div class="form-group">
                    <label for="item">Item</label>
                    <select class="form-select" aria-label="Default" name="liveItems[]" multiple required>
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
                    <div class="invalid-feedback"> Please select at least one item. </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
        
    </body>
</html>
