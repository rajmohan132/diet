$(document).ready(function() {
		
    var cid = $("#cid").val();
    var food = JSON.parse($("#food").val());
    var arr2= new Array();
    arr = [];
    console.log(food);
    for(i = 0; i < food.length; i++){
        date = food[i].date;
        datenew = date.split("-").reverse().join("-");
        arr.push({title:'Breakfast:'+food[i].breakfast+ 
            '\n \n Lunch: '+food[i].lunch+ 
            '\n \n Snacks: '+food[i].snacks+
            '\n \n Dinner: '+food[i].dinner , start:datenew });
    };	
    
    console.log(arr);
    $('#calendar').fullCalendar({
    
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        
        defaultDate: $("#day").val(),
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: arr,
        dayRender: function(date, cell) {
            if (date.day() === 5) { // Friday
                // cell.css("background-color", "#000000");
                cell.html("<div style='font-weight:bold;color:green;text-align:center;margin-top: 90px;'> <img src='../assets/images/calender.png' style='width: 123px;margin-top: -87px;'><br> Not available</div>");
            }
        }
    });
    
});