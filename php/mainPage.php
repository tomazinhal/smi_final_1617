<!DOCTYPE html>
<html>
<title>SMI Final Project</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style> body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif} </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<body class="w3-light-grey w3-content" style="max-width:1600px">
<?php session_start(); ?>

<!-- Side menu -->
<nav class="w3-sidebar w3-bar-block w3-animate-left w3-top w3-text-grey w3-large" style="z-index:3;width:250px;font-weight:bold;display:none;left:0;" id="mySidebar">
  <br><br><br>
  <button onclick="newEventModal_open(); w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Make a new event</button> 
</nav>

<!-- Overlay when side menu is open -->
<div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main">

  <!-- Header -->
  <header id="Website" class="w3-container w3-border-bottom w3-animate-left">
    <button style="display:inline-block; vertical-align:middle" class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
    <a href="mainPage.php"><h1 style="display:inline-block; vertical-align:middle" ><b>My Website</b></h1></a>
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

    <?php
      if(empty($_SESSION["userId"])){
        echo '<a href="registerFrame.php" style="margin-top:1%" class="w3-button w3-right">Register</a>
              <a href="loginFrame.php" style="margin-top:1%" class="w3-button w3-right">Log In</a>';
      }
      else{
        echo '<a href="logout.php" style="margin-top:1%" class="w3-button w3-right">Log out</a>';
      }
    ?>
    
  </header>

<div class="w3-container w3-margin-top" id="eventsDiv"></div>

<script>
  $(document).ready(function(){
    $("#btnShowMore").click();
  });
</script>

<div class="w3-modal"  style="display:none" id="newEventModal">
  <?php
    if(!empty($_SESSION["userId"])){
        echo '<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">';
        echo '    <div class="w3-center"><br>';
        echo '        <span onclick=newEventModal_close() class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>';
        echo '    </div>';
        echo '    <form class="w3-container" action="createEvent.php" enctype="multipart/form-data"  nsubmit="return FormLoginValidator(this)" name="eventLogin" method="post">';
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
        echo '            <input type=\'hidden\' name=\'userId\' value=\'<?php echo $_SESSION["userId"];?>\'/> ';
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
        echo '    <label><b>You have to an account to create new events</b></label>';
        echo '    <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">';
        echo '        <a href="loginFrame.php" class="w3-button w3-green">Log In</button>';
        echo '        <a onclick=newEventModal_close() class="w3-button w3-red">Cancel</a>';
        echo '    </div>';
        echo '</div>';
    }
  ?>
</div>

<!-- Show More -->
<div class="w3-center w3-padding-32">
  <button class="w3-button w3-white we-card" id="btnShowMore">Show more!</button>
</div>

<!-- End page content -->
</div>

<script>
  
  
  function newEventModal_close(){
    document.getElementById("newEventModal").style.display = "none";
  }

  function newEventModal_open(){
    document.getElementById("newEventModal").style.display = "block";
  }

  function w3_open() {
      document.getElementById("mySidebar").style.display = "block";
      document.getElementById("myOverlay").style.display = "block";
  }

  function w3_close() {
      document.getElementById("mySidebar").style.display = "none";
      document.getElementById("myOverlay").style.display = "none";
  }


  var jsGlobal = (function () {   //Method to get a global variable not being global yet able to be seen by others
        var numEvents = 0; // Private Variable

        var pub = {};// public object - returned at end of module

        pub.setNumEvents = function (numEvents_) {
            numEvents = numEvents_;
        };

        pub.getNumEvents = function() {
            return numEvents;
        }

        return pub; // expose externally
    }());

  
    $("#btnShowMore").click(function(){   //method to get up to 9 more events and update the page with ajax  
      $.ajax({        //post communication to getNineEvents.php
        type: "post",
        url: "getNineEvents.php",
        data: { "numEvents": jsGlobal.getNumEvents()},
        dataType: 'json',

        success: function (events) {
          jsGlobal.setNumEvents(jsGlobal.getNumEvents() + events.length);
          var numRows = Math.ceil(events.length / 3);
          var lastLineEvents = events.length % 3;
          var eventNum = 0;
          var content = "";
          for(var i = 0; i < numRows; i++){ //
            
            content += '<div class="w3-row-padding w3-animate-zoom">';
            if(i == (numRows - 1) && lastLineEvents != 0){   //check necessary to handle the last line since it can have less 
              for(var j = 0; j < lastLineEvents; j++){                               //than 3 events
                content += '\
                <a href="eventPage.php?eventId=' + events[eventNum][0] + '">\
                  <div class="w3-third   w3-container w3-margin-bottom">\
                    <img src="./../../' + events[eventNum]["thumbnail"] + '" alt="Event" style="width:100%" class="w3-hover-opacity">\
                    <div class="w3-container w3-white">\
                      <p><b>' + events[eventNum][1] + '</b></p>\
                      <p>' + events[eventNum][2] + '</p>\
                    </div>\
                  </div>\
                  </a>';
                  eventNum++;
              }
            }
            else{
              for(var j = 0; j < 3; j++){
                content += '\
                <a href="eventPage.php?eventId=' + events[eventNum][0] + '">\
                <div class="w3-third   w3-container w3-margin-bottom">\
                  <img src="./../../' + events[eventNum]["thumbnail"] + '" alt="Event" style="width:100%" class="w3-hover-opacity">\
                  <div class="w3-container w3-white">\
                    <p><b>' + events[eventNum][1] + '</b></p>\
                    <p>' + events[eventNum][2] + '</p>\
                  </div>\
                </div>\
                </a>';
                eventNum++;
              }
            }
            content += '</div>';
            
            if(events.length % 9 != 0)
              $("#btnShowMore").attr("disabled", true); //disable button to get more events since there's no more events to show
          }
          $("#eventsDiv").append(content);    //update on the div with all the events it got from getNineEvents.php
        },
        error: function(xhr) {
          alert('fail')
        }
    })
    return false;
    });




</script>

</body>
</html>
