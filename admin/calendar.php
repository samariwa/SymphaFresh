<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 
 <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Calendar</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
          <?php
           include "dashboard_tabs.php";
          ?>
  <br />
  <div class="container">
   <div id="calendar"></div>
  </div>
 <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
          <hr/>
          <?php
 $currentYear = date("Y");
  ?>
        <p class="text-center">&copy; 2020 - <?php echo $currentYear; ?> | <?php echo $organization ?> Limited. All Rights Reserved.</p>  
         <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
          <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
          <script type="text/javascript" src="../assets/js/bootbox/bootbox.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
 <script>
  $(function() {
    "use strict";
    $(function() {
        $(".preloader").fadeOut();
    });
  function setTime() {
var d = new Date(),
  el = document.getElementById("time");

  el.innerHTML = formatAMPM(d);

setTimeout(setTime, 1000);
}

function formatAMPM(date) {
  var hours = date.getHours(),
    minutes = date.getMinutes(),
    seconds = date.getSeconds(),
    ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
  return strTime;
}

setTime();
   
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    timeZone: 'EAT',
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: 'load.php',
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    {
     var title = prompt("Enter Event Title");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      var where = 'calendar';
      $.ajax({
       url:"add.php",
       type:"POST",
       data:{title:title, start:start, end:end, where:where},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
       }
      })
     }
    },
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     var where = 'calendar';
     $.ajax({
      url:"save.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id, where:where},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Updated');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     var where = 'calendar';
     $.ajax({
      url:"save.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id, where:where},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      var where = 'calendar';
      $.ajax({
       url:"delete.php",
       type:"POST",
       data:{id:id, where:where},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
       }
      })
     }
    },

   });
  });
});   
  </script>
        </body>
</html>