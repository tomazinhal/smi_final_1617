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
    include_once("getUserRole.php");
  }
?>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-animate-left w3-top w3-text-grey w3-large" style="z-index:3;width:250px;font-weight:bold;display:none;left:0;" id="mySidebar">
  <br><br><br>
  <?php
    if(isset($_SESSION["userId"])){
      echo '<button onclick="roleModal_open(); w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Request Role</button>';
      echo '<button onclick="getRoleInformation(); w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Your role information</button>';
    }
  ?>
   
   <?php
    if(isset($_SESSION["userRole"]) && ($_SESSION["userRole"] == 2 || $_SESSION["userRole"] == 3)){
      echo '<br><br>';
      echo '<h3 class="w3-bar-item w3-padding">Supporter commands</h3>';
      echo '<button onclick="newEventModal_open(); w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Make a new event</button>';
      echo '<button onclick="newCategoryModal_open(); w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Create Category</button>';
    }
  ?>

  <?php
    if(isset($_SESSION["userRole"]) && $_SESSION["userRole"] == 3){
      echo '<br><br>';
      echo '<h3 class="w3-bar-item w3-padding">Admin commands</h3>';
      echo '<a href="manageUsersPage.php" w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Manage Users</a>';
      echo '<button onclick="roleModal_open(); w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Manage Events</button>';
      echo '<button onclick="roleModal_open(); w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Manage Posts</button>';
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
  <h2 style="text-align:center">Manage Users</h2>
  <div id="tableUsers" style="display:flex; justify-content:center">
    <table class="table w3-table-all" style="max-width:800px">
      <thead>
        <tr>
          <th></th>
          <th>ID</th>
          <th>Name</th>
          <th>Role</th>
          <th>Delete User</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div><br>
  <button id="saveUsers" class="w3-button w3-border button_save" style="height:40px;width:auto; margin:auto; display:block">Save User Changes</button>
  <br><br><br><br>

<div class="w3-main w3-content" style="max-width:1600px">
  <h2 style="text-align:center">Manage pending request</h2>
  <div id="tableRequests" style="display:flex; justify-content:center">
    <table class="table w3-table-all" style="max-width:800px">
      <thead>
        <tr>
          <th></th>
          <th>Name</th>
          <th>User ID</th>
          <th>Present Role</th>
          <th>Requested Role</th>
          <th>Accept</th>
          <th>Deny</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div><br>
  <button id="saveRequests" class="w3-button w3-border button_save" style="height:40px;width:auto; margin:auto; display:block">Save Requests</button>
  <br><br><br>
  <div id="toast"></div>
<!-- End page content -->
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
        echo '    <label><b>You have to have an account to create new events</b></label>';
        echo '    <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">';
        echo '        <a href="loginFrame.php" class="w3-button w3-green">Log In</a>';
        echo '        <a onclick=newEventModal_close() class="w3-button w3-red">Cancel</a>';
        echo '    </div>';
        echo '</div>';
    }
  ?>
</div>

<div class="w3-modal"  style="display:none" id="newCategoryModal">
  <?php
    if(!empty($_SESSION["userId"])){
        echo '<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">';
        echo '    <div class="w3-center"><br>';
        echo '        <span onclick=newCategoryModal_close() class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>';
        echo '    </div>';
        echo '    <form class="w3-container" action="createType.php" enctype="multipart/form-data"  nsubmit="return FormLoginValidator(this)" name="eventLogin" method="post">';
        echo '        <div class="w3-section">';
        echo '            <label><b>Category Name</b></label>';
        echo '            <input class="w3-input w3-margin-bottom w3-animate-input" id="typeName" style="width:50%" type="text" placeholder="Enter a name" name="typeName" required>';
        echo '            <button class="w3-button w3-block w3-green w3-section w3-padding" id="eventBtn" type="submit">Create category</button>    ';
        echo '        </div>';
        echo '    </form>';
        echo '    <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">';
        echo '        <button onclick=newCategoryModal_close() type="button" class="w3-button w3-red">Cancel</button>';
        echo '    </div>';
        echo '</div>';
    }
    else{
        echo ' <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px">';
        echo '    <div class="w3-center"><br>';
        echo '        <span onclick=newCategoryModal_close() class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>';
        echo '    </div>';
        echo '    <label><b>You have to an account to create new events</b></label>';
        echo '    <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">';
        echo '        <a href="loginFrame.php" class="w3-button w3-green">Log In</a>';
        echo '        <a onclick=newCategoryModal_close() class="w3-button w3-red">Cancel</a>';
        echo '    </div>';
        echo '</div>';
    }
  ?>
</div>

