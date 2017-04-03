# Calendar-Web-App
Calendar that allows users to add and remove events dynamically.


Link here: http://ec2-35-167-126-39.us-west-2.compute.amazonaws.com/module5/group/calendar.html
Additional Features:
1) 10-day Weather forecast is integrated into the the calendar itself and will show up when user mouseovers the day. This was set up using Apixu, which given city name or zipcode submitted through GET, returns a JSON string of weather forecast. Since Apixu provided us with an unique (albeit free) API access code, the user first interacts with our server (through register.php) which fetches the JSON string from Apixu. If the temp seems a little low, it's because we chose the average temp throughout the entire 24 hours (night included).
2) Using the qtip API, we implemented nice feedback "tooltip" system for user inputs. i.e. successful log-in, bad registration due to invalid email, successful completion of weather request...etc.
3) The user can flag important events (also editable) and it will show up as a bubble (literally flagged) on the main calendar UI (before user clicks in to view the titles of events.)
4) The current day according to local time is highlighted. In addition, the user always starts out on the currently month according to local time.
