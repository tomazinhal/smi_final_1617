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
  .button_save{
  border:1px solid #8AB31B; color: #FFFFFF;
  background-color: #56E024; background-image: -webkit-gradient(linear, left top, left bottom, from(#56E024), to(#48BD1E));
  background-image: -webkit-linear-gradient(top, #56E024, #48BD1E);
  background-image: -moz-linear-gradient(top, #56E024, #48BD1E);
  background-image: -ms-linear-gradient(top, #56E024, #48BD1E);
  background-image: -o-linear-gradient(top, #56E024, #48BD1E);
  background-image: linear-gradient(to bottom, #56E024, #48BD1E);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#56E024, endColorstr=#48BD1E);}

  .button_save:hover{
  border:1px solid #8AB31B;
  background-color: #4CC720; background-image: -webkit-gradient(linear, left top, left bottom, from(#4CC720), to(#368C17));
  background-image: -webkit-linear-gradient(top, #4CC720, #368C17);
  background-image: -moz-linear-gradient(top, #4CC720, #368C17);
  background-image: -ms-linear-gradient(top, #4CC720, #368C17);
  background-image: -o-linear-gradient(top, #4CC720, #368C17);
  background-image: linear-gradient(to bottom, #4CC720, #368C17);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#4CC720, endColorstr=#368C17);
  }
</style>



<body class="w3-light-grey w3-content" style="max-width:1600px">
<?php 
  session_start(); 
  if(isset($_SESSION["userId"])){
    include_once("getNotifications.php");
  }
?>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-animate-left w3-top w3-text-grey w3-large" style="z-index:3;width:250px;font-weight:bold;display:none;left:0;" id="mySidebar">
  <br><br><br>
  <button onclick=newEventModal_open(); w3_close() class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Make a new event</button> 
  <button onclick=contentModal_open(); w3_close() class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Post new content</button>
  <?php
  if(!empty($_SESSION["userId"])){
    
    include_once("isSubscribed.php");

    if($isSubed){
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
    <?php 
    if(!empty($_SESSION["userId"]))
      echo'<button style="display:inline-block; vertical-align:middle" class="w3-button w3-xlarge" onclick="w3_open()">☰</button>';
    ?>
    <a href="mainPage.php"><h1 style="display:inline-block; vertical-align:middle" ><b>My Website</b></h1></a>
    
    <?php
      if(empty($_SESSION["userId"])){
        echo '<a href="registerFrame.php" style="margin-top:1%" class="w3-button w3-right">Register</a>
              <a href="loginFrame.php" style="margin-top:1%" class="w3-button w3-right">Log In</a>';
      }
      else{
        echo '<div class="w3-right" style="margin-top:1%">';
        echo '<a href="logout.php" style="margin-top:1%" class="w3-button w3-right">Log out</a>';

        echo '<button id="notificationButton" onclick="notification_open()" class="w3-right w3-button w3-circle w3-ripple" style="margin-top:1.3%; margin-right:20px; background-color:transparent">';
        echo '<img alt="notification" src="/smi-final/Content/static/notification_icon.png" width="30" height="30">';
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


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content" style="max-width:1600px">
  <div id="table" style="display:flex; justify-content:center">
    <table class="table w3-table-all" style="max-width:800px">
      <thead>
        <tr>
          <th>Delete</th>
          <th>Event Name</th>
          <th>Description</th>
          <th>Content</th>
          <th>Creation date</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div><br>
  <button id="saveEvents" class="btn btn-primary w3-button w3-border button_save" style="height:40px;width:auto; margin:auto; display:block">Save Events</button>
  
  <div id="toast"></div>
<!-- End page content -->
</div>

<script>
  var $saveEvents = $('#saveEvents');
  var $numEvents = 0;
  var $events;

  function addToTable(){
    var $addTable = "";
    for(var i = 0; i < $events.length; i++){

       $addTable += '\
        <tr>\
          <td><input type="checkbox" id="check'+i+'"></input></td>\
          <td id="name'+i+'">'+$events[i][0]+'</td>\
          <td id="description'+i+'">'+$events[i][1]+'</td>\
          <td id="url'+i+'" >'+$events[i][2]+'</td>\
          <td id="creation'+i+'" >'+$events[i][3]+'</td>\
        </tr>'    
    }
    $('#table tbody').append($addTable);
  }

  $(document).ready(function(){
    getEvents();
  });

  $saveEvents.click(function () {
    var saveData = [];
    for(var i = 0; i < $events.length; i++){
      var rowData = [];
      if(document.getElementById("check"+i).checked){
        rowData.push(document.getElementById("name"+i).innerText);
      }
      if(rowData.length != 0)
        saveData.push(rowData);
    }
    if(saveData.length == 0){
      showToast("No tables selected");
    } 
    else{
      $.ajax({ 
        type: "post",
        url: "processEvents.php",
        data: {"events": saveData},
        success: function () {
          getEvents();
        },
      });
    }

  });

  function getEvents(){
    $.ajax({ 
      type: "post",
      url: "getEvents.php",
      data: {},
      dataType: 'json',
      success: function (events_) {
        $events = events_;
        $("#table tbody").empty();
        addToTable();
      },
      error: function(xhr) {
        alert("fail on requesting " + xhr);
      }
    });
  }

  function showToast(string){
    $("#toast").empty();
    $("#toast").append(string);
    var x = document.getElementById("toast");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3500);
  }

</script>


</body>
</html>