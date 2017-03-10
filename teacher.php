<?php ob_start(); ?>
<?php
include('partials/_dbinfo.inc.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>SPARTAX GYM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href='css/fullcalendar.css' rel='stylesheet' />
    <link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <script src="js/fullcalendar.min.js"></script>
    <style>
      #calendar {
        width: 900px;
        margin: 0 auto;
        }
      .schedule, .icon-print{
        margin: 20px;
      }
    </style>
</head>
<body>
<div class="container">
<?php
  session_start();
  include "partials/_header.php";
?>

<a href=javascript:printDiv('calendar')><i class="icon-print pull-left"></i></a>

<div id="response" style="color: red;"></div>

<div id="calendar"></div>
<iframe name='print_frame' width=0 height=0 frameborder=0 src=about:blank></iframe>

 <script>
 $(document).ready(function(){
    var params = window.location.search.substring(1).split("=");
    var dataObj = {};
    dataObj[params[0]] = params[1];
     $('#calendar').fullCalendar({
        weekends: false,
        eventSources: [
        {
            url: 'partials/_json_calendar.php',
            type: 'POST',
            data: dataObj,
        }
    ],
        defaultView: 'agendaWeek',
        minTime: 8,
        maxTime: 18,
        allDaySlot: false,
        header: {center: 'prev next',right: 'month prevYear,nextYear'}
    });
  });

function printDiv(divId) {
    divCSS = new String ('<link href="css/fullcalendar.css" rel="stylesheet" type="text/css">')
    window.frames["print_frame"].document.body.innerHTML= divCSS + document.getElementById(divId).innerHTML;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}

 </script>

</body>
</html>