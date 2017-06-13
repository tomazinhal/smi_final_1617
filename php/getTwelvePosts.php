<?php
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");

    $posts = array();
    if(isset($_POST["eventId"])){

        $query = "SELECT `content` FROM `smi_final`.`post` WHERE `event_id`= " . $_POST['eventId'] . " LIMIT 12 OFFSET " . $_POST['numPosts'];
        $result = mysqli_query($linkIdentifier, $query);
        while ($eventData = mysqli_fetch_array($result)) {
            $posts[] = $eventData;
        }
    }
    echo json_encode($posts, JSON_PRETTY_PRINT);

?>
