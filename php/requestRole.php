<?php
    session_start();

    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");

    $query = "INSERT INTO `request`(`user_id`, `role`, `status`) VALUES (" . $_SESSION['userId'] . "," . $_POST["role"] . ",'processing')";
    $result = mysqli_query($linkIdentifier, $query);

    $query = "UPDATE `request` SET `role` = " . $_POST['role'] . ", `status` = 'processing' WHERE `user_id` = ". $_SESSION['userId'];
    $result = mysqli_query($linkIdentifier, $query);
    
    mysqli_close($linkIdentifier);
    header("Location:mainpage.php");
?>
