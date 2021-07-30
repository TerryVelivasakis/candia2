<?php
$sql = "SELECT * FROM constants";
$result = $db->query($sql);
while ($row = $result->fetch_assoc()){

${$row['varName']} = floatval($row['value']);
}

function formatPhone($ph){if(preg_match( '/^\+\d(\d{3})(\d{3})(\d{4})$/', $ph,  $matches ) ){$result = '('.$matches[1] . ') ' .$matches[2] . '-' . $matches[3];return $result;}}

?>
<script>
var currencyFormatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',

  // These options are needed to round to whole numbers if that's what you want.
  minimumFractionDigits: 2, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
  maximumFractionDigits: 2, // (causes 2500.99 to be printed as $2,501)
});



const SalexTax = <?php echo $salesTaxRate;?>



</script>

<?php
function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);

    $interval = date_diff($datetime1, $datetime2);

    return $interval->format($differenceFormat);

}

?>
