<!DOCTYPE html>
<html>
<title>SMI Final Project</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
.cont_hover{
    display:inline-block;
    border:0;
    width:auto;
    height:auto;
    position: relative;
    -webkit-transition: all 200ms ease-in;
    -webkit-transform: scale(0.8); 
    -ms-transition: all 200ms ease-in;
    -ms-transform: scale(0.8); 
    -moz-transition: all 200ms ease-in;
    -moz-transform: scale(0.8);
    transition: all 200ms ease-in;
    transform: scale(0.8);   
}
.cont_hover:hover{
    z-index: 2;
    -webkit-transition: all 200ms ease-in;
    -webkit-transform: scale(1);
    -ms-transition: all 200ms ease-in;
    -ms-transform: scale(1);   
    -moz-transition: all 200ms ease-in;
    -moz-transform: scale(1);
    transition: all 200ms ease-in;
    transform: scale(1);
}
</style>
<body class="w3-light-grey" style="line-height:1">
<?php 
  session_start(); 
  $_SESSION["eventId"] = $_GET["eventId"];
?>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-animate-left w3-top w3-text-grey w3-large" style="z-index:3;width:250px;font-weight:bold;display:none;left:0;" id="mySidebar">
  <br><br><br>
  <button onclick=newEventModal_open(); w3_close() class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Make a new event</button> 
  <button onclick=contentModal_open(); w3_close() class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Post new content</button>
  <?php
  if(!empty($_SESSION["userId"])){
    
    ob_start();
    include("isSubscribed.php");
    $isSubed = ob_get_contents();
    ob_end_clean();

    if($isSubed == "TRUE"){
      echo '<a href="unsubscribe.php" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Unsubscribe</a>';
    }
    else{
      echo '<a href="subscribe.php" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Subscribe</a>';
    }
  }
  ?>
   
</nav>

<!-- Header -->
  <header id="Website" class="w3-container w3-border-bottom w3-animate-left">
    <button style="display:inline-block; vertical-align:middle" class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
    <a href="mainPage.php"><h1 style="display:inline-block; vertical-align:middle" ><b>My Website</b></h1></a>
    
    <?php
      if(empty($_SESSION["userId"])){
        echo '<a href="registerFrame.php" style="margin-top:1%" class="w3-button w3-right">Register</a>
              <a href="loginFrame.php" style="margin-top:1%" class="w3-button w3-right">Log In</a>';
      }
      else{
        echo '<button style="margin-top:1%" class="w3-button w3-right">Log out></button>';
        echo '<a href="logout.php" style="margin-top:1%" class="w3-button w3-right">Log out</a>';
      }
    ?>
    </header>

<div class="w3-modal"  style="display:none" id="newEventModal">
  <?php
    if(!empty($_SESSION["userId"])){
        echo '<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">';
        echo '    <div class="w3-center"><br>';
        echo '        <span onclick=newEventModal_close() class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>';
        echo '    </div>';
        echo '    <form class="w3-container" action="createEvent.php" nsubmit="return FormLoginValidator(this)" name="eventLogin" method="post">';
        echo '        <div class="w3-section">';
        echo '            <label><b>Event Name</b></label>';
        echo '            <input class="w3-input w3-margin-bottom w3-animate-input" id="eventName" style="width:50%" type="text" placeholder="Enter a name" name="eventName" required>';
        echo '            <label><b>Type of Event</b></label>';
        echo '            <select class="w3-select" name="type" required>';
        echo '                <option value="" disabled selected>Choose a type</option>';
        echo '                <option value="1">Party</option>';
        echo '                <option value="2">Exhibition</option>';
        echo '                <option value="3">Art</option>';
        echo '            </select><br><br>';
        echo '            <label><b>Event description</b></label><br><br>';
        echo '            <textarea rows="4" cols="50" name="description" required></textarea><br>';
        echo '            <input type=\'hidden\' name=\'userId\' value=\'<?php echo $_SESSION["userId"];?> \'/> ';
        echo '            Upload thumbnail: <input type="file" name="thumbnail" accept="image/*" required>';
        echo '            <button class="w3-button w3-block w3-green w3-section w3-padding" id="eventBtn" type="submit">Make Event</button>    ';
        echo '        </div>';
        echo '    </form>';
        echo '    <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">';
        echo '        <button onclick=newEventModal_close() type="button" class="w3-button w3-red">Cancel</button>';
        echo '    </div>';
        echo '</div>';
    }
    else{
        echo ' <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px">';
        echo '    <div class="w3-center"><br>';
        echo '        <span onclick=newEventModal_close() class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>';
        echo '    </div>';
        echo '    <label><b>You have to an account to create new posts</b></label>';
        echo '    <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">';
        echo '        <a href="loginFrame.php" class="w3-button w3-green">Log In</a>';
        echo '        <a onclick=newEventModal_close() class="w3-button w3-red">Cancel</a>';
        echo '    </div>';
        echo '</div>';
    }
  ?>
</div>

