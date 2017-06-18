<?php
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");

    $posts = array();
    $query = "SELECT * FROM `subscription` WHERE `event_id`= " . $_SESSION['eventId'] . " AND `user_id` = " . $_SESSION['userId'];
    $result = mysqli_query($linkIdentifier, $query);

    $numRows = mysqli_num_rows($result);
    if($numRows != 0) $isSubed = TRUE;
    else $isSubed = FALSE;
?>
