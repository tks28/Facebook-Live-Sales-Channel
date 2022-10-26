<?php
    require "config.php";
    include('header.php');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "facebook";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $code = $_POST['itemCode'];

    $sql = "SELECT code FROM inventory WHERE code='$code'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        echo "<h1>Are you sure you want to delete Item Code $code</h1>";
    }
    else{
        echo "No result found";
    }
?>

<!doctype html>
<html lang="en">
    <style>
        h1 {
            text-align: center;
        }
        .container {
            text-align: center;
        }
    </style>

    <body>
        <div class="container" style="margin-top: 50px">
            <form method="POST" action="deleteItem.php">
                <input type="hidden" name="itemCode" value="<?php echo $code; ?>">
                <button type="submit" class="btn btn-danger">Yes</button>
            </form>
            <a href="inventory.php">
                <button type="button" class="btn btn-success">No</button>
            </a>
        </div>
    </body>
</html>