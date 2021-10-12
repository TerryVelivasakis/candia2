
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<meta http-equiv="refresh" content="1800" >
<style>
body {
  background-image: url("/img/dirbg.jpg");
  background-repeat: no-repeat;
  background-attachment: fixed;
	background-size: cover;0
  font-family: 'Lato', sans-serif;
}

div.time{
	position: absolute;
	top: -5px;
}

div {
	font-family: 'Lato', sans-serif;

}

.greeting{
	position: absolute;
	left: 15%;
  font-size: 100px;
  Height: 7.25%;
	width: 63%;
	overflow: hidden;

  box-sizing: border-box;

}

.weather{
	position: absolute;
	top: -8.9px;
	left: 79.1%;
	Height: 2.25%;
	Width: 400px;

}

.main{
	position: absolute;
  top: 10.25%;
	width: 95%;

}
.ann{
	position: absolute;
	top: 37%;
	width: 31.5%;
	left: 1%
}
.ten1{
	position: absolute;
	top: 10.25%;
	width: 32%;
	left: 34%
}
.ten2{
	position: absolute;
	top: 10.25%;
	width: 32%;
	left: 67.5%
}
.news{
	position: absolute;
	top: 87.2%;
	width: 89%;
	height: 4.4%
  
}
.contact{
	position: absolute;
	top: 92.5%;
	width: 90%;
}



h1 {
font-size: 24px;
font-family: 'Lato', sans-serif;
}




</style>
<body onload="shrink()">
<div class='greeting' id="dynamicDiv"><center>
<span id="dynamicSpan">Welcome</span></center>
</div>

<div id="txt" class="time">
	<table>
	  <tr>
	    <th rowspan="5" style='font-size: 80px;'>27&nbsp</th>
	    <th>&nbsp</th>
	  </tr>
	  <tr>
	    <td><?php echo date("l") ?></td>
	  </tr>
	  <tr>
	    <td><?php echo date("F") ?></td>
	  </tr>
	  <tr>
	    <td><span id="clock">&nbsp;</span></td>
	  </tr>
	  <tr>
	    <td>&nbsp</td>
	  </tr>
	</table>
</div>

<div class="weather">
	<a class="weatherwidget-io" href="https://forecast7.com/en/27d91n82d79/largo/?unit=us" data-days="3" data-theme="gray" data-basecolor="#d5b802" data-highcolor="#9a352b" data-lowcolor="#58585a" data-suncolor="#58585a" data-raincolor="#005996" >Largo, FL, USA</a>
	<script>
	!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
	</script>
</div>

<div class="ann">
Announcements
<hr>
</div>

<div class="ten1">
Tenant 1
<hr>
</div>
<div class="ten2">
Tenant 2
<hr>
</div>

<div class="news">
	<script type="text/javascript">
	<!--
	rssfeed_url = new Array();
	rssfeed_url[0]="https://news.google.com/news/rss";
	rssfeed_frame_width="95%";
	rssfeed_frame_height="100%";
	rssfeed_scroll="on";
	rssfeed_scroll_step="6";
	rssfeed_scroll_bar="off";
	rssfeed_target="_blank";
	rssfeed_font_size="auto";
	rssfeed_font_face="font-family: 'Lato', sans-serif";
	rssfeed_border="off";
	rssfeed_css_url="";
	rssfeed_title="off";
	rssfeed_title_name="";
	//rssfeed_title_bgcolor="#fff";
	//rssfeed_title_color="#fff";
	rssfeed_title_bgimage="";

	rssfeed_item_title_length="150";
	rssfeed_item_title_color="#fff";
	//rssfeed_item_bgcolor="#58585a";
	rssfeed_item_bgimage="";
	rssfeed_item_border_bottom="off";
	rssfeed_item_source_icon="off";
	rssfeed_item_date="off";
	rssfeed_item_description="on";
	rssfeed_item_description_length="1000";
	rssfeed_item_description_color="#fff";
	rssfeed_item_description_link_color="#333";
	rssfeed_item_description_tag="off";
	rssfeed_no_items="0";
	rssfeed_cache = "4af2a4b76e72853f61483bde168a2e3b";
	//-->
	</script>
	<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script>

</div>
<div class="contact">
contact
<hr>
</div>

<script type="text/javascript">
    function shrink()
    {
        var textSpan = document.getElementById("dynamicSpan");
        var textDiv = document.getElementById("dynamicDiv");

        textSpan.style.fontSize = 64;

        while(textSpan.offsetHeight > textDiv.offsetHeight)
        {
            textSpan.style.fontSize = parseInt(textSpan.style.fontSize) - 1;
        }
    }


function updateClock ( )
{
  var currentTime = new Date ( );

  var currentHours = currentTime.getHours ( );
  var currentMinutes = currentTime.getMinutes ( );
  var currentSeconds = currentTime.getSeconds ( );

  // Pad the minutes and seconds with leading zeros, if required
  currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
  currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

  // Choose either "AM" or "PM" as appropriate
  var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

  // Convert the hours component to 12-hour format if needed
  currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

  // Convert an hours component of "0" to "12"
  currentHours = ( currentHours == 0 ) ? 12 : currentHours;

  // Compose the string for display
  var currentTimeString = currentHours + ":" + currentMinutes + ":"  + timeOfDay;

  // Update the time display
  document.getElementById("clock").firstChild.nodeValue = currentTimeString;

setTimeout(updateClock, 500)
}
updateClock()
// -->
</script>
