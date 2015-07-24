
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Calendar</title>
    <!-- jQuery library -->
    <script type="text/javascript" src="js/moment.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <!-- Javascript file -->
    <script type="text/javascript" src="js/jquery-ui.custom.min.js"></script>
    <script src="js/fullcalendar.min.js" type="text/javascript"></script>
    <script src="js/ja.js" type="text/javascript"></script>
    <!-- CSS file -->
    <link    href="css/fullcalendar.css" rel="stylesheet" type="text/css"/>

    <!-- javascriptの読み込み -->
    <script type="text/javascript">
        var member_number = new Array();
        var date = new Array();
        var start_time = new Array();
        var end_time = new Array();
        var names = new Array();
        var number = new Array();
        var member_length = new Array();
        
        
    $(document).ready(function() {
        
                
        $('#fc1').fullCalendar({
        header:{left: 'prev,next,today',center:'title',right: 'month,agendaWeek,agendaDay'},
        height:600
        
        
            
        
        });
        
        $.ajax({
                    type: "POST",
                    url:"ajax.php",
                    dataType:"json",
                    data: {
                        "table": "member"
                    }, 
                    success: function(data){
                      member_length = data.length;
                      for(var i = 0;i < data.length;i++){
                          //alert(data[i].name);
                          names[i]=data[i].name;
                          number[i]=data[i].number;
                          //alert(names[i]);
                          //alert(number[i]);
                      }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                             alert("error");
                    }
                });
        
        });
    </script>
</head>

<body>
<form action="register.php" >
<br>
<div><input type="submit" value="個人シフトの確認・登録" /></div>
<br>
<br>
</form>
<!-- javascriptの表示 -->
<div id="fc1" class="fc"></div>

<script type="text/javascript">
    
    $(function(){
        
        $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    dataType:"json",
                    data: {
                        "table":"shift_plan"
                    },
                    success: function(j_data){
                        //alert("aa");
                        for (var i = 0; i <j_data.length; i++){
                            for(var j = 0; j<member_length; j++){
                                if(j_data[i].member_number==number[j]){
                                    $('#fc1').fullCalendar('addEventSource', [{
                                    title: names[j],
                                    start: j_data[i].date+" "+j_data[i].start_time,
                                    end: j_data[i].date+" "+j_data[i].end_time
                                }]);
                                }
                            }
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