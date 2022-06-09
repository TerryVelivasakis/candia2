<?php require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/dbconfig.php';
//require $_SERVER["DOCUMENT_ROOT"].'/includes/cookie.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/bootstrap.php';
require $_SERVER["DOCUMENT_ROOT"].'/php+js/generalFunctions.php';
//$_GET['q']=2;
$q = $_GET['q'];

$result = mysqli_query($dirDB, "SELECT * FROM Contact WHERE ID = ".$q);
while($row = mysqli_fetch_array($result)) {
$contact = "Management and Leasing &emsp; | &emsp; " .$row['Name']." &emsp; | &emsp; Suite " .$row['Suite']." &emsp; | &emsp; " .$row['Number'];
$bldgSil = $row['silhouette'];
$bldgLogo = $row['logo'];
$weather = $row['weather'];
$greeting = $row['Greeting'];
}


//$bldgSil = "\directory\img\CTsil.jpg";
//$bldgLogo = "\img\logo\\tower.png";
//$weather = "https://forecast7.com/en/28d19n82d74/holiday/?unit=us";

// https://forecast7.com/en/27d91n82d79/largo/?unit=us
// https://forecast7.com/en/28d19n82d74/holiday/?unit=us

?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
<script src="/php+js/jquery.webticker.min.js"></script>
<style>
.topline{background-color: #d5b802;left: 0;top: 0;height: 110px;width: 100%;position: absolute;}
.weather{right: 0; top: 0; width: 500px; height: inherit;position: absolute;}
.clock{left: 0; top: 0; width: 500px; height: inherit;position: absolute; }
.greeting{ left: 250px; top: 0; width: calc(100vw - 750px); height: inherit;position: absolute;}
.spanGreeting{display:table; margin:0 auto;}
.centered{display:table; margin:0 auto;}
.mainDiv{margin-top: 110;}
.mainSection{padding-left: 2%; padding-right: 2%; border: 1px solid white; background-color:#a8a9ad; height: calc(100vh - 235px); position: absolute; overflow: hidden !important;}
img.bldgLogo {display: block; margin-left: auto; margin-right: auto; max-height: 95%}
.news{background-color: #58585a; left:0; bottom:80px;  width:100%; height: 45px; position: absolute;}
.accent{background-color: #28585a; left:0; bottom:75px;  width:100%; height: 5px; position: absolute;}
.headline{color: white; margin: -5px 1px -5px 25px; font-weight: bold; font-size: 18pt}
.article{color: white; margin: -10px 1px 2px 35px;}
.bordered{border: 1px solid red}
.candialion{right: 0; bottom: 0; position: absolute; height: 125px; z-index: 2;}
.bldgSil{width: 75%; left: 0; bottom: 0; position: absolute; z-index: 0;}
.anntext{text-align:center; z-index: 2; position: absolute; margin-right: 7%;}
.contactPAN{top:0; position: absolute;}
.leasingMessage{padding-top:7px; bottom:0; height: 75px; width:91%; position: absolute; text-align:center;}
ul{font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif !important;font-size: 20px !important; color: white; font-weight: 100 !important;}
body{overflow: hidden;}
table.dataTable td {
  font-size: 18pt;
}

 /* div{border: 1px solid red} */
</style>
<img class = candialion src="\img\directory\candiaLion.png">
<div class = 'topline'>

	<div class="clock">
		<table>
		  <tr><th rowspan="5" style='font-size: 80px;'><?php echo date("d") ?>&nbsp</th><th>&nbsp</th></tr>
		  <tr><td><?php echo date("l") ?></td></tr>
		  <tr><td><?php echo date("F") ?></td></tr>
		  <tr><td><span id="clock">&nbsp;</span></td></tr>
		  <tr><td>&nbsp</td></tr>
		</table>
	</div>
<div class='greeting' id='divGreeting'><span class=spanGreeting id=spanGreeting><?php echo $greeting ?></span> </div>
	<div class="weather " style='border-left: 1px solid white'>
		<a class="weatherwidget-io" href="<?php echo $weather;?>" data-font="Roboto" data-icons="Climacons Animated" data-days="3" data-theme="orange" data-basecolor="#d5b802" data-cloudcolor="#58585a" data-cloudfill="#a8a9ad" data-raincolor="#00515f" >Holiday, FL, USA</a>
		<script>
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
		</script>
	</div>
</div>

<div class="mainDiv">
<div class="mainSection" style ="left:0; width: 32%;">
<div style='height: 28%; border-bottom: 1px solid white'><img class = bldgLogo src="<?php echo $bldgLogo;?>"></div>
<div  style='height: 8%; padding-top: 5px'><h3 class=centered>Announcements</h3></div>





<!-- ANNOUNCEMENTS -->
<div id=anndiv  style='height: 65%'><img style="max-width: 100%" class = bldgSil src="<?php echo $bldgSil;?>">
	<div class=anntext>
		<div id = annWrapper style="z-index: 5; height: 500px; width:535px">
			<div id=annimage></div>
			<div id=divwords style = 'height: 325px; padding-top: 15px'><span id=pwords ></span></div>
		</div>
	</div>
	</div>
</div>
<!-- ANNOUNCEMENTS -->







<div class="mainSection" style ="left: calc(32% ); width: calc(34% )">
	<table id="ten1" class="ten" style="width:100%">
	<thead>
	<tr>
	<th></th>
	<th width="90%"></th>
	</tr>
	</thead>
	<tbody>
	<?php

	#require $_SERVER["DOCUMENT_ROOT"].'/includes/dbconfig.php';
	#$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	#$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$result = mysqli_query($dirDB, "SELECT * FROM Tenants WHERE propertyID = ".$_GET['q']." ORDER BY Line1");
	while($row = mysqli_fetch_array($result)) {
	echo '<tr><td height="47" style="vertical-align:middle"><b>'.$row['Suite'].'<b></td>
	<td>'.$row['Line1'].'<br>';
	if ($row['Line2'] == ""){echo '<i>'.$row['Line2'].'</td></tr>';}else{echo '<i>&nbsp &nbsp &nbsp '.$row['Line2'].'</td></tr>';}
	}
	//*/?>
	</tbody>
	</table>
</div>
<div class="mainSection" style ="right:0; width: 34%">
	<table id="ten2" class="ten" style="width:100%">
	<thead>
	<tr>
	<th></th>
	<th width="90%"></th>
	</tr>
	</thead>
	<tbody>
	<?php

	#require $_SERVER["DOCUMENT_ROOT"].'/includes/dbconfig.php';
	#$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	#$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$result = mysqli_query($dirDB, "SELECT * FROM Tenants WHERE propertyID = ".$_GET['q']." ORDER BY Line1");
	while($row = mysqli_fetch_array($result)) {
	echo '<tr><td height="47" style="vertical-align:middle"><b>'.$row['Suite'].'<b></td>
	<td>'.$row['Line1'].'<br>';
	if ($row['Line2'] == ""){echo '<i>'.$row['Line2'].'</td></tr>';}else{echo '<i>&nbsp &nbsp &nbsp '.$row['Line2'].'</td></tr>';}
	}
	//*/?>
	</tbody>
	</table></div>

</div>
<div class="news"><ul id=webTicker><?php $rss_feed = simplexml_load_file("https://news.google.com/rss");
if(!empty($rss_feed)) {$i=0;
foreach ($rss_feed->channel->item as $feed_item) {
if($i>=200) break;
?>
<li><span><?php echo $feed_item->title ."&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;   "; ?></span></li>
<?php $i++;}}?>
</ul></div>
<div class=accent></div>

<div class=leasingMessage id=contactDIV><span id=contactSPAN class=contactSPAN ><?php echo $contact; ?></span></div>

<script>
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
$(document).ready(function (){
	$('#webTicker').webTicker({height:'45px'});
updateClock()
function fontSizer(spanID, divID, maxFont){
	var textSpan = document.getElementById(spanID);
	var textDiv = document.getElementById(divID);
	textSpan.style.fontSize = maxFont;
	while(textSpan.offsetHeight > textDiv.offsetHeight){
		textSpan.style.fontSize = parseInt(textSpan.style.fontSize) - 1;
	}
}
fontSizer('spanGreeting','divGreeting', 150);
fontSizer('pwords','divwords', 35);
fontSizer('contactSPAN','contactDIV', 50);
$('.ten').DataTable( {
	"scrollY": "850px",
	"bLengthChange": false,
	"scrollCollapse": false,
	"ordering": false,
	"info":     false,
	"searching": false,
	"pageLength": 17

} );

function ChangePage(tbl){
	var table = $('#'+tbl).DataTable();
  var info = table.page.info();
  var pageNum = (info.page < info.pages) ? info.page + 1 : 1;
  table.page(pageNum).draw(false);
  }
ChangePage('ten2');

setInterval(function(){ChangePage('ten1');ChangePage('ten2');}, 10000);
		//alert("Your screen resolution is: " + screen.width + "x" + screen.height);

});
</script>
