<?php
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");

    $eventTypes = array();
    
    $query = "SELECT * FROM `type`";
    $result = mysqli_query($linkIdentifier, $query);
    while ($eventData = mysqli_fetch_array($result)) {
        $eventTypes[] = $eventData;
    }
?>