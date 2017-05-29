<?php
    require_once( "../Lib/lib.php" );
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");
    
    $name = webAppName();
    
    $method = $_SERVER['REQUEST_METHOD'];

    $serverName = $_SERVER['SERVER_NAME'];

    $serverPort = 80;
    
    $baseUrl = "http://" . $serverName . ":" . $serverPort;
    $newbase="/mainPage.php";
    $baseNextUrl = $baseUrl . $name . $newbase;

    if(isset($_SESSION["numEvents"])){

        $query = "SELECT * FROM `smi_final`.`event` LIMIT 12 OFFSET " . $_SESSION["numEvents"];
        $result = mysqli_query($linkIdentifier, $query);
        $events = array();
        while ($eventData = mysqli_fetch_array($result)) {
            $events[] = $eventData;
        }

        $_SESSION["events"] = $events;
    }
    return $events;
?>