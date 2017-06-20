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
  #toast {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
    font-size: 17px;
  }

  #toast.show {
      visibility: visible;
      -webkit-animation: fadein 0.5s, fadeout 0.5s 3.0s;
      animation: fadein 0.5s, fadeout 0.5s 3.0s;
  }

  @-webkit-keyframes fadein {
      from {bottom: 0; opacity: 0;} 
      to {bottom: 30px; opacity: 1;}
  }

  @keyframes fadein {
      from {bottom: 0; opacity: 0;}
      to {bottom: 30px; opacity: 1;}
  }

  @-webkit-keyframes fadeout {
      from {bottom: 30px; opacity: 1;} 
      to {bottom: 0; opacity: 0;}
  }

  @keyframes fadeout {
      from {bottom: 30px; opacity: 1;}
      to {bottom: 0; opacity: 0;}
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<body class="w3-light-grey w3-content" style="max-width:1600px">
<?php session_start();
  include_once("getEventTypes.php");
  if(isset($_SESSION["userId"])){
    include_once("getNotifications.php");
  }
?>

<script>
  jsGlobal = (function () {   //Method to get a global variable not being global yet able to be seen by others
      var numEvents = 0; // Private Variable
      var eventType = -1;
      var keyword = "";

      var pub = {};// public object - returned at end of module

      pub.setNumEvents = function (numEvents_) {
          numEvents = numEvents_;
      };

      pub.getNumEvents = function() {
          return numEvents;
      }

      pub.setEventType = function (eventType_) {
          eventType = eventType_;
      };

      pub.getEventType = function() {
          return eventType;
      }

      pub.setKeyword = function (keyword_) {
          keyword = keyword_;
      };

      pub.getKeyword = function() {
          return keyword;
      }
      return pub; // expose externally
  }());
</script>

<!-- Side menu -->
<nav class="w3-sidebar w3-bar-block w3-animate-left w3-top w3-text-grey w3-large" style="z-index:3;width:250px;font-weight:bold;display:none;left:0;" id="mySidebar">
  <br><br><br>
  <?php
    if(isset($_SESSION["userId"])){
      echo '<button onclick="roleModal_open(); w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Request Role</button>';
      echo '<button onclick="getRoleInformation(); w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Your role information</button>';
    }
  ?>
   
   <?php
    if(isset($_SESSION["userRole"]) && $_SESSION["userRole"] == 2 || $_SESSION["userRole"] == 3){
      echo '<br><br>';
      echo '<h3 class="w3-bar-item w3-padding">Supporter commands</h3>';
      echo '<button onclick="newEventModal_open(); w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Make a new event</button>';
      echo '<button onclick="newEventModal_open(); w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Create Category</button>';
    }
  ?>

  <?php
    if(isset($_SESSION["userRole"]) && $_SESSION["userRole"] == 3){
      echo '<br><br>';
      echo '<h3 class="w3-bar-item w3-padding">Admin commands</h3>';
      echo '<button onclick="roleModal_open(); w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Manage requests</button>';
      echo '<button onclick="roleModal_open(); w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Manage Users</button>';
      echo '<button onclick="roleModal_open(); w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Manage Events</button>';
      echo '<button onclick="roleModal_open(); w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Manage Posts</button>';
    }
  ?>
</nav>

<!-- Overlay when side menu is open -->
<div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main">

  <!-- Header -->
  <header id="Website" class="w3-container w3-border-bottom w3-animate-left">
    <button style="display:inline-block; vertical-align:middle" class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
    <a href="mainPage.php"><h1 style="display:inline-block; vertical-align:middle" ><b>My Website</b></h1></a>
    <span style="margin-left:4%">Category:</span>
    <button class="w3-button w3-white we-card" id="-1">ALL</button>
    <div class="w3-dropdown-hover">
      <button class="w3-button w3-white we-card">Apply Category Filter</button>
      <div class="w3-dropdown-content w3-bar-block w3-border" style="max-height:400px; overflow-y:scroll;">
        <?php
          for($i = 0; $i < count($eventTypes); $i++){
            echo '<button style="width:100%" class="w3-button w3-white we-card" id="' . $eventTypes[$i][0] . '">' . $eventTypes[$i][1] . '</button>';
          }
        ?>
      </div>
    </div>
    <input style="margin-left:4%; display:inline-block; width:300px; padding: 5px 8px 8px 40px;
            max-width:450px; background-image:url('/smiProject/Content/Static/search_icon.png');
            background-size: 30px 30px; background-repeat:no-repeat; box-sizing:border-box " 
            placeholder="Search your event by name" type="text" id="keywordSearch" 
            class="w3-input w3-light-grey w3-margin-bottom w3-animate-input w3-hover-white"/>

    <?php
      if(empty($_SESSION["userId"])){
        echo '<a href="registerFrame.php" style="margin-top:1%" class="w3-button w3-right">Register</a>
              <a href="loginFrame.php" style="margin-top:1%" class="w3-button w3-right">Log In</a>';
      }
      else{
        echo '<div class="w3-right" style="margin-top:1%">';
        echo '<a href="logout.php" style="margin-top:1%" class="w3-button w3-right">Log out</a>';

        echo '<button id="notificationButton" onclick="notification_open()" class="w3-right w3-button w3-circle w3-ripple" style="margin-top:1.3%; margin-right:20px; background-color:transparent">';
        echo '<img alt="notification" src="/smiProject/Content/Static/notification_icon.png" width="30" height="30">';
        echo '</button>';

        echo '<div id="notificationMenu" style="position: absolute; right:1px; top:74px; background-color:#fff; box-shadow: 0 5px 10px rgba(0,0,0,.2);';
        echo '                      width:320px; border:1px solid #ccc; z-index:12; display:none">';
        echo '  <div style="height:30px; border-bottom: 1px solid #ddd"><h3 style="text-align:center; line-height:20px">Notifications</h3></div>';
        echo '    <div id="notificationContent" style="height:400px">';
        
        if(count($notifications) == 0){
          echo '  <p>You don\'t have any notifications</p>';
        }
        else{
          echo '      <ul class="w3-ul w3-hoverable">';
          for($i = 0; $i < count($notifications); $i++){
            echo '<li style="padding: 0px; display:block">';
            echo '  <a style="display:flex; margin-left:10px; text-decoration:none" href="removeNotification.php?eventId=' . $notifications[$i][0] . '">';
            echo '    <p><b>'. $notifications[$i][1] . '</b> has new posts!</p>';
            echo '  </a>';
            echo '</li>';
          }
          echo '      </ul>';
        }
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
      }
    ?>
    
  </header>

<div class="w3-container w3-margin-top" id="eventsDiv"></div>

<script>
  $(document).ready(function(){
    $("#-1").click();
  });
</script>
<div class="w3-modal"  style="display:none" id="roleModal">
  <?php
    if(!empty($_SESSION["userId"])){
      include_once("getRoles.php");
      echo '<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">';
      echo '    <div class="w3-center"><br>';
      echo '        <span onclick=roleModal_close() class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>';
      echo '    </div>';
      echo '    <form class="w3-container" action="requestRole.php" enctype="multipart/form-data"  nsubmit="return FormLoginValidator(this)" name="requestRole" method="post">';
      echo '        <div class="w3-section">';
      echo '            <label><b>Choose the role type you want</b></label>';
      echo '            <select class="w3-select" name="role" required>';
      echo '                <option value="" disabled selected>Choose a type</option>';
      for($i = 0; $i < count($roles); $i++){
        echo '              <option value="' . $roles[$i][0] . '">' . $roles[$i][1] . '</option>';
      }
      echo '            </select><br><br>';
      echo '            <button class="w3-button w3-block w3-green w3-section w3-padding" id="eventBtn" type="submit">Request Role</button>    ';
      echo '        </div>';
      echo '    </form>';
      echo '    <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">';
      echo '        <button onclick=roleModal_close() type="button" class="w3-button w3-red">Cancel</button>';
      echo '    </div>';
      echo '</div>';
    }
  ?>
</div>
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
        for($i = 0; $i < count($eventTypes); $i++){
          echo '              <option value="' . $eventTypes[$i][0] . '">' . $eventTypes[$i][1] . '</option>';
        }
        echo '            </select><br><br>';
        echo '            <label><b>Event description</b></label><br><br>';
        echo '            <textarea rows="4" cols="50" name="description" required></textarea><br>';
        echo '            <input type=\'hidden\' name=\'userId\' value=\'<?php echo $_SESSION["userId"];?>\'/> ';
        echo '            Upload thumbnail: <input type="file" name="content[]" accept="image/*" required>';
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
        echo '        <a href="loginFrame.php" class="w3-button w3-green">Log In</a>';
        echo '        <a onclick=newEventModal_close() class="w3-button w3-red">Cancel</a>';
        echo '    </div>';
        echo '</div>';
    }
  ?>
