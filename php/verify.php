<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>SMI Autenticado</title>
</head>
<body>
    <div id="wrap">
        <?php
            require_once( "../Lib/lib.php" );
        
            $email = $_GET['email'];
            
            $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
            mysqli_select_db($linkIdentifier, "smi_final");

            $query = "UPDATE `user` SET role='1' WHERE email='".$email."'";
            mysqli_query($linkIdentifier, $query);
            
            $query = "SELECT `id` FROM `user` WHERE email='" . $email . "'";
            $result = mysqli_query($linkIdentifier, $query);
            $id = mysqli_fetch_array($result)[0];

            $query = "INSERT INTO `request`(`user_id`, `role`, `status`) VALUES ( $id , 1 ,'granted')";
            mysqli_query($linkIdentifier, $query);

            echo '<div>Your account has been activated, you can now login</div>';
            
            mysqli_close($linkIdentifier);
        ?>

    </div>
</body>
</html>