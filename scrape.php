<?php
include("header.inc");

/* _GET council number and auto flag, & retrieve council name and URL from DB */
$councilNumber = pg_escape_string($_GET['c']);
$autoFlag = pg_escape_string($_GET['a']);
$queryStr = "SELECT name, url FROM wcouncils WHERE id = '$councilNumber'";
if(!$result = $mysqli->query($queryStr)) { echo "Query Err"; exit; }
if($result->num_rows === 0) { echo "No matched rows"; exit; }
$councilDataArray = $result->fetch_assoc();
$councilName = $councilDataArray['name'];
$councilURL = $councilDataArray['url'];

/* Download URL as string */
$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
$context = stream_context_create($opts);
$string = file_get_contents($councilURL,false,$context);

/* Page title */
echo $councilNumber.'. <a href="'.$councilURL.'">'.$councilName.'</a><br>';

/* Setup standard arrays */
$n = array();		/* Will contain scraped councillor names */
$p = array();		/* Will contain scraped parties as raw string */
$pCode = array();	/* Will contain scraped parties as three letter codes */
$w = array();		/* Will contain scraped ward names */
$pL = array();		/* Will contain scraped list of parties where we have to loop through them */
$blockCleaningFlag = 0;	/* Flag to skip entire cleanup section (needed for loop-type councils and antrim page) */
$con = 0;
$lab = 0;
$ld = 0;
$grn = 0;
$ukip = 0;
$pc = 0;
$snp = 0;
$dup = 0;
$sf = 0;
$uup = 0;
$sdlp = 0;
$ali = 0;
$tuv = 0;
$pup = 0;
$ind = 0;
$vac = 0;
$total = 0;

/* Convert HTML to navigable DOMXPATH object */
$doc = new DOMDocument(); 
@$doc->loadHTML($string);
$xpath = new DOMXPath($doc);

/* Definitions for which webpages are handled by which scraping method. 
  manual (i.e. click on link to manually fill in fields - stopped working)
  loop (i.e. page has ward name 1 then several cllrs, ward name 2, several cllrs)
  crawl (i.e. web crawl over several pages)
  normal (i.e. grabs all data off the same page)
  Antrim and Newry are unique */
$manual = array (81,106,131,170,173,186,270);
$loop = array (35,56,144,179,233,303,305,309,314,318,324,1010);
$antrim = array (1001);
$newry = array(1010);
$crawl = array(26,33,37,43,46,66,97,108,113,115,120,121,127,135,145,146,159,167,192,198,208,209,211,215,222,226,268,275,288,307,308,310,312,317,325,326,337,339,348,349,351,358,375,387,407,1002,1006,1009);

/* Load relevant scrape page as include */
if(in_Array($councilNumber, $manual)) { $blockCleaningFlag = 1; echo " (MANUAL)"; }
elseif(in_Array($councilNumber, $loop)) { include("loopScrape.php"); echo " (LOOP)"; }
elseif(in_Array($councilNumber, $antrim)) { include("antrimScrape.php"); echo " (ANTRIM)"; }
elseif(in_Array($councilNumber, $newry)) { include("newryScrape.php"); echo " (NEWRY)"; }
elseif(in_Array($councilNumber, $crawl)) { include("crawlScrape.php"); echo " (CRAWL)"; }
else { include("normalScrape.php"); echo " (NORMAL)"; }

