<?php
    require_once( "../Lib/lib.php" );
    
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");
    
    $name = webAppName();
    
    $method = $_SERVER['REQUEST_METHOD'];

    $serverName = $_SERVER['SERVER_NAME'];

    $serverPort = 80;

    $query = "INSERT INTO `event`(`name`, `description`, `type`) VALUES
                             ('" . $_POST["eventName"] . "','" . $_POST["description"] . "'," . 
                             $_POST["type"] . ")";

    mysqli_query($linkIdentifier, $query);

    $query = "SELECT `id` FROM `event` WHERE `name`='" . $_POST["eventName"] . "'";
    $result = mysqli_query($linkIdentifier, $query);

    $numRows = mysqli_num_rows($result);

    if ($numRows == 1) {
        $userData = mysqli_fetch_array($result);
        $eventId = $userData['id'];
        printf($eventId);
        mysqli_free_result($result);
        mysqli_Close($linkIdentifier);

        $baseUrl = "http://" . $serverName . ":" . $serverPort;
        $newbase="eventPage.php?eventId=" . $eventId;
        $baseNextUrl = $baseUrl . $name . $newbase;

        header("location:" . $baseNextUrl);
    }
    
?>