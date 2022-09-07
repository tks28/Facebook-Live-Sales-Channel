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

<div class="container">
    <table class="table table-striped">                     
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Code</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
<?php
    $sql = "SELECT id, name, code, price, quantity FROM inventory";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $counter = 1;
        while($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td scope="row">' . $counter. '</td>
                    <td>' . $row["name"] .'</td>
                    <td> '.$row["code"] .'</td>
                    <td> '.$row["price"] .'</td>
                    <td> '.$row["quantity"] .'</td>
                    </tr>';
            $counter = $counter + 1;
        }
    } else {
        echo "0 results";
    } 
?>
        </tbody>
    </table>

    <a href="addItem.php">
        <button type="button" class="btn btn-success">Add</button>
    </a>
    <a href="editItem.php">
        <button type="button" class="btn btn-warning">Edit</button>
    </a>
    <a href="deleteItem.php">
        <button type="button" class="btn btn-danger">Delete</button>
    </a>
</div>