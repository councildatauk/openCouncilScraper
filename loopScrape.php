<?php

$count = 0;

$monster[35][2] = '//div[@class="wardInfo"]/strong';
$monster[56][2] = '//section[@itemprop="articleBody"]/h2';
$monster[144][2] = '//a[contains(@name,"Ward")]';
$monster[179][2] = '//div[@class="content-headline menu-headline"]/h2';
$monster[233][2] = '//div[contains(@class,"who_is_my_local_councillor")]/div/h3';
$monster[303][2] = '//div[@class="view-content"][1]/h3';
$monster[305][2] = '//h3[contains(text(),"Ward")]';
$monster[309][2] = '//div[@class="ward hidden"]/h3';
$monster[314][2] = '//h2[contains(text(),"Ward")]';
$monster[318][2] = '//h2[contains(text(),"Ward")]';
$monster[324][2] = '//h2[contains(text(),"Ward")]';
$monster[1010][2] = '//div[@class="clearboth"]/following-sibling::h1';
$ward = $xpath->query($monster[$councilNumber][2]);
foreach($ward as $item) {
 $wTmp = str_replace("&nbsp;", "", trim($item->nodeValue));
echo $wTmp."---";
 $monster[35][0] = '//strong[text()="'.$wTmp.'"]/following-sibling::div/div/a/p';
 $monster[35][1] = '//strong[text()="'.$wTmp.'"]/following-sibling::div/div/div/@class';
 $monster[56][0] = '//h2[text()="'.$wTmp.'"]/following-sibling::ul[1]/li/a';
 $monster[56][1] = '//h2[text()="'.$wTmp.'"]/following-sibling::ul[1]/li/text()';
 $monster[144][0] = '//a[text()="'.$wTmp.'"]/parent::td/parent::tr/following-sibling::tr[position()<3]/td[@colspan="1"][@rowspan="1"][1]/a | //a[text()="'.$wTmp.'"]/parent::td/following-sibling::td[2]//a';
 $monster[144][1] = '//a[contains(@href,"PoliticalGroups")]';
 $monster[179][0] = '//h2[text()="'.$wTmp.'"]/parent::div/following-sibling::div/ol/li/div/a/div/h2/span';
 $monster[179][1] = '//h2[text()="'.$wTmp.'"]/parent::div/following-sibling::div/ol/li/div/a/div/h2/span';
 $monster[233][0] = '//h3[text()="'.$wTmp.'"]/following-sibling::div[1]/ul/li/span/strong/a[normalize-space(.)]';
 $monster[233][1] = '//h3[text()="'.$wTmp.'"]/following-sibling::div[1]/ul/li/span/text()[2]';
 $monster[303][0] = '//h3[text()="'.$wTmp.'"]/following-sibling::div[position()<4]/p/span/span/a';
 $monster[303][1] = '//h3[text()="'.$wTmp.'"]/following-sibling::div[position()<4]/p/span/span/text()';
 $monster[305][0] = '//h3[text()="'.$wTmp.'"]/following-sibling::ul[1]/li/a';
 $monster[305][1] = '//h3[text()="'.$wTmp.'"]/following-sibling::ul[1]/li/a';
 $monster[309][0] = '//h3[text()="'.$wTmp.'"]/following-sibling::table/tr[position()>1]/td[1]/strong';
 $monster[309][1] = '//h3[text()="'.$wTmp.'"]/following-sibling::table/tr[position()>1]/td[2]';
 $monster[314][0] = '//h2[text()="'.$wTmp.'"]/following-sibling::ul[1]/li/a';
 $monster[314][1] = '//h2[text()="'.$wTmp.'"]/following-sibling::ul[1]/li/a';
 $monster[318][0] = '//h2[text()="'.$wTmp.'"]/following-sibling::div[1]/tbody/tr[2]/td/a';
 $monster[318][1] = '//h2[text()="'.$wTmp.'"]/following-sibling::table[1]/tbody/tr[3]/td';
 $monster[324][0] = '//h2[text()="'.$wTmp.'"]/following-sibling::div[1]/div/a/span/strong';
 $monster[324][1] = '//h2[text()="'.$wTmp.'"]/following-sibling::div[1]/div/a/span/text()';
 $monster[1010][0] = '//h1[text()="'.$wTmp.'"]/following-sibling::ul/li/div[2]/span';
 $monster[1010][1] = '//h1[text()="'.$wTmp.'"]/following-sibling::ul/li/div[2]/strong[1]/following-sibling::text()[1]';
 $name = $xpath->query($monster[$councilNumber][0]);
 $party = $xpath->query($monster[$councilNumber][1]);
 foreach($name as $item) {
  $n[$count] = str_replace("&nbsp;", "", htmlentities(addslashes(trim($item->nodeValue)), null, 'utf-8'));
  $w[$count] = $wTmp;
  $count++; 
 }
 foreach($party as $item) {
  $p[] = str_replace("&nbsp;", "", htmlentities(addslashes(trim($item->nodeValue)), null, 'utf-8'));
 }
 unset($party);
 unset($name);
 unset($wTmp);
}

echo " <br> ";
var_dump($n); echo " <br> ";
var_dump($p); echo " <br> ";
var_dump($w); echo " <br> ";


$blockCleaningFlag = 1;
/* Own cleaning section */
for($i=0;$i<count($n);$i++) {
$w[$i] = trim(addslashes($w[$i]));
if(substr($n[$i],0,11) == "Councillor ") { $n[$i] = trim(substr($n[$i],11));}
if($councilNumber == "179" && strpos($p[$i], '(') !== false) { $p[$i] = substr($p[$i], strpos($p[$i], '(')+1, strpos($p[$i],')')-strpos($p[$i],'(')-1); $n[$i] = strtok($n[$i], '('); }
if($councilNumber == "56" && strpos($p[$i], '(') !== false) { $p[$i] = substr($p[$i], strpos($p[$i], '(')+1, strpos($p[$i],')')-strpos($p[$i],'(')-1); }
if($councilNumber == "303" && strpos($p[$i], ',') !== false) { $p[$i] = substr($p[$i], 2); $w[$i] = substr($w[$i], 9); }
if($councilNumber == "305" && strpos($p[$i], '(') !== false) { $p[$i] = substr($p[$i], strpos($p[$i], '(')+1, strpos($p[$i],')')-strpos($p[$i],'(')-1); $w[$i] = substr($w[$i], 9); }
if($councilNumber == "314" && strpos($n[$i], '-') !== false) { $n[$i] = substr($n[$i], 0, strpos($n[$i], '-')); $p[$i] = substr($p[$i], strpos($p[$i], '-')+2); $w[$i] = substr($w[$i], 9); }
if($councilNumber == "318" && strpos($p[$i], 'Leader') !== false) { $p[$i] = substr($p[$i], 14); }
if($councilNumber == "318") { $w[$i] = substr($w[$i], strpos($w[$i], '-') +2); }
if($councilNumber == "324") { $w[$i] = substr($w[$i], strpos($w[$i], ':') +2); }
 $n[$i] = trim(preg_replace("/\([^)]+\)/","",$n[$i])); 
 $p[$i] = trim(preg_replace("/\([^)]+\)/","",$p[$i]));
 $w[$i] = trim(preg_replace("/\([^)]+\)/","",$w[$i]));
 $n[$i] = trim(preg_replace(array('/\s{2,}/', '/[\t\n]/'),' ',$n[$i]));  /* Remove whitespace and newlines */
}

?>
