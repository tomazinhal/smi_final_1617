<?php

    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");
    if(isset($_POST["requests"])){
        for($i = 0; $i < count($_POST["requests"]); $i++){
            if($_POST["requests"][$i][3] == "true"){
                $query = "UPDATE `user`,`request` SET `user`.`role` = " . $_POST["requests"][$i][2] . ", `request`.`status` = 'granted' WHERE `request`.`user_id` = ". $_POST["requests"][$i][0] . " AND `user`.`id` = " . $_POST["requests"][$i][0];
                mysqli_query($linkIdentifier, $query);
            }
            else{
                $query = "UPDATE `request` SET `request`.`status` = 'deny' WHERE `request`.`user_id` = ". $_POST["requests"][$i][0];
                mysqli_query($linkIdentifier, $query);
            }
        }
    }

    mysqli_close($linkIdentifier);
?>
