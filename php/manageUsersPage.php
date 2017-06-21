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
    <button style="display:inline-block; vertical-align:middle" class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
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
        echo '<img alt="notification" src="/smiProject/Content/static/notification_icon.png" width="30" height="30">';
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
  
  <!--  Request Table
  <div id="table" class="table-editable">
    <span class="table-add glyphicon glyphicon-plus"></span>
    <table class="w3-table">
      <tr>
      </tr>
      <!This is our clonable table line -->
      <!--
      <tr class="hide">
        <td>
          <span class="table-remove glyphicon glyphicon-remove"></span>
        </td>
        <td>
          <span class="table-up glyphicon glyphicon-arrow-up"></span>
          <span class="table-down glyphicon glyphicon-arrow-down"></span>
        </td>
      </tr>
    </table>
  </div>-->

  <div id="table">
    <span class="table-add glyphicon glyphicon-plus"></span>
    <table class="table w3-table w3-bordered">
      <tr>
        <th></th>
        <th>Name</th>
        <th>Present Role</th>
        <th>Requested Role</th>
      </tr>
    </table>
  </div>
  
  <button id="saveRequests" class="btn btn-primary">Save</button>


<!-- End page content -->
</div>

<button class="w3-button" onclick="addToTable('user', 1, 2)">Add</button>

<script>
  var $TABLE = $('#table');
  var $saveRequests = $('#saveRequests');
  var $numRequests = 0;
  var $requests;

  function addToTable(){
    var $addTable = "";
    for(var i = 0; i < $requests.length; i++){
      if(i % 2 == 0) $color = 'w3-white';
      else $color = 'w3-light-grey';

       $addTable += '\
        <tr class="'+$color+'">\
          <td><input type="checkbox" id="check'+i+'"></input></td>\
          <td id="name'+i+'">'+$requests[i][0]+'</td>\
          <td id="role'+i+'" contenteditable="true">'+$requests[i][1]+'</td>\
          <td id="requestedRole'+i+'" contenteditable="true">'+$requests[i][2]+'</td>\
        </tr>'    
    }
    $TABLE.find('table').append($addTable);
  }

  $(document).ready(function(){
    $.ajax({ 
      type: "post",
      url: "getRequests.php",
      data: {},
      dataType: 'json',
      success: function (requests_) {
        $requests = requests_;
        addToTable();
      },
      error: function(xhr) {
        alert("fail on requesting " + xhr);
      }
    });
  });



  $saveRequests.click(function () {
    var saveData = [];
    for(var i = 0; i < $requests.length; i++){
      if(document.getElementById("check"+i).checked){
        var rowData = [];
        rowData.push(document.getElementById("name"+i).innerText);
        rowData.push(document.getElementById("role"+i).innerText);
        rowData.push(document.getElementById("requestedRole"+i).innerText);
        saveData.push(rowData);
      }
    }
  });

</script>


</body>
</html>