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
    <div class="container">
        <form method="post" action="page.php">
            <div class="form-group col-md-6">
                <label for="message">Post to Facebook</label>
                <textarea type="text" class="form-control" name="message" placeholder="Enter Message" rows="3"></textarea>
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

