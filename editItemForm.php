<?php
    require "config.php";
    include('header.php');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "facebook";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $code = $_POST['itemCode'];

    $sql = "SELECT name, code, price, quantity FROM inventory WHERE code='$code'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $name = $row["name"];
            $quantity = $row["quantity"];
            $price = $row["price"];
            $oldCode = $row["code"];
        }
    }
?>

<!doctype html>
<html lang="en">
    <style>
        h1 {
            text-align: center;
        }
    </style>
    <script src="validation.js"></script>
    <body>
        <div class="container" style="margin-top: 50px">
            <h1>Edit Item for <?php echo $code ?></h1>
            <form method="post" action="editItem.php" class="needs-validation"  novalidate="">
                <input name='oldCode' type='hidden' value='<?php echo $oldCode ?>'>
                <div class="form-group">
                    <label for="name">Item name</label>
                    <input type="text" class="form-control" name="itemName" placeholder="Enter item name" value="<?php echo $name ?>" required>
                    <div class="invalid-feedback"> Valid name is required. </div>
                </div>
                <div class="form-group">
                    <label for="code">Item code</label>
                    <input type="text" class="form-control" name="itemCode" placeholder="Enter item code" value="<?php echo $code ?>" required>
                    <div class="invalid-feedback"> Valid code is required. </div>
                </div>
                <div class="form-group">
                    <label for="price">Item price (RM)</label>
                    <input type="number" min="1" class="form-control" name="itemPrice" placeholder="Enter item price" value="<?php echo $price ?>" required>
                    <div class="invalid-feedback"> Valid price is required. </div>
                </div>
                <div class="form-group">
                    <label for="quantity">Item quantity</label>
                    <input type="number" min="1" class="form-control" name="itemQuantity" placeholder="Enter item quantity" value="<?php echo $quantity ?>" required>
                    <div class="invalid-feedback"> Valid quantity is required. </div>
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
       
    </body>
</html>