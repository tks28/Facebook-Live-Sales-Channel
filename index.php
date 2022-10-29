<?php
	session_start();

	include('header.php');

	if(!isset($_SESSION['access_token'])){
		header("Location: login.php");
		exit();
	}

	if($_SESSION['posted'] == "true"){
		echo '<script>alert("Post have been sucessful")</script>';
        unset($_SESSION['posted']);
	}

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "facebook";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $dataPoints = array(
        array("x"=> 10, "y"=> 41),
        array("x"=> 20, "y"=> 35),
        array("x"=> 30, "y"=> 50),
        array("x"=> 40, "y"=> 45),
        array("x"=> 50, "y"=> 52),
        array("x"=> 60, "y"=> 68),
        array("x"=> 70, "y"=> 38),
        array("x"=> 80, "y"=> 71),
        array("x"=> 90, "y"=> 52),
        array("x"=> 100, "y"=> 60),
        array("x"=> 110, "y"=> 36),
        array("x"=> 120, "y"=> 49),
        array("x"=> 130, "y"=> 41)
    );

    $month = date("m");
    $day = date("d");
    $monthlySale = "0";
    $dailySale =  "0";
    $monthlyOrder = "0";

    $sql = "SELECT price FROM orders WHERE MONTH(date) = $month";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $monthlySale = $monthlySale + $row["price"];
            $monthlyOrder++;
        }
    } else {
        $monthlySale = "0";
        $monthlyOrder = "0";
    }
    
    $sql = "SELECT price FROM orders WHERE DAY(date) = $day";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $dailySale = $dailySale + $row["price"];
        }
    } else {
        $dailySale = "0";
    } 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        
        <script>
            window.onload = function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    exportEnabled: true,
                    theme: "light1", // "light1", "light2", "dark1", "dark2"
                    title:{
                        text: "Sales Chart"
                    },
                    axisY:{
                        includeZero: true
                    },
                    data: [{
                        type: "column", //change type to bar, line, area, pie, etc
                        //indexLabel: "{y}", //Shows y value on all Data Points
                        indexLabelFontColor: "#5A5757",
                        indexLabelPlacement: "outside",   
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }]
                });
            chart.render();
            }
        </script>
    </head>
    <body>
        <div class="container" style="margin-top: 50px">
            <div class="row justify-content-center" style="margin-bottom: 50px">
                <div class="col-md-3">
                    <img src="<?php echo $_SESSION['userData']['picture']['url'] ?>">
                </div>
                <div class="col-md-5">
                    <h1>Welcome <?php echo $_SESSION['userData']['first_name']?> <?php echo $_SESSION['userData']['last_name'] ?></h1>
                </div>
            </div>
            <div class="row justify-content-center" style="margin-bottom: 50px">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header">Monthly Sale</div>
                        <div class="card-body">
                            <h5 class="card-title">RM<?php echo $monthlySale; ?></h5>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#monthlySaleModal">See More</button>

                            <div class="modal fade" id="monthlySaleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg text-black">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Monthly Sale</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header">Monthly Order</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $monthlyOrder ?></h5>
                            <a href="#" class="btn btn-danger">See More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header">Daily Sale</div>
                        <div class="card-body">
                            <h5 class="card-title">RM<?php echo $dailySale; ?></h5>
                            <a href="#" class="btn btn-danger">See More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        </div>
    </body>
</html>