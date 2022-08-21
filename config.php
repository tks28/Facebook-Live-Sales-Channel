<?php
    session_start();
    require_once('Facebook/autoload.php');

    $FBObject = new \Facebook\Facebook([
        'app_id' => '612354393280305',
        'app_secret' => '22fd6c48b010f5c60f1eb7eca2628772',
        'default_graph_version' => 'v2.10'
    ]);

    $handler = $FBObject -> getRedirectLoginHelper();
?>