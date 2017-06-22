<?php

    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");
    if(isset($_POST["events"])){
        for($i = 0; $i < count($_POST["events"]); $i++){
            $query = "DELETE FROM event WHERE name = '" . $_POST["events"][$i][0] . "'";
            mysqli_query($linkIdentifier, $query);
        }
    }
    mysqli_close($linkIdentifier);
?>
