<?php
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");

    $events = array();
    if(isset($_POST["numEvents"])){
        if($_POST["eventType"] != -1){
            $query = "SELECT `event`.*, `content`.`url` FROM `event` INNER JOIN `content` ON `event`.`content_id` = `content`.`id` WHERE `event`.`type`=" . $_POST["eventType"] . "LIMIT 9 OFFSET " . $_POST["numEvents"];
        }
        else{
            $query = "SELECT `event`.*, `content`.`url` FROM `event` INNER JOIN `content` ON `event`.`content_id` = `content`.`id` LIMIT 9 OFFSET " . $_POST["numEvents"];
        }
        $result = mysqli_query($linkIdentifier, $query);
        while ($eventData = mysqli_fetch_array($result)) {
            $events[] = $eventData;
        }
    }
    echo json_encode($events, JSON_PRETTY_PRINT);
?>