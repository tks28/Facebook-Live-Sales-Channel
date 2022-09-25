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
            <h1>Live Stream</h1>
            <table class="table table-striped">                     
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Items</th>
                        <th>Select</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                $sql = "SELECT id, name, items FROM live";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $counter = 1;
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td scope="row">' . $counter. '</td>
                                <td>' .$row["name"] .'</td>
                                <td> '.$row["items"] .'</td>
                                <td>
                                    <form method="post" action="live.php">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="id" value="'.$row["id"].'">
                                        </div>
                                        <button type="submit" class="btn btn-success">Select</button>
                                    </form>
                                </td>
                                <td>
                                <form method="post" action="editLiveForm.php">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="id" value="'.$row["id"].'">
                                    </div>
                                    <button type="submit" class="btn btn-warning">Edit</button>
                                </form>
                                </td>
                                <td>
                                    <form method="post" action="deleteLiveForm.php">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="id" value="'.$row["id"].'">
                                        </div>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                                </tr>';
                        $counter = $counter + 1;
                    }
                } else {
                    echo "0 results";
                } 
            ?>
                </tbody>
            </table>

            <a href="liveForm.php">
                <button type="button" class="btn btn-success">Add</button>
            </a>
        </div>
    </body>
</html>