/* Cleanup (for loop extends from here to ~line 232) */
if($blockCleaningFlag == 0) {
for($i=0;$i<count($n);$i++) { 
 if(substr($p[$i],0,14) == "Representing; ") { $p[$i] = trim(substr($p[$i],14)); }
 if(substr($n[$i],0,5) == "&nbsp") { $n[$i] = trim(substr($n[$i],6)); }
 if(substr($p[$i],0,5) == "&nbsp") { $p[$i] = trim(substr($p[$i],6)); }
 if(substr($w[$i],0,5) == "&nbsp") { $w[$i] = trim(substr($w[$i],6)); }
 if(substr($n[$i],0,10) == "Councillor") { $n[$i] = trim(substr($n[$i],10));}
 if(substr($n[$i],0,5) == "Cllr ") { $n[$i] = trim(substr($n[$i],5));}
 if(substr($p[$i],0,1) == "(") { $p[$i] = trim($p[$i], '()'); }
 if(substr($n[$i],0,6) == "Cllr. ") { $n[$i] = trim(substr($n[$i],6)); }
 if(substr($n[$i],0,4) == "Cllr") { $n[$i] = trim(substr($n[$i],4)); }
 if(substr($n[$i],0,4) == "Cyng") { $n[$i] = trim(substr($n[$i],4)); }
 if(substr($p[$i],0,7) == "Party: ") { $p[$i] = trim(substr($p[$i],7)); }
 if(substr($p[$i],0,6) == "Party:") { $p[$i] = trim(substr($p[$i],6)); }
 if(substr($w[$i],0,6) == "Ward: ") { $w[$i] = trim(substr($w[$i],6)); }
 if(substr($p[$i],0,8) == "Party : ") { $p[$i] = trim(substr($p[$i],8)); }
 if(substr($p[$i],0,17) == "Political Party: ") { $p[$i] = trim(substr($p[$i],17)); }
 if(substr($p[$i],0,12) == "Party name: ") { $p[$i] = trim(substr($p[$i],12)); }
 if(substr($w[$i],0,7) == "Ward : ") { $w[$i] = trim(substr($w[$i],7)); }
 if(substr($p[$i],0,6) == "Broadl") { $p[$i] = trim(substr($p[$i],10)); }
 if(substr($p[$i],0,9) == "Local Con") { $p[$i] = trim(substr($p[$i],6)); }
 if(substr($p[$i],0,4) == "The ") { $p[$i] = trim(substr($p[$i],4)); }
 if(substr($p[$i],0,6) == "Welsh ") { $p[$i] = trim(substr($p[$i],6)); }
 if(substr($p[$i],0,7) == "Party -") { $p[$i] = trim(substr($p[$i],7)); }
 if(substr($w[$i],0,6) == "Member") { $w[$i] = trim(substr($w[$i],9)); }
 if(substr($p[$i],0,1) == "-") { $p[$i] = trim(substr($p[$i],1)); }
 if(substr($n[$i],0,11) == "County Coun") { $n[$i] = trim(substr($n[$i],18)); }
 if(strpos($p[$i],'(logo') !== false) { $p[$i] = trim(substr($p[$i],0,-7)); }
 if(substr($p[$i],0,6) == "Party;") { $p[$i] = trim(substr($p[$i],6)); }
 if(substr($p[$i],0,16) == "Group leader of ") { $p[$i] = trim(substr($p[$i],16)); }
 if(substr($n[$i],0,9) == "Alderman ") { $n[$i] = trim(substr($n[$i],9)); }
 if(strpos($w[$i],'Ward') != FALSE) { $w[$i] = str_replace(' Ward','',$w[$i]); }

/* Additional council specific cleanups */
 if($councilNumber == 33 && $n[$i] == "Bryn Hurren") { $p[$i] = "Liberal Democrats"; }
 if($councilNumber == 398) { $n[$i] = substr($n[$i],strpos($n[$i],','))." ".strtok($n[$i],','); }
 if($councilNumber == 4) { $tmp = explode(",", $w[$i]); $w[$i] = $tmp[1]; }
 if($councilNumber == 20) {  if(substr($p[$i],0,4) == "Cons") { $p[$i] = substr($p[$i], strpos($p[$i], '(')+1, strpos($p[$i], ')', strpos($p[$i], '('))); } } if($councilNumber == 99) { $p[$i] = substr($p[$i],9); }
 if($councilNumber == 134 or $councilNumber == 183 or $councilNumber == 199 or $councilNumber == 204 or $councilNumber == 305 or $councilNumber == 316) { $p[$i] = substr($p[$i], strpos($p[$i], '(')+1); }
 if($councilNumber == 165 or $councilNumber == 225 or $councilNumber == 300) { $n[$i] = trim(preg_replace("/\([^)]+\)/","",$n[$i])); $p[$i] = substr($p[$i], strpos($p[$i], '(')+1, strpos($p[$i], ')', strpos($p[$i], '('))); }
 if($councilNumber == 299) { $w[$i] = substr($w[$i], 15); $p[$i] = substr($p[$i], 2); }
 if($councilNumber == 301) { $w[$i] = substr($w[$i], 9); $p[$i] = substr($p[$i], strpos($p[$i], '(')+1, strpos($p[$i], ')', strpos($p[$i], '('))); }
 if($councilNumber == 342) { $p[$i] = substr($p[$i],strpos($p[$i],'Group:')+7); $w[$i] = substr($w[$i],0,strpos($w[$i],'|')-1);  }
 if($councilNumber == 356) { $p[$i] = substr($p[$i], strpos($p[$i],'(')+1); }
 if($councilNumber == 165 or $councilNumber == 225) { $p[$i] = substr($p[$i], 0, strpos($p[$i],' -')); $w[$i] = trim(substr($w[$i], strpos($w[$i], ' -', strpos($w[$i], ' -')+strlen(' -'))+2),'()'); $n[$i] = substr($n[$i], strpos($n[$i], ' -')+2)." ".substr($n[$i], 0, strpos($n[$i], ' -')); }
 if($councilNumber == 382) { $p[$i] = substr($p[$i], 0, strpos($p[$i], 'Ward')-2); $w[$i] = substr($w[$i], strpos($w[$i], 'Ward: ')+6); }
 if($councilNumber == 299) { $w[$i] = ucfirst(substr($w[$i], 0, strpos($w[$i], '/'))); }
 if($councilNumber == 388 && strpos($p[$i], '/') !== false) { $p[$i] = substr($p[$i], 0, strpos($p[$i], '/')); }
 if($councilNumber == 183 && strpos($w[$i], ':') !== false) { $w[$i] = trim(substr($w[$i], 0, strpos($w[$i], ':')),':'); }
 if($councilNumber == 4) { $p[$i] = trim(substr($p[$i], 0, strpos($p[$i], ',')), ','); }
 if($councilNumber == 302 && strpos($w[$i], '-') !== false) { $w[$i] = substr($w[$i], strpos($w[$i], '-')+1); }
 elseif($councilNumber == 302 && strpos($w[$i], ',') !== false) { $w[$i] = substr($w[$i], strpos($w[$i], ',')+1); }
 elseif($councilNumber == 302 && strpos($w[$i], 'Doon') !== false) { $w[$i] = "Doon Valley"; }
 elseif($councilNumber == 302 && strpos($w[$i], 'Ballochmyle') !== false) { $w[$i] = "Ballochmyle"; }
 if($councilNumber == 225 && strpos($n[$i], "Steve (Con Wills") !== false) { $n[$i] = "Steve Wills"; $p[$i] = "Con"; $w[$i] = "Castle"; }
 if($councilNumber == 225 && strpos($n[$i], "Castle)") !== false) { $n[$i] = "IG"; $p[$i] = "IG"; $w[$i] = "IG"; }
 if($councilNumber == 354 && strpos($n[$i], "Duncan Kerr") !== false) { $p[$i] = "Green"; }
 if($councilNumber == 73 && strpos($n[$i], "Chris McFarling") !== false) { $p[$i] = "Green"; }
 if($councilNumber == 12 && strpos($n[$i], "Martin Whybrow") !== false) { $p[$i] = "Green"; }
 if($councilNumber == 296 && strpos($n[$i], "Martin Ford") !== false) { $p[$i] = "Green"; }
 if($councilNumber == 13 && strpos($n[$i], "Alycia James") !== false) { $p[$i] = "Conservative"; }
 if($councilNumber == 390 && strpos($p[$i], '/') !== false) { $p[$i] = substr($p[$i], 0, strpos($p[$i], '/')); }
 if($councilNumber == 167 && strpos($p[$i], "Conservative") !== false) { $p[$i] = "Conservative"; }
 if($councilNumber == 167 && strpos($p[$i], "Labour") !== false) { $p[$i] = "Labour"; }
 if($councilNumber == 167 && strpos($p[$i], "Liberal") !== false) { $p[$i] = "Liberal Democrat"; }
 if($councilNumber == 115 && strpos($p[$i], "Liberal") !== false) { $p[$i] = "Liberal Democrats"; }
 if($councilNumber == 167 && strpos($w[$i], ":") !== false) { $w[$i] = substr($w[$i],strpos($w[$i],':')+1); }
 if($councilNumber == 311) { $w[$i] = trim($w[$i],'0123456789'); }
 if($councilNumber == 312) { $w[$i] = trim(substr($w[$i], strpos($w[$i],'-')),'-'); }
 if($councilNumber == 315) { $w[$i] = substr($w[$i], 8); }
 if($councilNumber == 108 && strpos($w[$i], "North Norfolk") !== false) { $w[$i] = substr($w[$i],strpos($w[$i],'for ')+4); }
 if($councilNumber == 351) { $w[$i] = substr($w[$i], strpos($w[$i],' - ')); }
 if($councilNumber == 325) { $w[$i] = substr($w[$i], strpos($w[$i],' - ')); }
/*Keep only brackets*/
 if($councilNumber == 326 or $councilNumber == 302) { $p[$i] = substr($p[$i], strpos($p[$i],'(')); $p[$i] = strtok($p[$i], ') '); }
 if($councilNumber == 307) { $p[$i] = substr($p[$i], strpos($p[$i],'(')); $p[$i] = strtok($p[$i], ') '); }
 if($councilNumber == 203) { $w[$i] = trim($w[$i],'()'); }
 if($councilNumber == 319) { $w[$i] = trim(substr($w[$i],8),'()'); }
 if($councilNumber == 322) { $w[$i] = substr($w[$i],7); }
 if($councilNumber == 205 && strpos($n[$i], ",") !== false) { $n[$i] = strtok($n[$i], ','); }
 if($councilNumber == 120 && strpos($n[$i], '-') !== false) { $n[$i] = strtok($n[$i], '-'); }
 if($councilNumber == 135 && strpos($w[$i], '-') !== false) { $w[$i] = strtok($w[$i], '-'); }
 if($councilNumber == 135 && strpos($w[$i], '.') !== false) { $w[$i] = strtok($w[$i], '.'); }
 if($councilNumber == 281 && strpos($p[$i], "Conservative Independent") !== false) { $p[$i] = "Independent Conservative"; }
 if($councilNumber == 23 && strpos($w[$i], ':') !== false) { $w[$i] = substr($w[$i], strpos($w[$i],':')); }
 if($councilNumber == 141 && strpos($p[$i], '(') !== false) { $p[$i] = substr($p[$i], 1, strpos($p[$i],')')-strpos($p[$i],'(')); }
 if($councilNumber == 288 && strpos($w[$i], '/') !== false) { $w[$i] = substr($w[$i], strpos($w[$i],'councillors/')); $w[$i] = substr($w[$i], 12); $w[$i] = ucfirst(substr($w[$i], 0, strpos($w[$i],'/'))); }
 if($councilNumber == 142 && strpos($n[$i], 'David Allen') !== false) { $p[$i] = "Conservative"; }
 if($councilNumber == 155) { $n[$i] = substr($n[$i], strpos($n[$i], ',')+2)." ".substr($n[$i], 0, strpos($n[$i], ',')+1); $p[$i] = substr($p[$i],0,strpos($p[$i],'-')); $w[$i] = substr($w[$i],(strpos($w[$i],' -'))); }
 if($councilNumber == 160) { $n[$i] = substr($n[$i], strpos($n[$i], ',')+2)." ".substr($n[$i], 0, strpos($n[$i], ',')+1); $p[$i] = substr($p[$i],0,strpos($p[$i],',')); $w[$i] = substr($w[$i],(strpos($w[$i],', '))); }
 if($councilNumber == 226 && strpos($p[$i], '-') !== false) { $p[$i] = substr($p[$i], strpos($p[$i], '-')+2); }
 if($councilNumber == 43 && strpos($w[$i], '/') !== false) { $tmp = explode('/', $w[$i]); $w[$i] = $tmp[4]; $w[$i] = substr($w[$i], 0, strpos($w[$i], '---')); }
 if($councilNumber == 375) { $w[$i] = substr($w[$i], strpos($w[$i], 'for ')); $p[$i] = strtok($p[$i],' ');  }
 if($councilNumber == 63 && strpos($n[$i], "Fiona M. Martin") !== false) { $p[$i] = "Lib Dem"; }
 if($councilNumber == 300 && strpos($n[$i], "Richard Brodie") !== false) { $p[$i] = "Lib Dem"; }
 if($councilNumber == 1008) { $p[$i] = strtok($p[$i], ','); $w[$i] = substr($w[$i], strpos($w[$i], ' ')); }
 if($councilNumber == 37) { $w[$i] = substr($w[$i], strpos($w[$i], "Ward:")); $w[$i] = str_replace('Ward:','',$w[$i]); if(strpos($w[$i],'Other') !== false) { $w[$i] = substr($w[$i],0,strpos($w[$i],'Other')); } }
 if($councilNumber == 97 && strpos($n[$i], "Dick Skidmore") !== false) { $w[$i] = "Postlebury"; }
 if($councilNumber == 120 && strpos($n[$i], "Alison Hamlin") !== false) { $w[$i] = "Puriton &amp; Woolavington"; }
 if($councilNumber == 375 && $n[$i] == "Isobel Ballsdon") { $p[$i] = "CON"; $w[$i] = "Thames"; }
 if($councilNumber == 375 && $n[$i] == "Rachel Eden") { $p[$i] = "LAB"; $w[$i] = "Whitley"; }
 if($councilNumber == 375 && $n[$i] == "Paul Gittings") { $p[$i] = "LAB"; $w[$i] = "Minster"; }
 if($councilNumber == 375 && $n[$i] == "Tony Jones") { $p[$i] = "LAB"; $w[$i] = "Redlands"; }
 if($councilNumber == 375 && $n[$i] == "Daya Pal Singh") { $p[$i] = "LAB"; $w[$i] = "Kentwood"; }
 if($councilNumber == 375 && $n[$i] == "Matt Rodda") { $p[$i] = "LAB"; $w[$i] = "Katesgrove"; }
 if($councilNumber == 375 && $n[$i] == "Bet Tickner") { $p[$i] = "LAB"; $w[$i] = "Abbey"; }
 if($councilNumber == 375 && $n[$i] == "Mohammed Ayub") { $p[$i] = "LAB"; }
 if($councilNumber == 375) { $w[$i] = str_replace('for','',$w[$i]); $w[$i] = str_replace('ward', '', $w[$i]); }
 if($councilNumber == 375 && $n[$i] == "Ricky Duveen") { $p[$i] = "Liberal Democrats"; }
 if($councilNumber == 375 && $n[$i] == "Meri O\'Connell") { $p[$i] = "Liberal Democrats"; }
 if($councilNumber == 92) { $tmp = substr($n[$i], strpos($n[$i],'(')+1); $tmp = strtok($tmp,')'); $n[$i] = $tmp." ".strtok($n[$i],' '); }
 if($councilNumber == 266 && $n[$i] == "Brian Morris") { $p[$i] = "UKIP"; }
 if($councilNumber == 307 && $p[$i] == "Convener") { $p[$i] = "IND"; }
 if($councilNumber == 247 && $n[$i] == "Martin Tiedemann") { $p[$i] = "LAB"; }
 if($councilNumber == 24 && $p[$i] == "Surrey Opposition Forum") { $p[$i] = "Liberal Democrats"; }
 if($councilNumber == 24 && $n[$i] == "Mr Jonathan Essex") { $p[$i] = "Green Party"; }
 if($councilNumber == 358) { $n[$i] = strtok($n[$i],'-'); }
 if($councilNumber == 146 && $n[$i] == "Gary Scott") { $p[$i] = "Liberal Democrats"; }
 if($councilNumber == 292 && $n[$i] == "Mrs Myra Joan Whiteside") { $p[$i] = "Labour"; }
 if($councilNumber == 1002 && $n[$i] == "Jones" && $w[$i] == "Portadown") { $p[$i] = "IND"; } /* UKIPs in NI part of IND/Other */
 if($councilNumber == 1008 && $n[$i] == "Donna Anderson") { $p[$i] = "IND"; } /* UKIPs in NI part of IND/Other */
 if($councilNumber == 1008 && $n[$i] == "Noel Jordan") { $p[$i] = "IND"; } /* UKIPs in NI part of IND/Other */
 if($councilNumber == 1004 && $n[$i] == "David Harding") { $p[$i] = "IND"; } /* CONs in NI part of IND/Other */

/* Remove text in brackets */
$n[$i] = preg_replace("/\([^)]+\)/","",$n[$i]); 
$p[$i] = preg_replace("/\([^)]+\)/","",$p[$i]);
$w[$i] = preg_replace("/\([^)]+\)/","",$w[$i]);

/* Clean up spaces and trim */
$n[$i] = str_replace(chr(151), '', $n[$i]); // emdash
$p[$i] = str_replace(chr(151), '', $p[$i]); // emdash
$w[$i] = str_replace(chr(151), '', $w[$i]); // emdash
$n[$i] = str_replace(chr(150), '', $n[$i]); // endash
$p[$i] = str_replace(chr(150), '', $p[$i]); // endash
$w[$i] = str_replace(chr(150), '', $w[$i]); // endash
$p[$i] = str_replace('-', '', $p[$i]); // hyphen
$w[$i] = str_replace('-', '', $w[$i]); // hyphen
$n[$i] = trim($n[$i], '()*0123456789-.|:,');
$p[$i] = trim($p[$i], '()*0123456789-.|:,');
$w[$i] = trim($w[$i], '()*0123456789-.|:,');

/* Remove newlines and trim again */
$n[$i] = preg_replace('/\s+/', ' ', trim($n[$i]));
$p[$i] = preg_replace('/\s+/', ' ', trim($p[$i]));
$w[$i] = preg_replace('/\s+/', ' ', trim($w[$i]));

/* Replace ampersand with 'and', replace comma with nothing */
if(strpos($w[$i],'&') !== FALSE) { $w[$i] = str_replace('&', 'and', $w[$i]); }
if(strpos($w[$i],',') !== FALSE) { $w[$i] = str_replace(',', '', $w[$i]); }


/* Removal of mayors who aren't councillors and vacant seats that put data out of sync */
 if($councilNumber == 95 && $n[$i] == "Executive Mayor K. R. Allsop") { $n[$i] = "IG"; $p[$i] = "IG"; $w[$i] = "IG"; }
 if((substr($n[$i],0,19) !== "Mayor Saleha Jaffer" && $n[$i] !== "Mayor of Test Valley Councillor Karen Hamilton") && $n[$i] !== "Mayor Audrey Wales MBE" && (substr($n[$i],0,5) == "Mayor" or substr($n[$i],0,18) == "Sir Peter Soulsby" or substr($n[$i],0,17) == "Sir Steve Bullock" or substr($n[$i],0,15) == "Executive Mayor" or substr($n[$i],0,15) == "Sir Robin Wales")) {
 echo "Mayor deletion activated: ".$n[$i]."/".$p[$i]."/".$w[$i];
  $n[$i] = "IG";
  if(isset($p[$i]) && trim($p[$i]) != "") {
   $p[$i] = "IG"; }
  if(isset($w[$i]) && trim($w[$i]) != "") {
   $w[$i] = "IG"; }
 echo "//New triplet: ".$n[$i]."/".$p[$i]."/".$w[$i];
 }
 if(substr($n[$i],0,17) == "CURRENTLY VACANT") { $n[$i] = "IG"; $w[$i] = "IG"; }
 if($councilNumber == 65 && $n[$i] == "Karen Haberfield - Stood down 14th November 2016") { $n[$i] = "IG"; $p[$i] = "IG"; }
 if($councilNumber == 8 && $n[$i] == "Representative Deceased") { $n[$i] = "IG"; $w[$i] = "IG"; }
 if($councilNumber == 97 && strpos($n[$i], "Philip Gait") !== false) { $n[$i] = "IG"; $p[$i] = "IG"; $w[$i] = "IG"; }
 if($councilNumber == 365 && strpos($n[$i], "Julie Daley") !== false) { $n[$i] = "IG"; $w[$i] = "IG"; }
 if($councilNumber == 65 && strpos($n[$i], "Karen Haberfield") !== false) { $n[$i] = "IG"; $p[$i] = "IG"; }
 if($councilNumber == 11 && strpos($n[$i], "Richard Thake") !== false) { $w[$i] = "IG"; }
 if($councilNumber == 311 && $n[$i] == "Gail Ross") { $n[$i] = "IG"; $p[$i] = "IG"; $w[$i] = "IG"; }
 if($councilNumber == 334 && $n[$i] == "Jonathan Weston") { $n[$i] = "IG"; $p[$i] = "IG"; $w[$i] = "IG"; }
 if($councilNumber == 367 && $n[$i] == "Bill Wright") { $n[$i] = "IG"; $p[$i] = "IG"; $w[$i] = "IG"; }
 if($councilNumber == 340 && $n[$i] == "PJ McCaull") { $n[$i] = "IG"; $p[$i] = "IG"; $w[$i] = "IG"; }
 if($councilNumber == 16 && $n[$i] == "Vacancy") { $n[$i] = "IG"; $w[$i] = "IG"; }
 if($councilNumber == 152 && substr($n[$i],0,7) == "Vacancy") { $n[$i] = "IG"; $w[$i] = "IG"; }
 if($councilNumber == 152 && substr($n[$i],0,14) == "Elizabeth Parr") { $n[$i] = "IG"; $w[$i] = "IG"; $p[$i-2] = "IG"; }
}

/* New loop to remove Ignored Fields from section above and re-shuffle arrays as reqd */
for($i=0;$i<count($n);$i++) {
 $ignoreFlag = 0;
 if($n[$i] == "IG") { unset($n[$i]); $n = array_values($n); $ignoreFlag = 1; }
 if($w[$i] == "IG") { unset($w[$i]); $w = array_values($w); $ignoreFlag = 1; }
 if($p[$i] == "IG") { unset($p[$i]); $p = array_values($p); $ignoreFlag = 1; }
 if($ignoreFlag == 1) { $i--; }
}}

if($autoFlag != 2) {include("scrapeDisplay.php");}
if($autoFlag == 2) {include("scrapeDisplayElectionDay.php");}

?>
