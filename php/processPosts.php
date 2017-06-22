<?php

    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");
    if(isset($_POST["posts"])){
        for($i = 0; $i < count($_POST["posts"]); $i++){
            $query = "DELETE FROM post WHERE id = " . $_POST["posts"][$i][0];
            mysqli_query($linkIdentifier, $query);
        }
    }

    mysqli_close($linkIdentifier);
?>
