<?php
    $_SESSION['posted'] = "false";
    include('header.php');
    require_once("config.php");

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
        <div class="container" style="margin-top: 50px">
            <h1>Order</h1>
            <table class="table table-striped">                     
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Date (Y/M/D)</th>
                        <th>Live ID</th>
                        <th>Item</th>
                        <th>Price (RM)</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM orders";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $counter = 1;
                        while($row = $result->fetch_assoc()) {
                            echo '<tr>
                                    <td scope="row">' . $counter. '</td>
                                    <td>' . $row["fbName"] .'</td>
                                    <td>' . $row["date"]. '</td>
                                    <td> '.$row["live"] .'</td>
                                    <td> '.$row["item"] .'</td>
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
        </div>
    </body>
</html>