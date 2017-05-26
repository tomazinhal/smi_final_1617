<?php
    require_once( "../Lib/lib.php" );
    
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");
    
    $name = webAppName();
    
    $method = $_SERVER['REQUEST_METHOD'];

    $serverName = $_SERVER['SERVER_NAME'];

    $serverPort = 80;
    
    $baseUrl = "http://" . $serverName . ":" . $serverPort;
    $newbase="/mainPage.php";
    $baseNextUrl = $baseUrl . $name . $newbase;

    if(isValid($_POST["username"], $_POST["password"]) != null){
        $id = isValid($_POST["username"], $_POST["password"]);
        session_start();
        $_SESSION["userId"] = $id;
        header("location:mainPage.php");    
    }
    else{
        header("location:loginFrame.php");
    }
?>