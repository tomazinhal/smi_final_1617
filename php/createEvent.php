<?php
    require_once( "../Lib/lib.php" );
    
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");
    
    $name = webAppName();
    
    $method = $_SERVER['REQUEST_METHOD'];

    $serverName = $_SERVER['SERVER_NAME'];

    $serverPort = 80;
    print_r($_FILES);
    $thumbnail = $_FILES["thumbnail"];
    $type = explode( '/', $thumbnail["type"] )[0];
    print_r($type);
    if($type == "image"){
        $query = "INSERT INTO `event`(`name`, `description`, `type`, `thumbnail`) VALUES
                                ('" . $_POST["eventName"] . "','" . $_POST["description"] . "'," . 
                                $_POST["type"] . ", '')";

        mysqli_query($linkIdentifier, $query);
        $eventId = mysqli_insert_id($linkIdentifier);

        $query = "SELECT max(id) FROM `post`";
        $result = mysqli_query($linkIdentifier, $query);
        $lastId = mysqli_fetch_array($result);
        $lastId = $lastId[0] + 1;
        $thumbnail = $_FILES["thumbnail"];
        $directory = "Content/" . $lastId . ".png";
        imagepng(imagecreatefromstring(file_get_contents($thumbnail["tmp_name"])), "../" . $directory);

        $query = "UPDATE `event` SET `thumbnail`='" . $directory . "' WHERE `id` = " . $eventId;
        mysqli_query($linkIdentifier, $query);
        
        mysqli_free_result($result);
        mysqli_Close($linkIdentifier);

        $baseUrl = "http://" . $serverName . ":" . $serverPort;
        $newbase="eventPage.php?eventId=" . $eventId;
        $baseNextUrl = $baseUrl . $name . $newbase;

        header("location:" . $baseNextUrl);
    }
    else{
        header("location:eventFailed.php");
    }
    
?>