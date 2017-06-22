<?php
    session_start();
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");

    if(isset($_POST["users"])){
        for($i = 0; $i < count($_POST["users"]); $i++){
            if($_POST["users"][$i][2] == "true"){
                $query = "DELETE FROM `subscripton`,`request` WHERE `subscription`.`user_id` = " . $_POST["users"][$i][0] . " AND `request`.`user_id` = " . $_POST["users"][$i][0];
                mysqli_query($linkIdentifier, $query);
                $query = "DELETE FROM `user` WHERE `id` = " . $_POST["users"][$i][0];
                mysqli_query($linkIdentifier, $query);
                
                if($_SESSION["userId"] == $_POST["users"][$i][0]){
                    unset($_SESSION);
                }
            }
            else{
                $query = "UPDATE `user` SET `role` = " . $_POST["users"][$i][1] . " WHERE `id` = ". $_POST["users"][$i][0];
                mysqli_query($linkIdentifier, $query);

                $query = "INSERT INTO `request`(`user_id`, `role`, `status`) VALUES (" . $_POST["users"][$i][0] . "," . $_POST["users"][$i][1] . ",'granted')";
                mysqli_query($linkIdentifier, $query);

                $query = "UPDATE `request` SET `role` = " . $_POST["users"][$i][1] . ", `status` = 'granted' WHERE `user_id` = ". $_POST["users"][$i][0];
                mysqli_query($linkIdentifier, $query);
            }
        }
    }

    mysqli_close($linkIdentifier);
?>
