<?php

    session_start();
    
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");

    $query = "DELETE FROM `subscription` WHERE `event_id`= " . $_SESSION['eventId'] . " AND `user_id` = " . $_SESSION['userId'];
    mysqli_query($linkIdentifier, $query);
    
    mysqli_close($linkIdentifier);
    header("Location:eventPage.php?eventId=" . $_SESSION["eventId"]);
?>
