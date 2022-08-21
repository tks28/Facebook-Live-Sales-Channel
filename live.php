<?php
	session_start();
  $_SESSION['posted'] = "false";
  include('header.php');
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
      <div class='sk-ww-facebook-live-video' data-embed-id='87553'></div><script src='https://widgets.sociablekit.com/facebook-live-video/widget.js' async defer></script>
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
      <div class="row">
        <div class="col border">
          Item A
        </div>
        <div class="col border">
          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio1">
            <label class="btn btn-outline-success" for="btnradio1">Select</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio2">
            <label class="btn btn-outline-danger" for="btnradio2">Remove</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col border">
          Item B
        </div>
        <div class="col border">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio3">
            <label class="btn btn-outline-success" for="btnradio3">Select</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio4">
            <label class="btn btn-outline-danger" for="btnradio4">Remove</label>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>