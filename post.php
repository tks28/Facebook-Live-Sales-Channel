<?php
    require "config.php";
    include('header.php');

    if(!isset($_SESSION['access_token'])){
        header("Location: login.php");
        exit();
    }
    else{
        try{
            $res = $FBObject->get('/me/accounts', $_SESSION['access_token']);
            $res = $res->getDecodedBody();

            foreach($res['data'] as $page){
                if($page['name'] == "Test"){
                    $_SESSION['id'] = $page['id'];
                }
            }

?>
     <style>
        h1, h2, form {
            text-align: center;
        }
    </style>
    <script src="validation.js"></script>


    <div class="container" style="margin-top: 50px">
        <h1>Post to Facebook Page</h1>
        <form method="post" action="page.php" class="needs-validation"  novalidate="">
            <div class="form-group">
                <textarea type="text" class="form-control" name="message" placeholder="Enter Message" rows="3" required></textarea>
                <div class="invalid-feedback"> Please enter a message. </div>
            </div>
            </br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
    
    
<?php
    }catch(Facebook\Exceptions\FacebookSDKException $e){
        echo $e->getMessage();
        exit;
    }
}
?>

