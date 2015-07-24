<?php
       session_start();
       $id= $_SESSION['number'];
       ?>
<html>
    <head lang="en">
        <!--<title>TODO supply a title</title>-->
        <meta charset="UTF-8">
        <!-- jQuery library -->
        <script type="text/javascript" src="js/moment.min.js"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <!-- Javascript file -->
        <script type="text/javascript" src="js/jquery-ui.custom.min.js"></script>
        <script src="js/fullcalendar.min.js" type="text/javascript"></script>
        <!-- CSS file -->
        <link    href="css/fullcalendar.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    
    
        <script language="Javascript">
        
            var state = new Object();
            var document = new Array();
            //state['td00']=0;
            //state['td10']=0
            
            $(document).ready(function() {
                $('#fc2').fullCalendar({
                    header:{left: 'prev,next,today',center:'title'},
                    defaultView: 'agendaWeek',
                    allDay:false,
                    height:600,                    
                    selectable:true,
                    selectHelper:true,
                    editable:true,
            
                    select:function(start,end,fullday) {
                        var start_date = new Date(start);
                        var end_date = new Date(end);
                        var date = start_date.getFullYear()+"/"+(start_date.getMonth()+1)+"/"+start_date.getDate();
                        
                        var start_hour;
                        if (start_date.getHours() >= 9){
                            start_hour = start_date.getHours() - 9;
                        } else {
                            start_hour = 24 - (9 - start_date.getHours());
                        }
                        var start_minute = start_date.getMinutes();
                        var start_second = start_date.getSeconds();
                        var start_time = (start_hour +":"+start_minute+":"+start_second);
                        
                        var end_hour;
                        if (end_date.getHours() >= 9){
                            end_hour = end_date.getHours() - 9;
                        } else {
                            end_hour = 24 - (9 - end_date.getHours());
                        }
                        var end_minute = end_date.getMinutes();
                        var end_second = end_date.getSeconds();
                        var end_time = (end_hour +":"+end_minute+":"+end_second);
                        //alert(start_time);
                        //alert(end_time);
                        //alert(end);
                        
                        if(window.confirm('送信しますか？')){
                             $.ajax({
                                type: "POST",
                                url:"insert.php",
                                data: {
                                    "number": "<?php echo $id; ?>",
                                    "date": date,
                                    "start_time": start_time,
                                    "end_time": end_time
                                }, 
                                success: function(data){
                                  alert(data);
                                  window.location.reload();
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                  alert("error"+ errorThrown);
                                  alert(XMLHttpRequest.responseText);
                                }
                            });
                        } else {
                            alert('キャンセルしました');
                        }
                    },
                    
                    
                      eventClick:function(event, jsEvent){
                          var start_date = new Date(event.start);
                          var date = start_date.getFullYear()+"/"+(start_date.getMonth()+1)+"/"+start_date.getDate();
                          
                          if(window.confirm('削除しますか？')){
                             $.ajax({
                                type: "POST",
                                url:"delete.php",
                                data: {
                                    "number": "<?php echo $id; ?>",
                                    "date": date
                                }, 
                                success: function(data){
                                  alert(data);
                                  window.location.reload();
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                  alert("error"+ errorThrown);
                                  alert(XMLHttpRequest.responseText);
                                }
                            });
                        } else {
                            alert('キャンセルしました');
                        }
                     },

                     eventDrop: function(event){
                        var start_date = new Date(event.start);
                        var end_date = new Date(event.end);
                        var date = start_date.getFullYear()+"/"+(start_date.getMonth()+1)+"/"+start_date.getDate();
                        
                        var start_hour;
                        if (start_date.getHours() >= 9){
                            start_hour = start_date.getHours() - 9;
                        } else {
                            start_hour = 24 - (9 - start_date.getHours());
                        }
                        var start_minute = start_date.getMinutes();
                        var start_second = start_date.getSeconds();
                        var start_time = (start_hour +":"+start_minute+":"+start_second);
                        
                        var end_hour;
                        if (end_date.getHours() >= 9){
                            end_hour = end_date.getHours() - 9;
                        } else {
                            end_hour = 24 - (9 - end_date.getHours());
                        }
                        var end_minute = end_date.getMinutes();
                        var end_second = end_date.getSeconds();
                        var end_time = (end_hour +":"+end_minute+":"+end_second);
                        //alert(start_time);
                        //alert(end_time);
                        //alert(end);
                        
                        if(window.confirm('修正しますか？')){
                             $.ajax({
                                type: "POST",
                                url:"update.php",
                                data: {
                                    "number": "<?php echo $id; ?>",
                                    "date": date,
                                    "start_time": start_time,
                                    "end_time": end_time
                                }, 
                                success: function(data){
                                  alert(data);
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                  alert("error"+ errorThrown);
                                  alert(XMLHttpRequest.responseText);
                                }
                            });
                        } else {
                            alert('キャンセルしました');
                        }
                     },
                     
                     eventResize: function(event){
                         var start_date = new Date(event.start);
                        var end_date = new Date(event.end);
                        var date = start_date.getFullYear()+"/"+(start_date.getMonth()+1)+"/"+start_date.getDate();
                        
                        var start_hour;
                        if (start_date.getHours() >= 9){
                            start_hour = start_date.getHours() - 9;
                        } else {
                            start_hour = 24 - (9 - start_date.getHours());
                        }
                        var start_minute = start_date.getMinutes();
                        var start_second = start_date.getSeconds();
                        var start_time = (start_hour +":"+start_minute+":"+start_second);
                        
                        var end_hour;
                        if (end_date.getHours() >= 9){
                            end_hour = end_date.getHours() - 9;
                        } else {
                            end_hour = 24 - (9 - end_date.getHours());
                        }
                        var end_minute = end_date.getMinutes();
                        var end_second = end_date.getSeconds();
                        var end_time = (end_hour +":"+end_minute+":"+end_second);
                        //alert(start_time);
                        //alert(end_time);
                        //alert(end);
                        
                        if(window.confirm('修正しますか？')){
                             $.ajax({
                                type: "POST",
                                url:"update.php",
                                data: {
                                    "number": "<?php echo $id; ?>",
                                    "date": date,
                                    "start_time": start_time,
                                    "end_time": end_time
                                }, 
                                success: function(data){
                                  alert(data);
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                  alert("error"+ errorThrown);
                                  alert(XMLHttpRequest.responseText);
                                }
                            });
                        } else {
                            alert('キャンセルしました');
                        }
                     }
        
                });
                
                
                
            });
            
         </script>
            
            
        <div id="fc2" class="fc"></div>
        
        <script type="text/javascript">
    
    $(function(){
  
        $.ajax({
                    type: "POST",
                    url: "reader.php",
                    dataType:"json",
                    data: {
                        "table":"shift_plan",
                        "number":"<?php echo $id; ?>" 
                    },
                    success: function(j_data){
                        //alert("aa");
                        for (var i = 0; i <j_data.length; i++){
                            $('#fc2').fullCalendar('addEventSource', [{
                                title: "",
                                start: j_data[i].date+" "+j_data[i].start_time,
                                end: j_data[i].date+" "+j_data[i].end_time
                            }]);
                                
                            
                        }   
                        
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                             alert("error");
                    }
                });
    });
</script>
        
    </body>
</html>