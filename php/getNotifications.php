<?php
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");

    $notifications = array();
    $query = "SELECT `subscription`.`event_id`, `event`.`name` FROM `subscription` INNER JOIN `event` ON `subscription`.`event_id` = `event`.`id` WHERE `subscription`.`user_id` = " . $_SESSION["userId"] . " AND `subscription`.`notification` = 1";
    $result = mysqli_query($linkIdentifier, $query);
    while ($temp = mysqli_fetch_array($result)) {
        $notifications[] = $temp;
    }

?>