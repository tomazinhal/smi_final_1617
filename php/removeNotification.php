<?php

    session_start();

    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");
    print_r($_GET["eventId"]);

    $query = "UPDATE `subscription` SET `notification` = 0 WHERE `event_id` = " . $_GET['eventId'] . " AND `user_id` = " . $_SESSION["userId"];
        mysqli_query($linkIdentifier, $query);
    
    mysqli_close($linkIdentifier);
    header("Location:eventPage.php?eventId=" . $_GET["eventId"]);
?>
