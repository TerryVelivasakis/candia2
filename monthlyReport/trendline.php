<?php
require $_SERVER["DOCUMENT_ROOT"].'/includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';
session_start();


require_once $_SERVER["DOCUMENT_ROOT"].'/includes/dbconfig.php';

$repDB = mysqli_connect($servername,$username,$password,'CandiaPartnerReport');

if (!$repDB) {
  echo "Error: Unable to connect to MySQL." . PHP_EOL;
  echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
  echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
  exit;
          }



$sql = "SELECT * FROM `Income`";
$result = $repDB->query($sql);
//var_dump($result);
$foo = 1;
while($row = $result->fetch_assoc()) {
  $periodMO = intval(substr($row['Period'],0,2));
  $periodYR = substr($row['Period'],2,4);
  $periodNet = intval($row['Income']) - intval($row['exOperating']) -intval($row['exNonOpex'])-intval($row['exPayroll'])-intval($row['exDebt'])+intval($row['exCapital']);
  $chartData .=$periodNet.",";
  $grossIncome.=intval($row['Income']).",";
  if ($periodMO == 1 or $periodMO == 2 or $periodMO == 3) {$quarter = 1;}
  if ($periodMO == 4 or $periodMO == 5 or $periodMO == 6) {$quarter = 2;}
  if ($periodMO == 7 or $periodMO == 8 or $periodMO == 9) {$quarter = 3;}
  if ($periodMO == 10 or $periodMO == 11 or $periodMO == 12) {$quarter = 4;}

  $arrayID = $periodYR."-Q".$quarter;
  $chartLabels .="'$arrayID',";
//  echo $arrayID;
  if ($foo !=3){ $rowName = $arrayID."*"; $foo+=1;}else{$rowName = $arrayID; $foo=1;}
  $tableData[$arrayID][0] = $rowName;
  $tableData[$arrayID][1] += intval($row['Income']);
  $tableData[$arrayID][2] += intval($row['exOperating']);
  $tableData[$arrayID][3] += intval($row['exCapital']);
  $tableData[$arrayID][4] += intval($row['exNonOpex']);
  $tableData[$arrayID][5] += intval($row['exPayroll']);
  $tableData[$arrayID][6] += intval($row['exDebt']);
}
$chartData = substr($chartData,0,-1);
$chartLabels = substr($chartLabels,0,-1);
//echo "<hr>";
//var_dump($tableData);
?>
<div class=container>
<div style = "width: 100%; height: 600;"><canvas id="GrossIncome" ></canvas></div>
<div style = "width: 100%; height: 600;"><canvas id="NetIncome" ></canvas></div>
<br><br><br>
<div style = "width: 50%">
<table class = 'table table-sm'>
<tr><th><th>Income<th>Expenses<th>Net

<?php
$x=1;
foreach ($tableData as $tableRow){
echo "<tr><td>".$tableRow[0];
echo "<td>".number_format($tableRow[1]);
$expenses = $tableRow[2]+$tableRow[4]+$tableRow[5]+$tableRow[6]-$tableRow[3];
echo "<td>".number_format($expenses);
$net = $tableRow[1] - $expenses;
echo "<td>".number_format($net);

$x=$x+1;
}
 ?>


</table>
</div>
</div>


 <script>

 //NetIncome Chart
 const ctx = document.getElementById('NetIncome');
 const myChart = new Chart(ctx, {
     type: 'line',
     data: {
         labels: [<?php echo $chartLabels;  ?>],
         datasets: [{
             label: 'Net Income',
             data: [ <?php echo $chartData;  ?>],
             backgroundColor: [
                 'rgba(255, 99, 132, 0.2)',
                 'rgba(54, 162, 235, 0.2)',
                 'rgba(255, 206, 86, 0.2)',
                 'rgba(75, 192, 192, 0.2)',
                 'rgba(153, 102, 255, 0.2)',
                 'rgba(255, 159, 64, 0.2)'
             ],
             borderColor: [
                 'rgba(255, 99, 132, 1)',
                 'rgba(54, 162, 235, 1)',
                 'rgba(255, 206, 86, 1)',
                 'rgba(75, 192, 192, 1)',
                 'rgba(153, 102, 255, 1)',
                 'rgba(255, 159, 64, 1)'
             ],
             borderWidth: 1,
             trendlineLinear: {
		style: "rgba(255,105,180, .8)",
		lineStyle: "solid",
		width: 2,
		projection: true
	}
         }]
     },
     options: {
         scales: {
            y: { beginAtZero: true },
             x: { ticks: { callback: function(val, index) {return index % 4 === 0 ? this.getLabelForValue(val) : '';}, color: 'red', } }
         }
     }

 });

//income chart
 const ctx2 = document.getElementById('GrossIncome');
 const myChart2 = new Chart(ctx2, {
     type: 'line',
     data: {
         labels: [<?php echo $chartLabels;  ?>],
         datasets: [{
             label: 'Gross Income',
             data: [ <?php echo $grossIncome;  ?>],
             backgroundColor: [
                 'rgba(255, 99, 132, 0.2)',
                 'rgba(54, 162, 235, 0.2)',
                 'rgba(255, 206, 86, 0.2)',
                 'rgba(75, 192, 192, 0.2)',
                 'rgba(153, 102, 255, 0.2)',
                 'rgba(255, 159, 64, 0.2)'
             ],
             borderColor: [
                 'rgba(255, 99, 132, 1)',
                 'rgba(54, 162, 235, 1)',
                 'rgba(255, 206, 86, 1)',
                 'rgba(75, 192, 192, 1)',
                 'rgba(153, 102, 255, 1)',
                 'rgba(255, 159, 64, 1)'
             ],
             borderWidth: 1,
             trendlineLinear: {
   style: "rgba(255,105,180, .8)",
   lineStyle: "solid",
   width: 2,
   projection: true
 }
         }]
     },
     options: {
         scales: {
            y: { beginAtZero: true },
             x: { ticks: { callback: function(val, index) {return index % 4 === 0 ? this.getLabelForValue(val) : '';}, color: 'red', } }
         }
     }

 });
 </script>
