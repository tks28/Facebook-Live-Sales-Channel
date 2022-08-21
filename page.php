<?php
    require "config.php";
    include('header.php');

    $_SESSION['posted'] = "true";

    if(isset($_SESSION['access_token'])){
        $id = $_SESSION['id'];
        $message = $_POST['message'];
        
        $data = array(
            'message' => $message
        );
        
        $res = $FBObject->get('/me/accounts', $_SESSION['access_token']);
        $res = $res->getDecodedBody();
        
        foreach($res['data'] as $page){
            if($page['id'] == $id){
                $accesstoken = $page['access_token'];
            }
        }
        
        $res = $FBObject->post($id . '/feed/', $data, $accesstoken);
        header('Location: index.php');
    }
?>