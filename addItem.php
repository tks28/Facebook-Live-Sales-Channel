<?php
	session_start();
    $_SESSION['posted'] = "false";
    include('header.php');
?>

<!doctype html>
<html lang="en">
    <body>
        <div class="container" style="margin-top: 50px">
            <h1 style="text-align:center">Add New Item</h1>
            <form method="post" action="add.php">
                <div class="form-group">
                    <label for="name">Item name</label>
                    <input type="text" class="form-control" name="itemName" placeholder="Enter item name">
                </div>
                <div class="form-group">
                    <label for="code">Item code</label>
                    <input type="text" class="form-control" name="itemCode" placeholder="Enter item code">
                </div>
                <div class="form-group">
                    <label for="price">Item price (RM)</label>
                    <input type="number" min="1" class="form-control" name="itemPrice" placeholder="Enter item price">
                </div>
                <div class="form-group">
                    <label for="quantity">Item quantity</label>
                    <input type="number" min="1" class="form-control" name="itemQuantity" placeholder="Enter item quantity">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
       
    </body>
</html>

