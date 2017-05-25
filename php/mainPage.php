<!DOCTYPE html>
<html>
<title>SMI Final Project</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey w3-content" style="max-width:1600px">



<!-- Sidebar/menu -->
<!--
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>
    <img src="/w3images/avatar_g2.jpg" style="width:45%;" class="w3-round"><br><br>
    <h4><b>Website</b></h4>
    <p class="w3-text-grey">Template by W3.CSS</p>
  </div>
  <div class="w3-bar-block">
    <a href="#Website" onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Website</a> 
    <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>ABOUT</a> 
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>CONTACT</a>
  </div>
  <div class="w3-panel w3-large">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>
</nav>
-->

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main">

  <!-- Header -->
  <header id="Website" class="w3-container w3-border-bottom w3-animate-left">
    <button style="display:inline-block; vertical-align:middle" class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
    <h1 style="display:inline-block; vertical-align:middle" ><b>My Website</b></h1>
    <span  style="margin-left:10%">Category:</span> 
    <button class="w3-button w3-white we-card">ALL</button>
    <button class="w3-button w3-white we-card">Party</button>
    <button class="w3-button w3-white we-card">Exhibition</button>
    <button class="w3-button w3-white we-card">Art</button>
    <div class="w3-dropdown-hover">
      <button class="w3-button w3-white we-card">Show More Categories</button>
      <div class="w3-dropdown-content w3-bar-block w3-border">
        <a href="#" class="w3-bar-item w3-button">Option 1</a>
        <a href="#" class="w3-bar-item w3-button">Option 2</a>
        <a href="#" class="w3-bar-item w3-button">Option 3</a>
      </div>
    </div>
    <button onclick="document.getElementById('registerModal').style.display='block'" style="margin-top:1%" class="w3-button w3-right">Register</button>
    <button onclick="document.getElementById('loginModal').style.display='block'" style="margin-top:1%" class="w3-button w3-right">Log In</button>
  </header>
  
  <?php
    //pick 15 events from the database and put them here
    $numEventRows = 3;

    for($i = 0; $i < $numEventRows; $i++){
      $event1 = 3*$i + 1;
      $event2 = 3*$i + 2;
      $event3 = 3*$i + 3;

      echo '  <div class=" w3-container w3-margin-top">
                <!-- First Photo Grid (will later be done dynamically) -->
                <div class="w3-row-padding w3-animate-zoom">
                  <div class="w3-third   w3-container w3-margin-bottom">
                    <img src="" alt="Event' . $event1 . '" style="width:100%" class="w3-hover-opacity">
                    <div class="w3-container w3-white">
                      <p><b>Lorem Ipsum</b></p>
                      <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
                    </div>
                  </div>
                  <div class="w3-third w3-container w3-margin-bottom">
                    <img src="" alt="Event' . $event2 . '" style="width:100%" class="w3-hover-opacity">
                    <div class="w3-container w3-white">
                      <p><b>Lorem Ipsum</b></p>
                      <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
                    </div>
                  </div>
                  <div class="w3-third w3-container">
                    <img src="" alt="Event' . $event3 . '" style="width:100%" class="w3-hover-opacity">
                    <div class="w3-container w3-white">
                      <p><b>Lorem Ipsum</b></p>
                      <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
                    </div>
                  </div>
                </div>
              </div>';
    }
  ?>

  <!-- Pagination -->
  <div class="w3-center w3-padding-32">
    <button class="w3-button w3-white we-card">Show more!</button>
  </div>

<!-- End page content -->
</div>

<!-- Register Modal -->
<div id="registerModal" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:300px">
      <div class="w3-center"><br>
        <span onclick="document.getElementById('registerModal').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <form class="w3-container" action="registerUser.php" nsubmit="return FormLoginValidator(this)" name="FormLogin" method="post">
        <div class="w3-section">
          <label><b>Username</b></label>
          <input class="w3-input w3-margin-bottom w3-animate-input" style="width:50%" type="text" placeholder="Enter Username" name="name" required>
          <label><b>Email</b></label>
          <input class="w3-input w3-margin-bottom w3-animate-input" style="width:50%" type="text" placeholder="Enter Email" name="email" required>
          <label><b>Password</b></label>
          <input class="w3-input w3-animate-input" style="width:50%" type="password" placeholder="Enter Password" name="password" required>
          
          <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Register</button>
          
        </div>
      </form>
      <button onclick="document.getElementById('registerModal').style.display='none';
            document.getElementById('loginModal').style.display='block'" class="w3-button w3-margin-top">Login</button>
      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('registerModal').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
      </div>
    </div>
</div>

<!-- Login Modal -->
<div id="loginModal" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:300px">
      <div class="w3-center"><br>
        <span onclick="document.getElementById('loginModal').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <form class="w3-container" action="" nsubmit="return FormLoginValidator(this)" name="FormLogin" method="post">
        <div class="w3-section">
          <label><b>Username</b></label>
          <input class="w3-input w3-margin-bottom w3-animate-input" style="width:50%" type="text" placeholder="Enter Username" name="name" required>
          <label><b>Password</b></label>
          <input class="w3-input w3-animate-input" style="width:50%" type="password" placeholder="Enter Password" name="password" required>
          <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
          
        </div>
      </form>
      <button onclick="document.getElementById('loginModal').style.display='none'; 
            document.getElementById('registerModal').style.display='block'" class="w3-button w3-margin-top">Register</button>
      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('loginModal').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
        <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
      </div>
    </div>
</div>

<script>
  
</script>

</body>
</html>
