<?php
	session_start();
    $_SESSION['posted'] = "false";
    include('header.php');

?>

<!doctype html>
<html lang="en">
    <style>
        h1 {
            text-align: center;
        }
    </style>
    <body>
        <div class="container">
            <h1>Please enter the Facebook Live embed link</h1>
            <form method="post" action="live.php">
                <div class="form-group">
                    <label for="link">Embed Link</label>
                    <input type="text" class="form-control" name="link" placeholder="Enter Facebook Live Embed Link">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
        
    </body>
</html>
