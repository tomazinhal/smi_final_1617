<?php
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");

    $requests = array();
    $query = "SELECT `user`.`name`, `user`.`id`, `user`.`role`, `request`.`role`, `request`.`status` FROM `request` INNER JOIN `user` ON `request`.`user_id` = `user`.`id` WHERE `request`.`status` = 'processing'";
    $result = mysqli_query($linkIdentifier, $query);
    while ($temp = mysqli_fetch_array($result)) {
        $requests[] = $temp;
    }

    echo json_encode($requests, JSON_PRETTY_PRINT);
?>