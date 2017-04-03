<!DOCTYPE html>
<html>
    <head>
        <title> Calendar </title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css" />
        <link rel="stylesheet" type="text/css" href ="http://cdn.jsdelivr.net/qtip2/3.0.3/jquery.qtip.min.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript"src="http://classes.engineering.wustl.edu/cse330/content/calendar.min.js"></script>
        <script type ="text/javascript" src = "http://cdn.jsdelivr.net/qtip2/3.0.3/jquery.qtip.min.js"></script>
        <!--<script type ="text/javascript" src = "startSession.js"</script> -->
    </head>
    <body>

  
    <div id = "calendar">
        <div id = "month_changer">
            <span id = "prev" class = "arrows"> prv </span>
            <span id = "current_month">JAN</span> 
            <span id = "current_year">2017</span>
            <span id = "next" class = "arrows"> nxt </span>
        </div>
        <br>
        <table id = "cal">
            <tr id = "weekdays">
                <th>Su</th>
                <th>Mn</th>
                <th>Tu</th>
                <th>Wd</th>
                <th>Th</th>
                <th>Fr</th>
                <th>Sa</th>
            </tr>
        <!-- The idea is to list out all possible days
        for the largest possible 6-week span, setting days to be some form of null when those days don't exist for a particular month -->
            <tr>
                <th id = "0" class= "days"></th>  
                <th id = "1" class= "days"></th>
                <th id = "2" class= "days"></th>
                <th id = "3" class= "days"></th>
                <th id = "4" class= "days"></th>
                <th id = "5" class= "days"></th>
                <th id = "6" class= "days"></th>
            </tr>
            <tr>
                <th id = "7" class= "days"></th>  
                <th id = "8" class= "days"></th>
                <th id = "9" class= "days"></th>
                <th id = "10" class= "days"></th>
                <th id = "11" class= "days"></th>
                <th id = "12" class= "days"></th>
                <th id = "13" class= "days"></th>
            </tr>
            <tr>
                <th id = "14" class= "days"></th>  
                <th id = "15" class= "days"></th>
                <th id = "16" class= "days"></th>
                <th id = "17" class= "days"></th>
                <th id = "18" class= "days"></th>
                <th id = "19" class= "days"></th>
                <th id = "20" class= "days"></th>
            </tr>
            <tr>
                <th id = "21" class= "days"></th>  
                <th id = "22" class= "days"></th>
                <th id = "23" class= "days"></th>
                <th id = "24" class= "days"></th>
                <th id = "25" class= "days"></th>
                <th id = "26" class= "days"></th>
                <th id = "27" class= "days"></th>
            </tr>
            <tr>
                <th id = "28" class= "days"></th>  
                <th id = "29" class= "days"></th>
                <th id = "30" class= "days"></th>
                <th id = "31" class= "days"></th>
                <th id = "32" class= "days"></th>
                <th id = "33" class= "days"></th>
                <th id = "34" class= "days"></th>
            </tr>
            <tr>
                <th id = "35" class= "days"></th>  
                <th id = "36" class= "days"></th>
                <th id = "37" class= "days"></th>
                <th id = "38" class= "days"></th>
                <th id = "39" class= "days"></th>
                <th id = "40" class= "days"></th>
                <th id = "41" class= "days"></th>
            </tr>
        </table>
    </div>
    <br>
    <div class = "loginSection">
        <span>
            username:
            <input type="text" id = "username" name="username" value="">
        </span>
        <span>
            password:
            <input id = "pw" type="password" name="password" value="">
        </span>
        <span id = "login">login</span>
    </div>
    <br>
    <div class = "registerSection" >
         new user?
        <form>
            <span>
                username:
                <input type="text" id = "reg_username" name="username" value="">
            </span>
            <span>
                email:
                <input type="text" id = "email" name="email" value="">
            </span>
            <span>
                password:
                <input id = "reg_pw" type="password" name="password" value="">
            </span>   
        <span id = "register">register</span>
        </form> 
    </div>
    <script>
        var realTime = new Date();
        var realMonth = realTime.getMonth();
        var realYear = realTime.getFullYear();
        //alert(realMonth);
        var currentMonth = new Month(realYear, realMonth);
        updateCalendar();
        
        document.getElementById("next").addEventListener("click", function(){
            currentMonth = currentMonth.nextMonth(); // Previous month would be currentMonth.prevMonth()
            updateCalendar(); // Whenever the month is updated, we'll need to re-render the calendar in HTML
        }, false);
        
         document.getElementById("prev").addEventListener("click", function(){
            currentMonth = currentMonth.prevMonth(); // Previous month would be currentMonth.prevMonth()
            updateCalendar(); // Whenever the month is updated, we'll need to re-render the calendar in HTML
        }, false);
         
        function numberToMonth(num){
            switch(num) {
                case 0: return "JAN";
                case 1: return "FEB";
                case 2: return "MAR";
                case 3: return "APR";
                case 4: return "MAY";
                case 5: return "JUN";
                case 6: return "JUL";
                case 7: return "AUG";
                case 8: return "SEP";
                case 9: return "OCT";
                case 10: return "NOV";
                case 11: return "DEC";
                default: return "JAN";
            }
        }
        // This updateCalendar() function only alerts the dates in the currently specified month.  You need to write
        // it to modify the DOM (optionally using jQuery) to display the days and weeks in the current month.
        function updateCalendar(){
           var weeks = currentMonth.getWeeks();
           var index = 0;
            var monthGoingOn = false;
           var memoMonth = null;
           var monthPassed= false;
            for(var w in weeks){
                var days = weeks[w].getDates();
  
                for(var i = 0; i < 7; i++){
                    if (days[i].getDate() == 1 && !monthPassed){
                        monthGoingOn = true;
                        monthPassed = true;
                        memoMonth = days[i].getMonth();
                        document.getElementById("current_month").innerHTML = numberToMonth(memoMonth);
                        document.getElementById("current_year").innerHTML = days[i].getFullYear();
                    }
                    if (days[i].getMonth() > memoMonth){
                        monthGoingOn = false;
                    }
                    var dayCell = document.getElementById(index);
                    if (monthGoingOn){
                        dayCell.style.outline = "solid";
                        dayCell.innerHTML = days[i].getDate();
                    }
                    
                    else {
                        dayCell.style.outline = "none";
                        dayCell.innerHTML = "";
                    }
                    index++;
                }
            }
            for (var j = index; j<42; j++){
                var emptyCell = document.getElementById(j);
                emptyCell.innerHTML = "";
                emptyCell.style.outline = "none";
              //  alert(j);     
            }
        }
        
        document.getElementById("login").addEventListener("click", attemptLogIn,false);
        document.getElementById("register").addEventListener("click", attemptRegister,false);
        function loginCallBack(event){
           alert(event.target.responseText);
        }
        function regCallBack(event){
            var msg = JSON.parse(event.target.responseText);
            alert(event.target.responseText);
            if (msg.status == "error_username"){
                showQtip("reg_username","Invalid Username; please only use alpha-numerical characters,'_',and '-'.");
            }
            if (msg.status == "error_email"){
                showQtip("email","Email is invalid!");
            }
            if (msg.status == "error_password"){
                showQtip("reg_pw","Invalid Password; please only use non-empty alpha-numerical characters, '@','', '_',and '-'.");
            }
            if(msg.status == "error_register"){
                showQtip("register","Could not register. Email or username may have been registered already.");
            }
            if(msg.status =="sucess"){
               // showQtip("register","Sucess! You may now log-in.");
               alert("Sucess! You may now log-in.");
            }
        }
        
        function attemptLogIn(){
            $('div.qtip:visible').qtip('hide');
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open("POST", "login.php", true);
            xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlHttp.addEventListener("load", loginCallBack, false);
            xmlHttp.send(encodeURI("username="+ encodeURIComponent($("#username").val()) +"&password=" + encodeURIComponent($("#pw").val())));
           
        }
        function attemptRegister(){
            $('div.qtip:visible').qtip('hide');
            var regXmlHttp = new XMLHttpRequest();
            regXmlHttp.open("POST", "register.php",true);
            regXmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            regXmlHttp.addEventListener("load",regCallBack,false);
            regXmlHttp.send("username="+ encodeURIComponent($("#reg_username").val())+ "&password="+ encodeURIComponent($("#reg_pw").val())+ "&email="+ encodeURIComponent($("#email").val()));
        }
        
        //stackoverflow user 'amorhs" demonstrated how to define qtip turn on and turn off properties
        //http://stackoverflow.com/questions/5060955/automatically-show-qtip-jquery-plugin-tooltip-after-page-load
        function showQtip(id, message){
         $("#"+ id).qtip({
            content: message,
            show: { when: false, ready: true },
            hide: false
            });
        }
        

    </script>
    </body>
</html>
