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
    <iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2F100083843887168%2Fvideos%2F375779884573268%2F&width=1280" width="1280" height="720" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>    </p>
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