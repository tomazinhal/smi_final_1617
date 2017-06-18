<?php
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");

    $posts = array();
    if(isset($_POST["eventId"])){
        $query = "SELECT `url` FROM `event` INNER JOIN `post` ON `post`.`event_id` = `event`.`id` INNER JOIN `content` ON `post`.`content_id` = `content`.`id` WHERE `post`.`event_id` = " . $_POST["eventId"] . " LIMIT 9 OFFSET " . $_POST["numPosts"];
        $result = mysqli_query($linkIdentifier, $query);
        while ($eventData = mysqli_fetch_array($result)) {
            $posts[] = $eventData;
        }
    }
    echo json_encode($posts, JSON_PRETTY_PRINT);

?>
