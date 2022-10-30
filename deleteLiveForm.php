<?php
    require "config.php";
    include('header.php');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "facebook";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $id = $_POST["id"];

    $sql = "SELECT name FROM live WHERE id='$id'";
    $result = $conn->query($sql);

   
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
            <?php
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $name = $row["name"]; 
                    }
                    echo "<h1>Are you sure you want to delete $name</h1>";
                }
                else{
                    echo "No result found";
                }
            ?>
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <form method="POST" action="deleteLive.php">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <button type="submit" class="btn btn-danger">Yes</button>
                        </form>
                    </tr>
                    <tr>
                        <a href="liveSelect.php">
                            <button type="button" class="btn btn-success">No</button>
                        </a>
                    </tr>
                </tbody>
            </table> 
        </div>
    </body>
</html>