<?php

$result = mysqli_query($dirDB, "SELECT * FROM Announcements WHERE PropertyID = ".$q);
while($row = mysqli_fetch_array($result)) {

$AnnImg = $row['Annimg'];
$AnnTxt = $row['Announcement'];
if ($AnnTxt != "" AND $AnnImg !=""){
$announcmentHTML[]="<div><img src='$AnnImg' style='max-width: 95%; max-height:35%'></div>";
	//text and image
//	$announcmentHTML[]="<div></div>"
} elseif($AnnTxt == "" AND $AnnImg !=""){
$announcmentHTML[]="<img src='$AnnImg' style='max-width: 95%; max-height:95%'>";
	//Image only
}elseif ($AnnTxt != "" AND $AnnImg =="") {
	//text only


}
}
