<?php

    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");

    $query = "SELECT `role` FROM `user` WHERE `id` = " . $_SESSION["userId"];
    $result = mysqli_query($linkIdentifier, $query);
    $userRole = mysqli_fetch_array($result)[0];
    
    $query = "SELECT * FROM `role` WHERE `id` != 0 AND `id` != " . $userRole;
    $result = mysqli_query($linkIdentifier, $query);
        while ($role = mysqli_fetch_array($result)) {
            $roles[] = $role;
        }

    mysqli_close($linkIdentifier);
?>
