<?php
require $_SERVER["DOCUMENT_ROOT"].'includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';
?>
<div class="container">
<input type="text" id='card' onchange='convertToBinary()'></input>
<button onclick='convertToBinary()'>Convert</button>
<div id='output' class ='w-25'>
<table id='cardcodes' class = table>
<tr><th>Card Number<th>Card Code</tr>

</table>
</div>
</div>


<script>

function convertToBinary() {
    x=parseInt($("#card").val());
    bins = x.toString(2);
    while (bins.length < 24){bins = "0"+bins;}
    facility = bins.substr(0,8);
    facility = parseInt(facility,2);
    card = bins.substr(8,16);
    card = parseInt(card,2);
    card = card.toString();
    console.log(bins.length);
    while (card.length < 5){card = "0"+card;}
    cardcode = facility.toString()+card;
    document.getElementById("card").select();
    var row = "<tr><td>"+x+"</td><td>"+facility+card+"</td></tr>"
    $('#cardcodes').append(row);

}

// take input
//let number = prompt('Enter a decimal number: ');

//convertToBinary(number);
// X 8digits 16digits


</script>
