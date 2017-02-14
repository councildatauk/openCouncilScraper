<?php

$count = 0;

$monster[1001][2] = '//h5[contains(text(),"DEA")]';
$ward = $xpath->query($monster[$councilNumber][2]);
foreach($ward as $item) {
 $wTmp = str_replace("&nbsp;", "", trim($item->nodeValue));
 if(strpos($wTmp, 'Airport') !== false) { $z = 5; }
 if(strpos($wTmp, 'Antrim') !== false) { $z = 6; }
 if(strpos($wTmp, 'Ballyclare') !== false) { $z = 5; }
 if(strpos($wTmp, 'Dunsilly') !== false) { $z = 5; }
 if(strpos($wTmp, 'Glengormley') !== false) { $z = 7; }
 if(strpos($wTmp, 'Macedon') !== false) { $z = 6; }
 if(strpos($wTmp, 'Threemilewater') !== false) { $z = 6; }

 $monster[1001][0] = '//h5[text()="'.$wTmp.'"]/following-sibling::div[@class="rowholder"][position()<='.$z.']/div[@class="detailbox"]/strong[1]';
 $monster[1001][1] = '//h5[text()="'.$wTmp.'"]/following-sibling::div[@class="rowholder"][position()<='.$z.']/div[@class="detailbox"]/text()[1]';
 $name = $xpath->query($monster[$councilNumber][0]);
 $party = $xpath->query($monster[$councilNumber][1]);
 foreach($name as $item) {
  $n[$count] = str_replace("&nbsp;", "", htmlentities(addslashes(trim($item->nodeValue)), null, 'utf-8'));
  $w[$count] = $wTmp;
  $count++; echo $count."-".$wTmp."..";
 }
 foreach($party as $item) {
  $p[] = str_replace("&nbsp;", "", htmlentities(addslashes(trim($item->nodeValue)), null, 'utf-8'));
 }
 unset($party);
 unset($name);
 unset($wTmp);
 unset($z);
}

var_dump($n); echo '<br><br>'; var_dump($p); echo '<br><br>'; var_dump($w);

$blockCleaningFlag = 1;
/* Own cleaning section */
for($i=0;$i<count($n);$i++) {
$w[$i] = trim(addslashes($w[$i]));
$p[$i] = substr($p[$i], strpos($p[$i],'(')+1); $p[$i] = strtok($p[$i], ') '); 
$w[$i] = strtok($w[$i], ' ');
 if(substr($n[$i],0,11) == "Councillor ") { $n[$i] = trim(substr($n[$i],11));}
 if(substr($n[$i],0,9) == "Alderman ") { $n[$i] = trim(substr($n[$i],9)); }
 $n[$i] = preg_replace("/\([^)]+\)/","",$n[$i]); 
 $p[$i] = preg_replace("/\([^)]+\)/","",$p[$i]);
 $w[$i] = preg_replace("/\([^)]+\)/","",$w[$i]);
}

?>
