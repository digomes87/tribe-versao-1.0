<?php
  $host = "localhost";
  $user = "root";
  $pass = "";
  $banco= "tribe";

  $conec = mysql_connect($host,$user,$pass)or die(mysql_error());
  mysql_select_db($banco)or die(mysql_error());
?>
<?php
  session_start();

  // if (!isset($_SESSION['username'])){
  //     header("location: index.php");
  //     exit;
  // }else{
  //   echo "<center>Vc ja esta logado</center>";
  // }

?>

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href='bootstrap/css/fullcalendar.css' rel='stylesheet' />
    <script src='bootstrap/js/moment.min.js'></script>
    <script src='bootstrap/js/jquery-1.11.2.min.js'></script>
    <script src='bootstrap/js/jquery-1.11.2.js'></script>
    <script src='bootstrap/js/jquery.min.js'></script>
    <script src='bootstrap/js/fullcalendar.min.js'></script>
    <link href="bootstrap/css/dash.css" rel="stylesheet">

<script>
 $(document).ready(function() {
  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();
  var calendar = $('#calendar').fullCalendar({
   editable: true,
   header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,agendaWeek,agendaDay'
   },
   
   events: "events.php",
   
   // Convert the allDay from string to boolean
   eventRender: function(event, element, view) {
    if (event.allDay === 'true') {
     event.allDay = true;
    } else {
     event.allDay = false;
    }
   },
   selectable: true,
   selectHelper: true,
   select: function(start, end, allDay) {
   
   var title = prompt('Event Title:');
  
   if (title) {
   var start=moment(start).format('YYYY-MM-DD'); 
   var end=moment(end).format('YYYY-MM-DD'); 

    //var obj = {title:title,start:start,end:end};
	$.ajax({
			  method: "POST",
			  url: "http://tribe/add_events.php",
			  data: {title:title,start:start,end:end}
		})
			  .done(function( msg ) {
			    alert( "Data Saved: " + msg );
			  });

   calendar.fullCalendar('renderEvent',
	   {
		   title: title,
		   start: start,
		   end: end,
		   allDay: allDay
	   },
   
   true // make the event "stick"
   );
   }
   
   calendar.fullCalendar('unselect');
   
   },
   
   editable: true,
   eventDrop: function(event, delta) {
   var start=moment(start).format('YYYY-MM-DD'); 
   var end=moment(end).format('YYYY-MM-DD'); 
   
   $.ajax({
	   
	   	url: 'http://tribe/update_events.php',
	   	data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
	   	//alert(data),
      type: "POST",
	   		success: function(json) {
	    		alert("Updated Successfully,?");
   		}
   });
   },
   eventClick: function(event) {
	
	var decision = confirm("Do you really want to do that?"); 
	if (decision) {
	$.ajax({
		type: "POST",
		url: "http://tribe/delete_event.php",
		data: "&id=" + event.id,
		 success: function(json) {
			 $('#calendar').fullCalendar('removeEvents', event.id);
			  alert("Updated Successfully");
			}
	});
 
}
  },
   eventResize: function(event) {
   var start = $.fullCalendar.formatDate(event.start, "YYYY-MM-DD");
   var end = $.fullCalendar.formatDate(event.end, "YYYY-MM-DD");
   
   $.ajax({
    url: 'http://tribe/update_events.php',
    data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
    type: "POST",
    success: function(json) {
     alert("Updated Successfully");
    }
   });
}
   
  });
  
 });
</script>
<style>
 /*body {*/
  /*margin-top: 40px;*/
  /*text-align: center;*/
  /*font-size: 14px;*/
  /*font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;*/
  /*}*/
 /*#calendar {*/
  /*width: 900px;*/
  /*margin: 0 auto;*/
  /*}*/
</style>
</head>
<!--<div id='calendar'></div>-->


<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">TRIBE</a>
            <div class="btn-group pull-right">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-user"></i> User Tribe<span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Sign Out</a></li>
                </ul>
            </div>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="active"><a href="#">Availability</a></li>
                    <li><a href="#about">Check Roster</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container">
    <div class="row-fluid">
        <div class="span3">
        </div><!--/span-->
        <div class="span15">
            <div class="hero-unit">
                <div id='calendar' class=""></div>
            </div>
        </div><!--/span-->
    </div><!--/row-->

    <hr>

    <footer>
        <p>&copy; TRIBE 2015</p>
    </footer>

</div><!--/.fluid-container-->
</body>

</html>