<?php
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");

    $requests = array();
    $query = "SELECT `event`.`name`, `event`.`description`, `content`.`url`, `event`.`creation` FROM `event` INNER JOIN `content` ON `content`.`id` = `event`.`content_id`";
    $result = mysqli_query($linkIdentifier, $query);
    while ($temp = mysqli_fetch_array($result)) {
        $requests[] = $temp;
    }

    echo json_encode($requests, JSON_PRETTY_PRINT);
?>