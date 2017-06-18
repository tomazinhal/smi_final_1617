<?php
    require_once( "../Lib/lib.php" );
    
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");
    
    $name = webAppName();
    
    $method = $_SERVER['REQUEST_METHOD'];

    $serverName = $_SERVER['SERVER_NAME'];

    $serverPort = 80;
    
    $baseUrl = "http://" . $serverName . ":" . $serverPort;
    $newbase="/verify.php";
    $baseNextUrl = $baseUrl . $name . $newbase;

    if ($method == 'POST') {
        $args = $_POST;
    } elseif ($method == 'GET') {
        $args = $_GET;
    } else {
        $args = null;

        echo "Invalid HTTP method (" . $method . ")";
        exit();
    }

    $refreshtime = 5;

    if (isset($args['username'])) {
        $name = $args['username'];
    } else {
        $name = null;
    }

    if (isset($args["email"])) {
        $email = $args["email"];
    } else {
        $email = null;
    }
    
    if (isset($args["password"])) {
        $password = $args["password"];
    } else {
        $password = null;
    }
    
    $query = "INSERT INTO `user`(name, password, email, role) values('".$name."','".$password."','".$email."'," . 0 .")";
    mysqli_query($linkIdentifier, $query);
    
    
    
    $to      = $email; // Send email to our user
    $subject = 'Signup | Verification'; // Give the email a subject 
    $message = '
 
    Thanks for signing up!
    Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
    ------------------------
    Username: '.$name.'
    ------------------------
 
    Please click this link to activate your account:
    ' . $baseNextUrl . '?email='.$email.'
        
    '; // Our message above including the link
                     
    $headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
    mail($to, $subject, $message, $headers); // Send our email

    mysqli_close($linkIdentifier);

    header("location:mainPage.php");
