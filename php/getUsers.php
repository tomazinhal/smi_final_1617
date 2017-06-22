<?php
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");

    $users = array();
    $query = "SELECT `id`, `name`, `role` FROM `user`";
    $result = mysqli_query($linkIdentifier, $query);
    while ($temp = mysqli_fetch_array($result)) {
        $users[] = $temp;
    }

    echo json_encode($users, JSON_PRETTY_PRINT);
?>