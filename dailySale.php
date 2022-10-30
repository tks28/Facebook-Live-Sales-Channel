<?php
	session_start();
    $_SESSION['posted'] = "false";
    include('header.php');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "facebook";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $itemName = array();
    $itemPrice = array();
    $dataPoints = array();
    $day = date("d");

    if(isset($_POST["graphType"])){
        $graphType = $_POST["graphType"];
    }
    else{
        $graphType = "column";
    }


    $sql = "SELECT code FROM inventory";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($itemName, $row["code"]);
        }
    }

    foreach($itemName as $item){
        $price = 0;
        $sql = "SELECT item, price FROM orders WHERE DAY(date) = $day";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row["item"] == $item){
                    $price = $price + $row["price"];
                }
            }
        }
        array_push($itemPrice, $price);
    }

    $counter = 0;
    while($counter < count($itemName)){
        array_push($dataPoints, array("label"=> $itemName[$counter], "y"=>$itemPrice[$counter]));
        $counter++;
    }
?>

<!doctype html>
<html lang="en">
    <script>
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light2",
                title:{
                    text: "Daily Item Sales Chart"
                },
                axisY:{
                    includeZero: true
                },
                data: [{
                    type: "<?php echo $graphType; ?>",
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",   
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
        chart.render();
        }
    </script>
    <style>
        .container {
            text-align: center;
        }
    </style>
    <body>
        <div class="container" style="margin-top: 50px">
            <h3>Change Graph Type</h3>
            <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <form method="POST" action="monthlySale.php">
                                <input type="hidden" name="graphType" value="column">
                                <button type="submit" class="btn btn-success">Bar Graph</button>
                            </form>
                        </tr>
                        <tr>
                            <form method="POST" action="monthlySale.php">
                                <input type="hidden" name="graphType" value="pie">
                                <button type="submit" class="btn btn-success">Pie Chart</button>
                            </form>
                        </tr>
                        <tr>
                            <form method="POST" action="monthlySale.php">
                                <input type="hidden" name="graphType" value="line">
                                <button type="submit" class="btn btn-success">Line Graph</button>
                            </form>
                        </tr>
                    </tbody>
                </table> 
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>    
                <table class="table" style="margin-top: 50px">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Item Code</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $counter = 0;
                            while($counter < count($itemName)){
                                echo'<tr>
                                        <td>'.$counter+"1".'</td>
                                        <td>'.$itemName[$counter].'</td>
                                        <td>'.$itemPrice[$counter].'</td>
                                </tr>';
                                $counter++;
                            }
                        ?>
                    </tbody>
                </table>
        </div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </body>
</html>