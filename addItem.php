<?php
	session_start();
    $_SESSION['posted'] = "false";
    include('header.php');
?>

<!doctype html>
<html lang="en">
    <script src="validation.js"></script>
    <body>
        <div class="container" style="margin-top: 50px">
            <h1 style="text-align:center">Add New Item</h1>
            <form method="POST" action="add.php" class="needs-validation"  novalidate="">
                <div class="form-group">
                    <label for="name">Item name</label>
                    <input type="text" class="form-control" name="itemName" placeholder="Enter item name" required>
                    <div class="invalid-feedback"> Valid name is required. </div>
                </div>
                <div class="form-group">
                    <label for="code">Item code</label>
                    <input type="text" class="form-control" name="itemCode" placeholder="Enter item code" required>
                    <div class="invalid-feedback"> Valid code is required. </div>
                </div>
                <div class="form-group">
                    <label for="price">Item price (RM)</label>
                    <input type="number" min="1" class="form-control" name="itemPrice" placeholder="Enter item price" required>
                    <div class="invalid-feedback"> Valid price is required. </div>
                </div>
                <div class="form-group">
                    <label for="quantity">Item quantity</label>
                    <input type="number" min="1" class="form-control" name="itemQuantity" placeholder="Enter item quantity" required>
                    <div class="invalid-feedback"> Valid quantity is required. </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
       
    </body>
</html>

