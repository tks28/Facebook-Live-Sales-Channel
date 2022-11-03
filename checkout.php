<?php
	session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "facebook";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $fbID = $_GET['fbID'];
    $liveID = $_GET['liveID'];
    $total = 0;

    $host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    if($host == 'localhost/Test/checkout.php?paymentMethod=on') 
    {
        header('Location: checkoutSuccessful.php');
    }

?>
<!doctype html>
<html lang="en">
    <style>
        h1, h2 {
            text-align: center;
        }
    </style>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">ETCM</a>
            </div>
        </nav>
        <script>
            (function () {
                window.addEventListener('load', function () {
                    var forms = document.getElementsByClassName('needs-validation')

                    Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                        event.preventDefault()
                        event.stopPropagation()
                        } 

                        form.classList.add('was-validated')
                    }, false)
                    })
                }, false)
                }())
        </script>
        <div class="container">
            <div class="py-5 text-center">
                <h2>Checkout form</h2>
            </div>
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                    </h4>
                    <ul class="list-group mb-3 sticky-top">
                        <?php
                            $sql = "SELECT item, price, quantity FROM orders WHERE fbID='$fbID' AND live='$liveID'";
                            $result = $conn->query($sql);
                        
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    echo'<li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>';
                                    $sql = "SELECT name FROM inventory WHERE code='$row[item]'";
                                    $temp = $conn->query($sql);
                                    $name = $temp->fetch_assoc();
                                    echo'       <h6 class="my-0">'.$name['name'].' x'.$row["quantity"].'</h6>
                                            </div>
                                            <span class="text-muted">RM'.$row["price"].'</span>
                                        </li>';
                                    $total = $total + $row["price"];
                                }
                            }
                        ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (RM)</span>
                            <strong>RM<?php echo"$total"; ?></strong>
                        </li>
                    </ul>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Billing address</h4>
                    <form class="needs-validation" novalidate="">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">First name</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                                <div class="invalid-feedback"> Valid first name is required. </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Last name</label>
                                <input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
                                <div class="invalid-feedback"> Valid last name is required. </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="text" class="form-control" id="username" placeholder="Username" required="">
                                <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email <span class="text-muted">(Optional)</span></label>
                            <input type="email" class="form-control" id="email" placeholder="you@example.com">
                            <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                        </div>
                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
                            <div class="invalid-feedback"> Please enter your shipping address. </div>
                        </div>
                        <div class="mb-3">
                            <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                            <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                        </div>
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="country">Country</label>
                                <select class="custom-select d-block w-100" id="country" required="">
                                    <option value="">Choose...</option>
                                    <option>Malaysia</option>
                                </select>
                                <div class="invalid-feedback"> Please select a valid country. </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="state">State</label>
                                <select class="custom-select d-block w-100" id="state" required="">
                                    <option value="">Choose...</option>
                                    <option>Johor</option>
                                    <option>Kedah</option>
                                    <option>Kelantan</option>
                                    <option>Malacca</option>
                                    <option>Negeri Sembilan</option>
                                    <option>Pahang</option>
                                    <option>Penang</option>
                                    <option>Perak</option>
                                    <option>Perlis</option>
                                    <option>Sabah</option>
                                    <option>Sarawak</option>
                                    <option>Selangor</option>
                                    <option>Terengganu</option>
                                </select>
                                <div class="invalid-feedback"> Please provide a valid state. </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="zip">Zip</label>
                                <input type="text" class="form-control" id="zip" placeholder="" required="">
                                <div class="invalid-feedback"> Zip code required. </div>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <h4 class="mb-3">Payment</h4>
                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
                                <label class="custom-control-label" for="credit">Credit card</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
                                <label class="custom-control-label" for="debit">Debit card</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback"> Name on card is required </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cc-number">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                                <div class="invalid-feedback"> Credit card number is required </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                                <div class="invalid-feedback"> Expiration date required </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cc-cvv">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                                <div class="invalid-feedback"> Security code required </div>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <a href="index.php">
                            <button class="btn btn-primary btn-lg btn-block" type="submit" href="index.php">Continue to checkout</button>
                        </a>
                        <!-- <a href="index.php" class="btn btn-primary btn-lg btn-block" type="submit" role="button">Continue to checkout</a> -->
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>