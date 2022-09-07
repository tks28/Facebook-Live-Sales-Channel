<?php
	session_start();
  $_SESSION['posted'] = "false";
  include('header.php');

  $counter = 1;
  $link = $_POST["link"];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Live</title>
  </head>
  <body>
    <p align="center">
      <?php echo $link; ?>
    </p>
    <div class="container text-center">
      <div class="row">
        <div class="col border">
          Item
        </div>
        <div class="col border">
          Status
        </div>
      </div>
      <?php
         $link = $_POST["link"];
         if(!empty($_POST["items"])){
           foreach($_POST["items"] as $item){
             echo '<div class="row">
                    <div class="col border">'
                  .$item.
                  '</div>
                  <div class="col border">
                  <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio'.$counter.'">
                    <label class="btn btn-outline-success" for="btnradio'.$counter.'">Select</label>';
                      $counter = $counter +1;
                    echo'<input type="radio" class="btn-check" name="btnradio" id="btnradio'.$counter.'">
                    <label class="btn btn-outline-danger" for="btnradio'.$counter.'">Remove</label>
                  </div>
                </div>
                </div>';
                $counter = $counter + 1; 
           }
         }
      ?>
  </body>
</html>