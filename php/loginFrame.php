<!DOCTYPE html>
<html>
<title>SMI Final Project</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body style="max-width:300px">
    <div class="w3-modal"  style="display:block">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:300px">
        <div class="w3-center"><br>
            <a href="mainPage.php" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</a>
        </div>

        <form class="w3-container" action="login.php" nsubmit="return FormLoginValidator(this)" name="FormLogin" method="post">
            <div class="w3-section">
            <label><b>Username</b></label>
            <input class="w3-input w3-margin-bottom w3-animate-input" style="width:60%" type="text" placeholder="Enter Username" name="username" required>
            <label><b>Password</b></label>
            <input class="w3-input w3-animate-input" style="width:60%" type="password" placeholder="Enter Password" name="password" required>
            <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
            
            </div>
        </form>
        <a href="registerFrame.php" class="w3-button w3-margin-top">Register</a>
        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
            <a href="mainPage.php" type="button" class="w3-button w3-red">Cancel</a>
            <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
        </div>
        </div>
    </div>
</body>
</html>