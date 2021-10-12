<head>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="../src/jquery.fittext.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



</head>
<style>

.aspectwrapper {
  display: inline-block; /* shrink to fit */
  width: 605px;           /* whatever width you like */
  height:486px;
  position: relative;    /* so .content can use position: absolute */


}
.aspectwrapper::after {
  padding-top: 56.25%; /* percentage of containing block _width_ */
  display: block;
  content: ''
}
.content {
  position: absolute;
  top: 0; bottom: 0; right: 0; left: 0;  /* follow the parent's edges */
  outline: thin dashed green;            /* just so you can see the box */
}


div {
  width: 575px;
  text-align: center;
  font-family: 'Lato', sans-serif;

}
.texty {

}







</style>

<body>

  <?php


  include $_SERVER['DOCUMENT_ROOT']."/includes/dirconfig.php";

  $dbname = "WBdirectory";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection


  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }





$result = mysqli_query($conn, "SELECT * FROM Announcements WHERE RunUntil >='".date("Y-m-d H:i:s")."' and RunFrom <='".date("Y-m-d H:i:s")."' ORDER BY RAND() LIMIT 1");
//$result = mysqli_query($conn, "SELECT * FROM Announcements WHERE AnnID= 1"); //text no image
//$result = mysqli_query($conn, "SELECT * FROM Announcements WHERE AnnID= 5"); // image no text
//$result = mysqli_query($conn, "SELECT * FROM Announcements WHERE AnnID= 4"); // image and text

// date("Y-m-d H:i:s")
//echo mysqli_num_rows($result);
while($row = mysqli_fetch_array($result)) {

//height:486; width:605;
//echo "SELECT * FROM Announcements ORDER BY RAND() WHERE RunUntil <='".date("Y-m-d H:i:s")."' LIMIT 1";
$words = str_replace("<br>","",$row['Announcement']);
$image = $row['Annimg'];


if ($words <> "" && $image <> "") {
echo '<div class="aspectwrapper">';
echo '<div id="img" height="40%">';
echo '<center><img src='.$image.' class="img-responsive" alt="" style="max-height: 194px; max-width: 605px;">';
echo '</div>';
echo '<div id="words" class="text"  style="border: 1px solid blue; height: 292px">';
echo '<div id="words2" class="text">';
echo $words;

echo '</div>';
echo '</div>';
echo '</div>';
}

if ($words == "" && $image <> "") {
echo '<div class="aspectwrapper">';
echo '<div id="img" height="100%">';
echo '<center><img src='.$image.' class="img-responsive" alt="" style="max-height: 486px; max-width: 605px;">';
echo '</div>';
echo '<div id="words" height="0%">';
echo '<div id="words2" class="text">';

echo '</div>';
echo '</div>';
echo '</div>';
}


if ($words <> "" && $image == "") {

  //echo $words;
  echo '<div class="aspectwrapper">';
  echo '<div id="words" class="texty" style="height:486px; border: 1px solid red">';

  echo '<div id="words2" class="text">';
  echo '<span>';
  echo $words;
  echo '</span>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
}

}

  ?>

</body>
<script>
var autoSizeText = function () {
    var el, elements, _i, _len;
    elements = $('#words');
    if (elements.length < 0) {
        return;
    }
    for (_i = 0, _len = elements.length; _i < _len; _i++) {
        el = elements[_i];
        dichoFit = function (el) {

            diminishText = function () {
                var elNewFontSize;
                elNewFontSize = (parseInt($(el).css('font-size').slice(0, -2)) - 1) + 'px';

                return $(el).css('font-size', elNewFontSize);
            };
            augmentText = function () {
                var elNewFontSize;
                elNewFontSize = (parseInt($(el).css('font-size').slice(0, -2)) + 1) + 'px';

                return $(el).css('font-size', elNewFontSize);
            };


            diminishText();
            while (el.scrollHeight < el.offsetHeight) {
                augmentText();
            }
            augmentText();
            while (el.scrollHeight > el.offsetHeight) {
                diminishText();
            }

        }
        dichoFit(el);
    }
};

$(document).ready(function () {
    autoSizeText();
    $(window).resize(function resizeText(){
        autoSizeText()
    })
});
document.getElementById('words').style.borderColor="transparent";
</script>
