<?php
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");
    if(isset($_POST["eventId"])){
        $query = "SELECT * FROM `smi_final`.`event` INNER JOIN `content` ON `event`.`content_id` = `content`.`id` WHERE `event`.`id` = " . $_POST["eventId"];
        $result = mysqli_query($linkIdentifier, $query);
        $eventData = mysqli_fetch_array($result);
    }
    echo json_encode($eventData, JSON_PRETTY_PRINT);
?>