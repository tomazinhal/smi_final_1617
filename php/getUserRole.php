<?php
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");

    $query = "SELECT `role` FROM `user` WHERE `id` = " . $_SESSION["userId"];
    $result = mysqli_query($linkIdentifier, $query);
    $role = mysqli_fetch_array($result)[0];
    if($role == null) unset($_SESSION);
    else $_SESSION["userRole"] = $role;
?>