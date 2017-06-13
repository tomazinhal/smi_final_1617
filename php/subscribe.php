<?php

    session_start();
    
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");

    $query = "INSERT INTO `sub`(`user_id`, `event_id`, `notification`) VALUES (" . $_SESSION['userId'] . "," . $_SESSION['eventId'] . ", FALSE)";
    mysqli_query($linkIdentifier, $query);
    
    mysqli_close($linkIdentifier);
    header("Location:eventPage.php?eventId=" . $_SESSION["eventId"]);
?>