<script>
  function getRoleInformation() {
    
    $.ajax({        //post communication to getNineEvents.php
      type: "post",
      url: "getInfoRoleRequest.php",
      data: {},
      dataType: 'json',

      success: function (requests) {

        if(requests != null){
          var role = requests[0];
          var status = requests[1];

          showToast("Your request to " + role + " has the status:\"" + status + "\"");
        }
        else{
          showToast("You don't have requests");
        }
        
      },
      error: function(xhr) {
        alert('fail')
      }
    })
  }

  function w3_open() {
      document.getElementById("mySidebar").style.display = "block";
      document.getElementById("myOverlay").style.display = "block";
  }

  function w3_close() {
      document.getElementById("mySidebar").style.display = "none";
      document.getElementById("myOverlay").style.display = "none";
  }

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

  function newCategoryModal_open(){
    document.getElementById("newCategoryModal").style.display = "block";
  }

  function newCategoryModal_close(){
    document.getElementById("newCategoryModal").style.display = "none";
  }

  function roleModal_close(){
    document.getElementById("roleModal").style.display = "none";
  }

  function roleModal_open(){
    document.getElementById("roleModal").style.display = "block";
  }
  
  var $users;
  var $requests;

  function addToRequestTable(){
    var $addTable = "";
    for(var i = 0; i < $requests.length; i++){

       $addTable += '\
        <tr>\
        <td><input type="checkbox" id="requestCheck'+i+'"></input></td>\
          <td id="requestName'+i+'">'+$requests[i][0]+'</td>\
          <td id="requestId'+i+'">'+$requests[i][1]+'</td>\
          <td id="requestRole'+i+'" >'+$requests[i][2]+'</td>\
          <td id="requestedRole'+i+'" >'+$requests[i][3]+'</td>\
          <td><input type="radio" name="requestAction'+i+'" id="accept'+i+'" value="true" checked></input></td>\
          <td><input type="radio" name="requestAction'+i+'" id="deny'+i+'" value="false"></input></td>\
        </tr>'    
    }
    $('#tableRequests tbody').append($addTable);
  }

  function addToUserTable(){
    var $addTable = "";
    for(var i = 0; i < $users.length; i++){

       $addTable += '\
        <tr>\
          <td><input type="checkbox" id="userCheck'+i+'"></input></td>\
          <td id="userId'+i+'">'+$users[i][0]+'</td>\
          <td id="userName'+i+'">'+$users[i][1]+'</td>\
          <td>\
            <select name="userRole'+i+'">\
              <option value="1" '; if($users[i][2] == "1") $addTable += "selected";  $addTable += '>User</option>\
              <option value="2" '; if($users[i][2] == "2") $addTable += "selected";  $addTable += '>Supporter</option>\
              <option value="3" '; if($users[i][2] == "3") $addTable += "selected";  $addTable += '>Admin</option>\
            </select>\
          </td>\
          <td><input type="checkbox" id="userDelete'+i+'"></input></td>\
        </tr>'    
    }
    $('#tableUsers tbody').append($addTable);
  }

  $(document).ready(function(){
    getRequests();
    getUsers();
  });

  $("#saveRequests").click(function () {
    var saveData = [];
    for(var i = 0; i < $requests.length; i++){
      var rowData = [];
      if(document.getElementById("requestCheck"+i).checked){
        rowData.push(document.getElementById("requestId"+i).innerText);
        rowData.push(document.getElementById("requestRole"+i).innerText);
        rowData.push(document.getElementById("requestedRole"+i).innerText);
        rowData.push($('input[name="requestAction'+i+'"]:checked').val());
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
        url: "processRequests.php",
        data: {"requests": saveData},
        success: function () {
          getRequests();
          getUsers();
          showToast("Database Updated");
        },
      });
    }

  });

  $("#saveUsers").click(function () {
    var saveData = [];
    for(var i = 0; i < $users.length; i++){
      var rowData = [];
      if(document.getElementById("userCheck"+i).checked){
        rowData.push(document.getElementById("userId"+i).innerText);
        rowData.push($('select[name=userRole'+i+']').val());
        rowData.push(document.getElementById("userDelete"+i).checked);
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
        url: "processManageUsers.php",
        data: {"users": saveData},
        success: function () {
          getRequests();
          getUsers();
          showToast("Database Updated");
        },
      });
    }

  });

  function getRequests(){
    $.ajax({ 
      type: "post",
      url: "getRequests.php",
      data: {},
      dataType: 'json',
      success: function (requests_) {
        $requests = requests_;
        $("#tableRequests tbody").empty();
        addToRequestTable();
      },
      error: function(xhr) {
        alert("fail on requesting " + xhr);
      }
    });
  }

  function getUsers(){
    $.ajax({ 
      type: "post",
      url: "getUsers.php",
      data: {},
      dataType: 'json',
      success: function (users_) {
        $users = users_;
        $("#tableUsers tbody").empty();
        addToUserTable();
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