<?php
$sql = "SELECT * FROM constants";
$result = $db->query($sql);
while ($row = $result->fetch_assoc()){

${$row['varName']} = floatval($row['value']);
}


function mb_escape( $string){
if (is_null($string)){
  return "";
}else{
  return mb_ereg_replace('[\x00\x0A\x0D\x1A\x22\x27\x5C]', '\\\0', $string);}
}
?>
<script>
var currencyFormatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',

  // These options are needed to round to whole numbers if that's what you want.
  minimumFractionDigits: 2, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
  maximumFractionDigits: 2, // (causes 2500.99 to be printed as $2,501)
});



const SalesTax = <?php echo $salesTaxRate;?>

$( document ).ready(function() {
  $( ".phone" ).focusout( function() {

    phone = $(this).val();

    var phoneTest = new RegExp(/^((\+1)|1)? ?\(?(\d{3})\)?[ .-]?(\d{3})[ .-]?(\d{4})( ?(ext\.? ?|x)(\d*))?$/);

    phone = phone.trim();
    var results = phoneTest.exec(phone);
    console.log(phone);
    if (results !== null && results.length > 8) {

      $(this).val( "(" + results[3] + ") " + results[4] + "-" + results[5] + (typeof results[8] !== "undefined" ? " x" + results[8] : ""));

    }
    else {
       $(this).val( phone);
    }

  });
});

</script>

<?php
function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);

    $interval = date_diff($datetime1, $datetime2);

    return $interval->format($differenceFormat);

}

$sql = "SELECT * FROM `property`";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
  $propertynick[$row['propertyID']] = $row['propertyNickname'];
}

?>
