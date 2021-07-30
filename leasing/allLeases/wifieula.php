<?php


$sql = "SELECT * FROM `property` WHERE propertyID = ".$leaseProperty;
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
$provider = $row['propertyLLC'];
$wifissid = $row['ssid'];
$pass = $row['wifiPassword'];
$array = str_split($pass);
foreach ($array as $char) {if (ctype_upper($char)){$wifipass.="<u>". $char."</u>";}else{$wifipass.=$char;}}
}
?>
<div class="container forPrint">
    <center><b><h5>Wi-Fi End User Acceptance Agreement</h5></center></b>

<br>
    <b><h5>SSID: <?php echo $wifissid?></h5></b>
    <b><h5>Wi-Fi Password: <?php echo $wifipass?></h5></b>
<br>

    <p><?php echo $provider;?> (“The Provider”) offers wireless high-speed Internet access (“Wi-Fi System”).  This Wi-Fi End User Acceptance Agreement (“Agreement”) governs each party’s rights and responsibilities relating to the use of the Wi-Fi System at the. <b>BY LOGGING ON TO THE WI-FI SYSTEM, YOU REPRESENT THAT YOU HAVE READ, UNDERSTOOD AND AGREED TO THE TERMS OF THIS AGREEMENT.</b> If you do not agree to the terms of this Agreement, you may not use the Wi-Fi System.
    <p><b>Access to Wi-Fi System</b>
    <p>By using the Wi-Fi System, you acknowledge (1) that the Wi-Fi System may not be uninterrupted or error-free; (2) that viruses or other harmful applications may travel through the Wi-Fi System; (3) that The Provider does not guarantee the security of the Wi-Fi System and that unauthorized third parties may access your computer or files or otherwise monitor your connection; (4) that the Wi-Fi System is provided “as is” and on an “as available” basis, without warranties of any kind , whatsoever; (5) that The Provider may change access codes, usernames, passwords or other security information necessary to access the Wi-Fi System at any time; and (6) that you assume all risk associated with your activities conducted online through the Wi-Fi System and assume all liability and damages incurred by yourself, The Provider, or a third party that arise or result from your activities conducted online through the Wi-Fi System, whether known or unknown at the time of use.
    Use of the Wi-Fi System shall not be construed as creating a relationship of any kind between The Provider and any user of the Wi-Fi System.  This Agreement shall be governed, interpreted and construed according to the laws of the State of Florida.
    <p><b>Acceptable Use of Wi-Fi System</b>
    <p>This Agreement is intended to prevent unacceptable uses of the internet.  The Provider does not actively monitor the use of the Wi-Fi System under normal circumstances.  Access to the Wi-Fi System may be denied, blocked, suspended, or terminated by The Provider at any time for any reason including but not limited to, violation of this Agreement, actions that may lead to liability for The Provider, and violation of applicable local, state or federal laws or regulations.   The Provider will fully cooperate with law enforcement upon receipt of notice that use of the Wi-Fi System is in violation of applicable law.
    <p>Activities conducted online through the Wi-Fi System shall not violate any applicable law or regulation or the rights of The Provider or any third party.  Examples of prohibited activities include, but are not limited to:
    <ul>
    <li>	Spamming and Invasion of Privacy.
    <li>	Intellectual Property Rights Violations.
    <li>	Obscene or Indecent Speech or Materials.
    <li>	Defamatory, Threatening, Abusive or Harassing Language.
    <li>	Distribution of Internet Viruses, Trojan Horses or other Destructive Activities.
    <li>	Interfering with or disrupting the Wi-Fi System or servers or networks connected to the Wi-Fi System, or disobeying any requirements, procedures, policies or regulations of networks connected to the Wi-Fi System.
    <li>	Any other actions that may otherwise be unlawful or inappropriate.
    </ul>
    <p><b>Indemnification</b>
    <p>You shall defend, indemnify and hold The Provider and its officers, directors, stockholders, employees, contractors, agents, successors and assigns harmless from and against, and shall promptly reimburse them for, any and all losses, claims, damages, settlements, costs, and liabilities of any nature whatsoever (including reasonable attorneys’ fees) to which any of them may become subject arising out of, based upon, as a result of, or in any way connected with, your use of the Wi-Fi System or any breach of this Agreement.
    Limitation of Liabilities
    The Provider, its officers, directors, employees, vendors and licensors are not liable for any costs or damages arising, either directly or indirectly, from your use of the Wi-Fi System or the Internet, specifically including any direct, indirect, incidental, exemplary, special, punitive or consequential damages.
</div>
