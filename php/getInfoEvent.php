<?php
    require_once( "../Lib/lib.php" );
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");
    
    $name = webAppName();
    
    $method = $_SERVER['REQUEST_METHOD'];

    $serverName = $_SERVER['SERVER_NAME'];

    $serverPort = 80;
    
    $events = array();
    if(isset($_POST["eventId"])){

        $query = "SELECT * FROM `smi_final`.`event` WHERE `id` = " . $_POST["eventId"];
        $result = mysqli_query($linkIdentifier, $query);
        $eventData = mysqli_fetch_array($result);

    }
    echo json_encode($eventData, JSON_PRETTY_PRINT);
?>