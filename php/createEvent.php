<?php
    require_once( "../Lib/lib.php" );
    
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");
    
    $name = webAppName();
    $method = $_SERVER['REQUEST_METHOD'];
    $serverName = $_SERVER['SERVER_NAME'];
    $serverPort = 80;
    
    $thumbnail = $_FILES["content"];
    $type = explode( '/', $thumbnail["type"][0])[0];
    if($type == "image"){

        include_once("sendFile.php");    

        $query = "INSERT INTO `event` (`name`, `description`, `type`, `content_id`) VALUES ('" . $_POST["eventName"] . "','" . $_POST["description"] . "'," . $_POST["type"]  ."," . $ids[0] . ")";
        mysqli_query($linkIdentifier, $query);
        
        $eventId = mysqli_insert_id($linkIdentifier);
        
        $baseUrl = "http://" . $serverName . ":" . $serverPort;
        $newbase="eventPage.php?eventId=" . $eventId;
        $baseNextUrl = $baseUrl . $name . $newbase;
        header("location:" . $baseNextUrl);
    }
    else{
        header("location:eventFailed.php");
    }
    
?>