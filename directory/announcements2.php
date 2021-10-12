<head>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



</head>
<style>

.aspectwrapper {
  display: inline-block; /* shrink to fit */
  width: 605px;           /* whatever width you like */
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


#evverdiv {
  position:fixed !important;
  position:absolute;
  top:0;
  right:0;
  bottom:0;
  left:0;
  height:486; width:605; white-space:normal; overflow:hidden;
  text-align: center;
  font-family: 'Lato', sans-serif;
  font-size: 50px;
}

#outer {
    position: relative;
    height:486; width:605; white-space:normal; overflow:hidden;
    -webkit-transform-origin: top left;
}
#inner {

}
#text {
    font-size: 40px;
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





$result = mysqli_query($conn, "SELECT * FROM Announcements WHERE RunUntil >='".date("Y-m-d H:i:s")."' ORDER BY RAND() LIMIT 1");
//$result = mysqli_query($conn, "SELECT * FROM Announcements WHERE AnnID= 12");
// date("Y-m-d H:i:s")
//echo mysqli_num_rows($result);
while($row = mysqli_fetch_array($result)) {

//echo "SELECT * FROM Announcements ORDER BY RAND() WHERE RunUntil <='".date("Y-m-d H:i:s")."' LIMIT 1";
$q = str_replace("<br>","",$row['Announcement']);


echo '<div class="aspectwrapper">';
echo '<div class="content">';


echo '<img src="https://cdn.dribbble.com/users/500242/screenshots/3252494/moody-pizza.gif" style="width:100%;height:100%;"><br>';
echo '<p>I\'m sorry for all the weird announcements, I\'m working it to make it better!</p>';
echo '</div>';
echo '</div>';

/*
echo "<div id='mainspot' class='mainspot' style='border: 1px solid'>";
echo '<div ="inner">';
//echo '<div id="inner" style ="height: 100%, width: 100%">';
    echo '<img src="https://cdn.dribbble.com/users/500242/screenshots/3252494/moody-pizza.gif" ><br>';
    echo "I'm sorry for all the weird announcements, I'm working it to make it better!";
echo '</div>';
echo '</div>';



echo '<script>';
echo "$('#test').each(function(){";
    echo 'var $this = $(this);';
    echo 'var t = $this.text();';
    echo '$this.html(t.replace(\'&lt;\',\'<\').replace(\'&gt;\', \'>\'));';
echo '});';
echo '</script>';*/
}

  ?>

</body>
<script>



</script>
