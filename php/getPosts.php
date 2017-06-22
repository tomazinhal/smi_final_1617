<?php
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");

    $requests = array();
    //select event.name as event_name, post.id as post_id, content.url, post.creation from post inner join content on content.id = post.content_id inner join event on event.id = post.event_id
    $query = "SELECT `event`.`name` as 'event_name', `post`.`id` as 'post_id', `content`.`url`, `post`.`creation` FROM `post` INNER JOIN `content` ON `content`.`id` = `post`.`content_id` INNER JOIN `event` ON `event`.`id` = `post`.`event_id`";
    $result = mysqli_query($linkIdentifier, $query);
    while ($temp = mysqli_fetch_array($result)) {
        $requests[] = $temp;
    }
    echo json_encode($requests, JSON_PRETTY_PRINT);
?>