</div>

<!-- Show More -->
<div class="w3-center w3-padding-32 w3-animate-zoom">
  <button class="w3-button w3-white we-card" id="btnShowMore">Show more!</button>
</div>

<div id="toast"></div>

<!-- End page content -->
</div>

<script>
  function notification_open(){
    document.getElementById("notificationMenu").style.display = "block";
    document.getElementById("notificationButton").onclick = function(){ notification_close();};
  }
  
  function notification_close(){
    document.getElementById("notificationMenu").style.display = "none";
    document.getElementById("notificationButton").onclick = function(){ notification_open();};
  }

  function newEventModal_close(){
    document.getElementById("newEventModal").style.display = "none";
  }

  function newEventModal_open(){
    document.getElementById("newEventModal").style.display = "block";
  }

  function roleModal_close(){
    document.getElementById("roleModal").style.display = "none";
  }

  function roleModal_open(){
    document.getElementById("roleModal").style.display = "block";
  }

  function w3_open() {
      document.getElementById("mySidebar").style.display = "block";
      document.getElementById("myOverlay").style.display = "block";
  }

  function w3_close() {
      document.getElementById("mySidebar").style.display = "none";
      document.getElementById("myOverlay").style.display = "none";
  }

  function getRoleInformation() {
    
    $.ajax({        //post communication to getNineEvents.php
      type: "post",
      url: "getInfoRoleRequest.php",
      data: {},
      dataType: 'json',

      success: function (requests) {

        $("#toast").empty();
        
        if(requests != null){
          var role = requests[0];
          var status = requests[1];

          $("#toast").append("Your request to " + role + " has the status:\"" + status + "\"");
        }
        else{
          $("#toast").append("You don't have requests");
        }
        showToast();
      },
      error: function(xhr) {
        alert('fail')
      }
  })

  }

  function showToast(){
    var x = document.getElementById("toast");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3500);
  }

  $("#-1").click(function(){
      $("#eventsDiv").empty();
      jsGlobal.setNumEvents(0);
      jsGlobal.setEventType(-1);
      getEvent();
  });
    
  <?php
    for($i = 0; $i < count($eventTypes); $i++){
      echo '$("#' . $eventTypes[$i][0] . '").click(function(){';
      echo '  $("#eventsDiv").empty();';
      echo '  jsGlobal.setNumEvents(0);';
      echo '  jsGlobal.setEventType(' . $eventTypes[$i][0] . ');';
      echo '  getEvent();';
      echo '});';
      echo PHP_EOL;
    }
  ?>

  $("#keywordSearch").keyup(function(e){
    if(e.keyCode == 13){
      $("#eventsDiv").empty();
      jsGlobal.setNumEvents(0);
      jsGlobal.setEventType(-2);
      jsGlobal.setKeyword($("#keywordSearch").val());
      getEvent();
    }
  });


  /*var eventTypes = <?=json_encode($eventTypes)?>;
  for(var i = 0; i < count(eventTypes); i++){
    
  } */   

  $("#btnShowMore").click(getEvent);

  var getEvent = (function(){   //method to get up to 9 more events and update the page with ajax  
    $.ajax({        //post communication to getNineEvents.php
      type: "post",
      url: "getNineEvents.php",
      data: { "numEvents": jsGlobal.getNumEvents(), 
              "eventType": jsGlobal.getEventType(),
              "keyword": jsGlobal.getKeyword()},
      dataType: 'json',

      success: function (events) {
        jsGlobal.setNumEvents(jsGlobal.getNumEvents() + events.length);
        if(events.length == 0){  
          $("#btnShowMore").attr("disabled", true);
        }
        else{

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
                    <!--<img src="./../../' + events[eventNum]["url"] + '" alt="Event" style="width:100%" class="w3-hover-opacity">-->\
                    <img src="/smiProject/' + events[eventNum]["url"] + '" alt="Event" style="width:100%" class="w3-hover-opacity">\
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
                  <!--<img src="./../../' + events[eventNum]["url"] + '" alt="Event" style="width:100%" class="w3-hover-opacity">-->\
                  <img src="/smiProject/' + events[eventNum]["url"] + '" alt="Event" style="width:100%" class="w3-hover-opacity">\
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
        }
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
