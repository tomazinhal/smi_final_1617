<?php
    require_once( "../Lib/lib.php" );
    
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");
    
    $name = webAppName();
    
    $method = $_SERVER['REQUEST_METHOD'];

    $serverName = $_SERVER['SERVER_NAME'];

    $serverPort = 80;
    $content = $_FILES["content"];
    
    include_once("sendFile.php"); 

    print_r($files);
    print_r($ids);

    for ($i = 0; $i < count($files["content"]); $i++) {
    
        $type = explode( '/', $content["type"] )[0];

        print_r($type);
        if($type == "image" || $type == "video"){
            include_once("sendFile.php");

            $query = "INSERT INTO `post`(`user_id`, `event_id`, `content_id`) VALUES (" . $_POST['userId'] . "," . $_POST['eventId'] . ",". $ids[$i] . ")";
            mysqli_query($linkIdentifier, $query);

            header("location:eventPage.php?eventId=" . $_POST["eventId"]);
        }
        else{
            header("location:eventFailed.php");
        }


    }
/*
    
    */
?>