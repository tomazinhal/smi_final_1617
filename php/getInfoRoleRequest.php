<?php
    session_start();

    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");
    $infoRoleRequest = array();
    if(isset($_SESSION["userId"])){
        //$query = "SELECT * FROM `request` WHERE `user_id` = " . $_SESSION["userId"];
        $query = "SELECT `role`.`name`, `request`.`status` FROM `request` INNER JOIN `role` ON `role`.`id` = `request`.`role` WHERE `request`.`user_id` = " . $_SESSION["userId"];
        
        $result = mysqli_query($linkIdentifier, $query);
        $infoRoleRequest = mysqli_fetch_array($result);
    }
    echo json_encode($infoRoleRequest, JSON_PRETTY_PRINT);
?>