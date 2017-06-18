<?php
    require_once( "../Lib/lib.php" );
    
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");
    
    $name = webAppName();
    
    $method = $_SERVER['REQUEST_METHOD'];

    $serverName = $_SERVER['SERVER_NAME'];

    $serverPort = 80;
    
    $baseUrl = "http://" . $serverName . ":" . $serverPort;

    if(isValid($_POST["username"], $_POST["password"]) != null){
        $userData = isValid($_POST["username"], $_POST["password"]);
        session_start();
        $_SESSION["userId"] = $userData["id"];
        $_SESSION["username"] = $userData["username"];
        $newbase="/mainPage.php";
        $baseNextUrl = $baseUrl . $name . $newbase;
        header("Location:".$baseNextUrl); 
        //redirectToLastPage("", 0);   
    }
    else{
        $newbase="/loginFrame.php";
        $baseNextUrl = $baseUrl . $name . $newbase;
        header("Location:".$baseNextUrl);
        //redirectToLastPage("", 0);  
    }
?>