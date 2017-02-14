<?php

$count = 0;

$w = array("Crotlieve","Crotlieve","Crotlieve","Crotlieve","Crotlieve","Crotlieve","Downpatrick","Downpatrick","Downpatrick","Downpatrick","Downpatrick","Newry","Newry","Newry","Newry","Newry","Newry","Rowallane","Rowallane","Rowallane","Rowallane","Rowallane","Slieve Croob","Slieve Croob","Slieve Croob","Slieve Croob","Slieve Croob","Slieve Gullion","Slieve Gullion","Slieve Gullion","Slieve Gullion","Slieve Gullion","Slieve Gullion","Slieve Gullion","The Mournes","The Mournes","The Mournes","The Mournes","The Mournes","The Mournes","The Mournes");

 $monster[1010][0] = '//div[@class="lmt_content"]/span';
 $monster[1010][1] = '//div[@class="lmt_content"]/strong[1]/following-sibling::text()[1]';
 $name = $xpath->query($monster[$councilNumber][0]);
 $party = $xpath->query($monster[$councilNumber][1]);
 foreach($name as $item) {
  $n[] = str_replace("&nbsp;", "", htmlentities(addslashes(trim($item->nodeValue)), null, 'utf-8'));
 }
 foreach($party as $item) {
  $p[] = str_replace("&nbsp;", "", htmlentities(addslashes(trim($item->nodeValue)), null, 'utf-8'));
 }

?>
