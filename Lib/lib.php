<?php

function getBrowser() {
    $userBrowser = '';
    /*
      foreach( $_SERVER as $key => $value) {
      echo $key . "=>" . $value . "<br>\n";
      }
      exit(0);
     */

    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    //echo $userAgent;

    if (preg_match('/Trident/i', $userAgent)) {
        $userBrowser = "Internet Explorer";
    } elseif (preg_match('/MSIE/i', $userAgent)) {
        $userBrowser = "Internet Explorer";
    } elseif (preg_match('/Firefox/i', $userAgent)) {
        $userBrowser = "Mozilla Firefox";
    } elseif (preg_match('/Safari/i', $userAgent)) {
        $userBrowser = "Apple Safari";
    } elseif (preg_match('/Chrome/i', $userAgent)) {
        $userBrowser = "Google Chrome";
    } elseif (preg_match('/Flock/i', $userAgent)) {
        $userBrowser = "Flock";
    } elseif (preg_match('/Opera/i', $userAgent)) {
        $userBrowser = "Opera";
    } elseif (preg_match('/Netscape/i', $userAgent)) {
        $userBrowser = "Netscape";
    }

    if (preg_match('/Mobile/i', $userAgent)) {
        $userBrowser = "Mobile Device";
    }
    return $userBrowser;
}

function redirectToPage($url, $title, $message, $refresTime) {
    echo "<html>\n";
    echo "  <head>\n";
    echo "    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>\n";
    echo "    <meta http-equiv=\"REFRESH\" content=\"$refresTime;url=$url\">\n";
    echo "    <title>$title</title>\n";
    echo "  </head>\n";
    echo "  <body>\n";
    echo "    <p>$message</p>";
    echo "    <p>You will be redirect in $refresTime seconds.</p>";
    echo "  </body>\n";
    echo "</html>";
    exit(1);
}

function redirectToLastPage($title, $refreshTime = 5) {
    $referer = $_SERVER["HTTP_REFERER"];

    echo "<html>\n";
    echo "  <head>\n";
    echo "    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>\n";
    echo "    <meta http-equiv=\"REFRESH\" content=\"$refreshTime;url=$referer\">\n";
    echo "    <title>$title</title>\n";
    echo "  </head>\n";
    echo "  <body>\n";
    echo "    <p> Invalid data!";
    echo "    <p> Please fill all the fields marked with *. You will be redirect to the last page in $refreshTime seconds\n";
    echo "  </body>\n";
    echo "</html>";
}


function webAppName() {
    $uri = explode("/", $_SERVER['REQUEST_URI']);
    $n = count($uri);
    $webApp = "";
    for ($idx = 0; $idx < $n - 1; $idx++) {
        $webApp .= ($uri[$idx] . "/" );
    }

    return $webApp;
}

function isLoggedIn(){
    if (!empty($_SESSION['userId'])){
        return $_SESSION['userId'];
      }
    else{
         return "-1";
      }
}

function isValid($userName, $password) {
    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");

    $query = "SELECT * FROM `smi_final`.`user` WHERE `name`='$userName' AND `password`='$password' AND `role`!='0'";
    $result = mysqli_query($linkIdentifier, $query);

    $numRows = mysqli_num_rows($result);

    if ($numRows == 1) {
        $userData = mysqli_fetch_array($result);
        $userOk = $userData['id'];
    }
    mysqli_free_result($result);
    mysqli_Close($linkIdentifier);
    return $userOk;
}

function getRole($userId) {
    $userRoles = "";

    $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
    mysqli_select_db($linkIdentifier, "smi_final");

    $query = "SELECT `role` FROM `smi_final`.`user` WHERE `id` = '$userId'";

    $result = mysqli_query($linkIdentifier, $query);
    $userRoles = mysqli_fetch_array($result);
    mysqli_free_result($result);
    mysqli_close($linkIdentifier);

    return $userRoles;
}

function showUploadFileError($errorCode) {
    switch ($errorCode) {
        case UPLOAD_ERR_OK:
            $errorMessage = "($errorCode) There is no error, the file uploaded with success.";
            break;

        case UPLOAD_ERR_INI_SIZE:
            $errorMessage = "($errorCode) The uploaded file exceeds the upload_max_filesize directive in php.ini file.";
            break;

        case UPLOAD_ERR_FORM_SIZE:
            $errorMessage = "($errorCode) The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
            break;

        case UPLOAD_ERR_PARTIAL:
            $errorMessage = "($errorCode) The uploaded file was only partially uploaded.";
            break;

        case UPLOAD_ERR_NO_FILE:
            $errorMessage = "($errorCode) No file was uploaded.";
            break;

        case UPLOAD_ERR_NO_TMP_DIR:
            $errorMessage = "($errorCode) Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.";
            break;

        case UPLOAD_ERR_CANT_WRITE:
            $errorMessage = "($errorCode) Failed to write file to disk. Introduced in PHP 5.1.0.";
            break;

        case UPLOAD_ERR_EXTENSION:
            $errorMessage = "($errorCode) A PHP extension stopped the file upload.";
            break;

        default:
            $errorMessage = "($errorCode) No description available.";
            break;
    }

    return $errorMessage;
}

?>