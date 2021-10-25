<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.19/features/pageResize/dataTables.pageResize.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="../style/styledir.css">
<meta http-equiv="refresh" content="1800" >

<style>
.contact{position: absolute;top: 92.5%;width: 90%;height: 5.4%;font-size: 100px;}
body {background-image: url("/directory/img/dirbgCT1.jpg");background-repeat: no-repeat;background-attachment: fixed;background-size: cover;font-family: 'Lato', sans-serif;}
div.time{position: absolute;top: -5px;}
div {font-family: 'Lato', sans-serif;}
table.ten td, table.ten tr, table.ten th{background: transparent !important;border: 0px !important;padding: 3px !important;}
table.ten td{border-bottom: 1px solid #ddd !important;}
.greeting{position: absolute;left: 21%;font-size: 100px;Height: 7.25%;width: 58%;overflow: hidden;box-sizing: border-box;}
.weather{position: absolute;top: -8.9px;left: 79.1%;Height: 2.25%;Width: 400px;}
.main{position: absolute;top: 10.25%;width: 95%;}
.annh{position: absolute;top: 32%;width: 31.5%;left: 1%;height: 54%;}
.annb{position: absolute;top: 40%;width: 31.5%;left: 1%;height: 45%;overflow: hidden;}
.ten1{position: absolute;top: 10.25%;width: 32%;left: 34%;height: 75%;margin: 0 auto;overflow: hidden;}
.ten2{position: absolute;top: 10.25%;width: 32%;left: 67.5%;height: 75%;margin: 0 auto;overflow: hidden;}
.news{position: absolute;top: 87.2%;width: 89%;height: 4.4%}
.contact{position: absolute;top: 92.5%;width: 90%;height: 5.4%;font-size: 100px;}
table.tentable, th.tentable, td.tentable{width: 100%; height: 100%; border:3px red double;}
h1 {font-size: 24px;font-family: 'Lato', sans-serif;}
div.dataTables_length {display: none;}
</style>

<body>
<div class='greeting' id="dynamicDiv"><center>
<span id="dynamicSpan"></span></center>
</div>

<div id="txt" class="time">
	<table>
	  <tr>
	    <th rowspan="5" style='font-size: 80px;'><?php echo date("d") ?>&nbsp</th>
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

<div class="annh" id="annh">
<center><h2>Announcements</h2></center>
<hr>
</div>
<iframe id="annc" class="annb" src="..\directory\announcements.php" frameborder="0" scrolling="no" style="overflow: hidden"></iframe>

<div class="ten1">
	<table id="ten1" class="ten" style="width:100%">
	        <thead>
	            <tr>
	                <th></th>
	                <th width="90%"></th>

	            </tr>
	        </thead>
	<tbody>
	<?php
	require $_SERVER["DOCUMENT_ROOT"].'/includes/dbconfig.php';
	$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');



  $result = mysqli_query($dirDB, "SELECT * FROM Tenants ORDER BY Line1");


    while($row = mysqli_fetch_array($result)) {

  echo '<tr><td height="47" style="vertical-align:middle"><b>'.$row['Suite'].'<b></td>
	<td>'.$row['Line1'].'<br>';
	if ($row['Line2'] == ""){
	echo '<i>'.$row['Line2'].'</td></tr>';
}else{
	echo '<i>&nbsp &nbsp &nbsp '.$row['Line2'].'</td></tr>';
}
}

  ?>
</tbody>


    </table>

</div>


<div class="ten2">
	<table id="ten2" class="ten" style="width:100%">
	        <thead>
	            <tr>
	                <th></th>
	                <th width="90%"></th>

	            </tr>
	        </thead>
	<tbody>
	<?php


  $result = mysqli_query($dirDB, "SELECT * FROM Tenants ORDER BY Line1");


    while($row = mysqli_fetch_array($result)) {

  echo '<tr><td height="47" style="vertical-align:middle"><b>'.$row['Suite'].'<b></td>
	<td>'.$row['Line1'].'<br>';
	if ($row['Line2'] == ""){
	echo '<i>'.$row['Line2'].'</td></tr>';
}else{
	echo '<i>&nbsp &nbsp &nbsp '.$row['Line2'].'</td></tr>';
}
}

  ?>
</tbody>


    </table>

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
	rssfeed_item_description_length="500";
	rssfeed_item_description_color="#fff";
	rssfeed_item_description_link_color="#333";
	rssfeed_item_description_tag="off";
	rssfeed_no_items="0";
	rssfeed_cache = "4af2a4b76e72853f61483bde168a2e3b";
	//-->
	</script>
	<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script>

</div>


<div class='contact' id='condiv'><center>
<span id='conspan'></span></center>
</div>



<script type="text/javascript">

function updateClock ( ){
  var currentTime = new Date ( );
  var currentHours = currentTime.getHours ( );
  var currentMinutes = currentTime.getMinutes ( );
  var currentSeconds = currentTime.getSeconds ( );
  currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
  currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
  var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
  currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
  currentHours = ( currentHours == 0 ) ? 12 : currentHours;
  var currentTimeString = currentHours + ":" + currentMinutes + " "  + timeOfDay;
  document.getElementById("clock").firstChild.nodeValue = currentTimeString;
setTimeout(updateClock, 500)
}
updateClock()





$(document).ready(function() {
	for (var i = 1; i <= 2; i++) {
		$('#ten'+i).DataTable( {
			"scrollY": "850px",
			"scrollCollapse": false,
			"ordering": false,
			"info":     false,
			"searching": false,
			"pageLength": 17
		} );
	}

} );

$(document).ready(function (){
    var table = $('#ten1').DataTable();
    setInterval(function(){
       var info = table.page.info();
       var pageNum = (info.page < info.pages) ? info.page + 1 : 1;
       table.page(pageNum).draw(false);
    }, 10000);

});

$(document).ready(function (){
    var table = $('#ten2').DataTable();
		var info = table.page.info();
		var pageNum = (info.page < info.pages) ? info.page + 1 : 1;
		table.page(pageNum).draw(false);
    setInterval(function(){
       var info = table.page.info();
       var pageNum = (info.page < info.pages) ? info.page + 1 : 1;
       table.page(pageNum).draw(false);
    }, 10000);

		setInterval(function(){
document.getElementById('annc').contentWindow.location.reload();
}, 15000);

});


console.log(document.getElementById('annh').clientWidth);
$(document).ready(function (){



<?php



$result = mysqli_query($dirDB, "SELECT * FROM Contact");
	while($row = mysqli_fetch_array($result)) {
$contact = "Management and Leasing | " .$row['Name']." | Suite " .$row['Suite']." | " .$row['Number'];
		echo 'document.getElementById(\'dynamicSpan\').innerHTML="'.$row['Greeting'].'";';
		echo 'document.getElementById(\'conspan\').innerHTML="'.$contact.'";';

}



?>
	var textSpan = document.getElementById("dynamicSpan");
	var textDiv = document.getElementById("dynamicDiv");
	textSpan.style.fontSize = 64;
	while(textSpan.offsetHeight > textDiv.offsetHeight)
	{
			textSpan.style.fontSize = parseInt(textSpan.style.fontSize) - 1;
	}

	var textSpan = document.getElementById("conspan");
	var textDiv = document.getElementById("condiv");
  document.getElementById("conspan").style.fontSize = 64;
	while(textSpan.offsetHeight > textDiv.offsetHeight)	{
			textSpan.style.fontSize = parseInt(textSpan.style.fontSize) - 1;
	}

});


</script>