<div class="w3-modal"  style="display:none" id="contentModal">
  <?php
    if(!empty($_SESSION["userId"])){
        echo '<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:700px">';
        echo '    <div class="w3-center"><br>';
        echo '        <span onclick=newEventModal_close() class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>';
        echo '    </div>';
        echo '    <form style="display:inline-block; vertical-align:middle; margin-left:100px" enctype="multipart/form-data" action="sendFile.php" method="POST">';
        echo '           Upload content: <input type="file" name="content[]" accept="image/*,video/*" multiple>';
        echo '           <input type="hidden" name="eventId" value="' . $_SESSION["eventId"] . '" />';
        echo '           <input type="hidden" name="userId" value="' . $_SESSION["userId"] . '" />';           
        echo '           <input type="submit" value="Upload">';
        echo '    </form>';
        echo '<br><br>';
        echo '</div>';
    }
    else{
        echo ' <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px">';
        echo '    <div class="w3-center"><br>';
        echo '        <span onclick="onclick=newEventModal_close() class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>';
        echo '    </div>';
        echo '    <label><b>You have to an account to create new posts</b></label>';
        echo '    <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">';
        echo '        <a href="loginFrame.php" class="w3-button w3-green">Log In</a>';
        echo '        <a onclick="onclick=newEventModal_close() class="w3-button w3-red">Cancel</a>';
        echo '    </div>';
        echo '</div>';
    }
  ?>
</div>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content" style="max-width:1600px">
  
  <div class="w3-container w3-border-bottom " style="height:200px" id="eventInfo"></div>

  <!-- Photo grid -->
  <div class="w3-row w3-grayscale-min" id="postsDiv">
    
  </div>

  <div class="w3-center w3-padding-32">
    <button class="w3-button w3-white we-card" id="btnShowMore">Show more!</button>
  </div>
<!-- End page content -->
</div>

<script>
  
  $(document).ready(function(){
    $("#btnShowMore").click();
  });

  function newEventModal_close(){
    document.getElementById("newEventModal").style.display = "none";
  }

  function newEventModal_open(){
    document.getElementById("newEventModal").style.display = "block";
  }

  function contentModal_close(){
    document.getElementById("contentModal").style.display = "none";
  }

  function contentModal_open(){
    document.getElementById("contentModal").style.display = "block";
  }

// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}

var jsGlobal = (function () {   //Method to get a global variable not being global yet able to be seen by others
    var numPosts = 0; // Private Variable

    var pub = {};// public object - returned at end of module

    pub.setNumPosts = function (numPosts_) {
        numPosts = numPosts_;
    };

    pub.getNumPosts = function() {
        return numPosts;
    }

    return pub; // expose externally
}());

  
$("#btnShowMore").click(function(){   //method to get up to 9 more posts and update the page with ajax  
  $.ajax({        //post communication to getNineposts.php
    type: "post",
    url: "getTwelvePosts.php",
    data: { "numPosts": jsGlobal.getNumPosts(), "eventId": <?php echo $_SESSION["eventId"];?>},
    dataType: 'json',

    success: function (posts) {
      jsGlobal.setNumPosts(jsGlobal.getNumPosts() + posts.length);
      $("#postsDiv").append(content);
      var numRows = Math.ceil(posts.length / 4);
      var lastLinePosts = posts.length % 4;
      var postNum = 0;
      var content = "";
      
      for(var i = 0; i < numRows; i++){ //
        
        content += '<div class="w3-row-padding w3-animate-zoom">';
        if(i == (numRows - 1) && lastLinePosts != 0){   //check necessary to handle the last line since it can have less 
          for(var j = 0; j < lastLinePosts; j++){                               //than 4 posts
            var scr = './../../' + posts[postNum][0];
            
            if(posts[postNum][0].substr(posts[postNum][0].lastIndexOf(".")+1) == "png"){ 
              content += '\
                <div class="w3-quarter">\
                  <img src="' + scr + '" alt="post" style="width:100%" class="cont_hover">\
                </div>\
                </a>';
              postNum++;
            }
            else{
              content += '\
                <div class="w3-quarter">\
                  <video src="' + scr + '" alt="psot" style="width:100%" class="cont_hover" controls>\
                </div>\
                </a>';
              postNum++;
            }
          }
        }
        else{
          for(var j = 0; j < 4; j++){
            var scr = './../../' + posts[postNum][0];
            if(posts[postNum][0].substr(posts[postNum][0].lastIndexOf(".")+1) == "png"){ 
              content += '\
                <div class="w3-quarter">\
                  <img src="' + scr + '" alt="post" style="width:100%" class="cont_hover">\
                </div>\
                </a>';
              postNum++;
            }
            else{
              content += '\
                <div class="w3-quarter">\
                  <video src="' + scr + '" alt="post" style="width:100%" class="cont_hover" controls>\
                </div>\
                </a>';
              postNum++;
            }
          }
        }
        content += '</div>';
        
        if(posts.length % 12 != 0)
          $("#btnShowMore").attr("disabled", true); //disable button to get more posts since there's no more posts to show
      }
      $("#postsDiv").append(content);    //update on the div with all the posts it got from getNineposts.php
    },
    error: function(xhr) {
      alert("fail: " + xhr);
    }
  })
  return false;
});

$(document).ready(function(){
  $.ajax({ 
    type: "post",
    url: "getInfoEvent.php",
    data: { "eventId": <?php echo $_SESSION["eventId"];?>},
    dataType: 'json',
    success: function (event) {
      var scr = './../../' + event["thumbnail"];
      var content = '\
      <div style="height:100%">\
          <div class="w3-twothird">\
              <h3>' + event[1] + '</h3>\
              <p>' + event[2] + '</p>\
          </div>\
          <div class="w3-third" style="height:100%; justify-content:center;">\
            <img src="' + scr + '" style="height:100%"/>\
          </div>\
      </div>';
        
      $("#eventInfo").append(content);
    },
    error: function(xhr) {
      alert("fail: " + xhr);
    }
  });
});

</script>


</body>
</html>