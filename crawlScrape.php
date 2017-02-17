<?php

/* Define url extraction codes */
$urls[] = array();
$urls[26] = '//title';
$urls[33] = '//a[contains(@href,"gallery-of-elected-councillors")]/@href';
$urls[37] = '//td/a[contains(@href,"2-uncategorised")][not(contains(@style,"line"))]/@href | //p/a[contains(@href,"2-uncategorised")][not(contains(@style,"line"))]/@href';
$urls[43] = '//div[@class="content-paragraph "]/p/a/@href';
$urls[46] = '//a[contains(@class,"page-jump")]/@href';
$urls[66] = '//select[contains(@name,"Name")]/option/@value';
$urls[81] = '//table[@class="results"]//tr/td/a/@href';
$urls[97] = '//div[@class="column1"]/div/a/@href | //div[@class="morelinks"]/ul/li/a/@href';
$urls[108] = '//title';
$urls[113] = '//li/a[contains(@class,"child") and not(contains(text(),"Purbeck"))]/@href';
$urls[115] = '//table[contains(@style,"width: 791px")]/tbody/tr/td/a[contains(text(),"Councillor")]/@href';
$urls[120] = '//li[@class="clearfix"]/h2[@class="title"]/a[contains(text(),"Councillor ")]/@href';
$urls[121] = '//select[@name="jump"]/option[contains(@value,"councillor")]/@value';
$urls[127] = '//a[@class="img"]/@href';
$urls[131] = '//title';
$urls[135] = '//div[@class="media row-margin"]/a/@href';
$urls[145] = '//li[@class="NavSibling"]/a/@href';
$urls[146] = '//div[@class="mgThumbsList"]/ul/li/a[contains(@href, "mgUserInfo")]/@href';
$urls[159] = '//div[@id="list"]/ul/li/a/@href';
$urls[167] = '//li[@class="oNavigationItemChild"]/a[contains(@title,"Councillor")]/@href';
$urls[192] = '//li[@data-level="4"]/a[contains(@href,"councillors/councillor")]/@href';
$urls[198] = '//div[@class="contact-box"]/table/tr/td/a[@class="section-links"]/@href';
$urls[208] = '//ul[@class="subnav"]/li/div/a/@href';
$urls[209] = '//div[@class="image_container"]/a[contains(@href,"/Councillor-")]/@href';
$urls[211] = '//div[@class="article grid3"]/div/ul/li/a/@href';
$urls[215] = '//div[@id="editorContent"]/p/a/@href';
$urls[222] = '//ul[@class="pagination"]/li/a/@href';
$urls[226] = '//a[contains(@href,"councillors/mem")][1]/@href';
$urls[268] = '//table/tr/td/ul/li/a/@href';
$urls[275] = '//div[@property="dc:title"]/h3/a/@href';
$urls[288] = '//area/@href';
$urls[307] = '//ul[@class="pagenav"]/li/a/@href';
$urls[308] = '//li[@class="list-group-item"]/a/@href';
$urls[310] = '//a[contains(@href,"member.asp")]/@href';
$urls[312] = '//a[contains(@href,"meetings/councillors")]/@href';
$urls[317] = '//ul[@class="SKNavLevel5"]/li//a[contains(@href,"Council/Councillors")]/@href';
$urls[325] = '//div[@id="bodyContent"]/p/a/@href';
$urls[326] = '//li[@class="child"]/div/a/@href';
$urls[337] = '//tr/td[2]/a/@href';
$urls[339] = '//div[@class="fl pagination-pages"]/a/@href';
$urls[348] = '//div[@class="col-md-8 main-content"]/p/a/@href';
$urls[349] = '//li/a[contains(@href,"Councillor.aspx")]/@href';
$urls[351] = '//a[@class="oLinkInternal"][contains(@href,"meet-your-councillor")]/@href';
$urls[358] = '//title';
$urls[375] = '//div[@id="areapanel"]/ul/li/a/@href';
$urls[387] = '//td[contains(@class,"ms-rteTable")]/a/@href';
$urls[407] = '//tr[contains(@class,"dynamic")]/td[1]/a[1]/@href';
$urls[1002] = '//title';
$urls[1006] = '//a[contains(@href,"councillors/cllr-")]/@href';
$urls[1009] = '//div[@class="councillor-item"]/a[contains(@href,"itemid=")]/@href';

/* Define data extraction codes */
$monster[][] = array();
$monster[26][0] = '//h1[@class="tera push--bottom"]';
$monster[26][1] = '//h3[contains(text(),"Political party")]/following-sibling::p[1]';
$monster[26][2] = '//h3[contains(text(),"Electoral division")]/following-sibling::p[1]';
$monster[33][0] = '//div[@id="CentrePanel"]/h1';
$monster[33][1] = '//div[@id="CentrePanel"]/p/strong[contains(text(),"Party:")]/parent::p/text()[1]';
$monster[33][2] = '//div[@id="CentrePanel"]/p/strong[contains(text(),"Ward:")]/parent::p/text()';
$monster[37][0] = '//div[@class="item-page"]/h1';
$monster[37][1] = '//p[contains(.,"Party:")]/text()[contains(.,"Labour") or contains(.,"Independent") or contains(.,"Non-Aligned")]';
$monster[37][2] = '//p[contains(.,"Ward:")][descendant::text()]';
$monster[43][0] = '//div[@class="page-title"]/h2';
$monster[43][1] = '//div[@class="page-description"]/strong';
$monster[43][2] = '//div[@class="image"]/img/@src';
$monster[46][0] = '//tbody/tr/td[1]/a/span';
$monster[46][1] = '//tbody/tr/td[3]/span';
$monster[46][2] = '//tbody/tr/td[2]/span';
$monster[66][0] = '//div[@class="ClientAreaContainer"]/div/h1';
$monster[66][1] = '//div[@class="mgUserSideBar"]/p/span[contains(text(),"Party")]/following-sibling::text()';
$monster[66][2] = '//div[@class="mgUserSideBar"]/p/span[contains(text(),"Ward")]/following-sibling::text()';
$monster[81][0] = '//td[contains(text(),"Title:")]/following-sibling::td';
$monster[81][1] = '//td[contains(text(),"Party:")]/following-sibling::td';
$monster[81][2] = '//td[contains(text(),"Ward:")]/following-sibling::td';
$monster[97][0] = '//div[@id="headingtext"]/h1';
$monster[97][1] = '//div[contains(text(),"Party")]/following-sibling::div';
$monster[97][2] = '//div[contains(text(),"Ward")]/following-sibling::div';
$monster[108][0] = '//div[@class="page-header-inner"]/h1';
$monster[108][1] = '//h2[contains(text(),"Party")]/following-sibling::p[1][normalize-space(.)]';
$monster[108][2] = '//h3[contains(text(),"Parishes")]/following-sibling::ul/li';
$monster[113][0] = '//span[@class="thispage"]';
$monster[113][1] = '//th[contains(text(),"Political group")]/following-sibling::td';
$monster[113][2] = '//th[contains(text(),"District ward")]/following-sibling::td';
$monster[115][0] = '//h1[contains(text(),"Local Councillors")]/following-sibling::h2';
$monster[115][1] = '//p//strong[contains(text(),"Party:")]/following-sibling::text()';
$monster[115][2] = '//div//strong[contains(text(),"Ward:")]/following-sibling::text()';
$monster[120][0] = '//meta[@name="DC.title"]/@content';
$monster[120][1] = '//div[@id="article"]/p/strong[contains(text(),"Political Party:")]/following-sibling::text()[contains(.,"Conservative") or contains(.,"Labour") or contains(.,"Liberal") or contains(.,"UKIP")]';
$monster[120][2] = '//ul[@class="relatedcontacts"]/li/div[1]';
$monster[121][0] = '//h1';
$monster[121][1] = '//div[contains(text(),"Party:")]/following-sibling::div/div/a';
$monster[121][2] = '//div[@class="view-content"]/div[@class="first last odd"]/a[contains(@href,"ward/")]';
$monster[127][0] = '//div[@id="headingtext"]/h1';
$monster[127][1] = '//tr/td[contains(text(),"Political Party:")]/following-sibling::td';
$monster[127][2] = '//tr/td[contains(text(),"Ward:")]/following-sibling::td';
$monster[131][0] = '//div[@class="councillor-sub-details--top"]/a/text()';
$monster[131][1] = '//span[contains(text(),"Party")]/following-sibling::div';
$monster[131][2] = '//div[@class="councillor-sub-details--top"]/a/following-sibling::text()';
$monster[135][0] = '//div[@class="row"]/div[@class="span12"]/h1';
$monster[135][1] = '//table[@class="table table-bordered"]/tr/td[contains(text(),"Party")]/following-sibling::td';
$monster[135][2] = '//table[@class="table table-bordered"]/tr/td[contains(text(),"Ward")]/following-sibling::td';
$monster[145][0] = '//title';
$monster[145][1] = '//p[contains(text(),"Party:")]/parent::td/following-sibling::td/p';
$monster[145][2] = '//p[contains(text(),"Ward:")]/parent::td/following-sibling::td/p';
$monster[146][0] = '//h1[@class="panel-title"]';
$monster[146][1] = '//span[contains(text(),"Political grouping:")]/following-sibling::text()';
$monster[146][2] = '//span[contains(text(),"Ward:")]/following-sibling::text()';
$monster[159][0] = '//div[@id="headingtext"]/h1';
$monster[159][1] = '//tr/td[contains(text(),"Political Party:")]/following-sibling::td';
$monster[159][2] = '//tr/td[contains(text(),"Ward:")]/following-sibling::td';
$monster[167][0] = '//div[@class="ClientAreaContainer"]/div/h1';
$monster[167][1] = '//div[@class="ContentEditor"][contains(text(),"Conservative") or contains(text(),"Labour") or contains(text(),"Liberal")][not(contains(text(),"for "))] | //div[@class="ContentEditor"]/p[contains(text(),"Conservative") or contains(text(),"Labour") or contains(text(),"Liberal")][not(contains(text(),"for "))]';
$monster[167][2] = '//div[@class="ContentEditor"][contains(text(),"Conservative") or contains(text(),"Labour") or contains(text(),"Liberal")][not(contains(text(),"for "))] | //div[@class="ContentEditor"]/p[contains(text(),"Conservative") or contains(text(),"Labour") or contains(text(),"Liberal")][not(contains(text(),"for "))]';
$monster[192][0] = '//h1[@id="page-title"]';
$monster[192][1] = '//div[@class="field field-name-field-party-tax field-type-taxonomy-term-reference field-label-above"]/div[2]/div';
$monster[192][2] = '//div[@class="field field-name-field-ward-name-tax field-type-taxonomy-term-reference field-label-above"]/div[2]/div';
$monster[198][0] = '//div[@class="row"]/div[@class="col-md-9"]/h1';
$monster[198][1] = '//h2[contains(text(),"Contact Details")]/following-sibling::text()[2]';
$monster[198][2] = '//p/strong';
$monster[208][0] = '//li[@class="selected"]/div/span';
$monster[208][1] = '//div[contains(text(),"Political Party")]/following-sibling::div';
$monster[208][2] = '//div[contains(text(),"Electoral Ward")]/following-sibling::div';
$monster[209][0] = '//li[@class="even last"]/span';
$monster[209][1] = '//li/strong[contains(text(),"Party:")]/following-sibling::text()';
$monster[209][2] = '//li/strong[contains(text(),"Represents:")]/following-sibling::text()';
$monster[211][0] = '//title';
$monster[211][1] = '//h2[contains(text(),"Party")]/following-sibling::p[1]';
$monster[211][2] = '//h2[contains(text(),"Ward")]/following-sibling::p[1]';
$monster[215][0] = '//title';
$monster[215][1] = '//span[contains(text(),"Party:")]/following-sibling::span';
$monster[215][2] = '//span[contains(text(),"Area of representation:")]/following-sibling::span';
$monster[222][0] = '//tbody/tr/td[1]/a';
$monster[222][1] = '//tbody/tr/td[3]';
$monster[222][2] = '//tbody/tr/td[2]';
$monster[226][0] = '//table/tr[1]/td/div/p/b';
$monster[226][1] = '//a[contains(@href,"party")]';
$monster[226][2] = '//a[contains(@href,"ward")]';
$monster[268][0] = '//h2[contains(@class,"header")]';
$monster[268][1] = '//p/a[contains(@href,"party")]';
$monster[268][2] = '//p/a[contains(@href,"warddetail")]';
$monster[275][0] = '//h1[@class="page-header"]';
$monster[275][1] = '//div[contains(text(),"Political Party")]/following-sibling::div/div';
$monster[275][2] = '//div[contains(text(),"Ward:")]/following-sibling::div/div/a';
$monster[288][0] = '//div[contains(@style,"width: 32.5%")]/h2';
$monster[288][1] = '//div[contains(@style,"width: 32.5%")]/p/strong';
$monster[288][2] = '//div[contains(@style,"width: 32.5%")]//a/@href';
$monster[307][0] = '//div[@class="contactinfo"]/table/tr[2]/th/following-sibling::td';
$monster[307][1] = '//h1';
$monster[307][2] = '//div[@class="contactinfo"]/table/tr[1]/th/following-sibling::td';
$monster[308][0] = '//header[@id="page-header"]/h1';
$monster[308][1] = '//table[@summary="Councillor information"]/tr[2]/td';
$monster[308][2] = '//table[@summary="Councillor information"]/tr[1]/td';
$monster[310][0] = '//td[@class="valignTop"]/table/tr[1]/td[@class="outline"]';
$monster[310][1] = '//td[@class="valignTop"]/table/tr[3]/td[@class="outline"]/a';
$monster[310][2] = '//td[@class="valignTop"]/table/tr[2]/td[@class="outline"]';
$monster[312][0] = '//figcaption/p';
$monster[312][1] = '//section[@class="pageSection"]/article/div[2]/div[@class="value left"]/a';
$monster[312][2] = '//section[@class="pageSection"]/article/div[3]/div[@class="value left"]/a';
$monster[317][0] = '//head/title';
$monster[317][1] = '//head/title';
$monster[317][2] = '//li[contains(text(),"Ward")]';
$monster[325][0] = '//div[@class="page-header"]/h1';
$monster[325][1] = '//p/strong[contains(text(),"Party:")]/following-sibling::a';
$monster[325][2] = '//p/strong[contains(text(),"Ward:")]/following-sibling::text()';
$monster[326][0] = '//li[@class="odd last"]/span';
$monster[326][1] = '//div[@id="introtext"]/p';
$monster[326][2] = '//li[@class="slice1 level4"]/div/a';
$monster[337][0] = '//a[@class="currentPage"]';
$monster[337][1] = '//div[@class="councillorDetails col-sm-8 col-lg-9"]/p[1]';
$monster[337][2] = '//div[@class="councillorDetails col-sm-8 col-lg-9"]/p[2]';
$monster[339][0] = '//tr[contains(@class,"table-row-background-")]/td[2]/a';
$monster[339][1] = '//tr[contains(@class,"table-row-background-")]/td[4]';
$monster[339][2] = '//tr[contains(@class,"table-row-background-")]/td[3]';
$monster[348][0] = '//ol[@class="breadcrumb no-list"]/li[2]';
$monster[348][1] = '//ul[@class="no-list service-details"]/li/div/div/strong[contains(text(),"Party")]/parent::div/following-sibling::div';
$monster[348][2] = '//ul[@class="no-list service-details"]/li/div/div/strong[contains(text(),"Ward")]/parent::div/following-sibling::div';
$monster[349][0] = '//h1[@id="body_h1Councillor"]';
$monster[349][1] = '//span[@id="body_lblParty"]';
$monster[349][2] = '//span[@id="body_lblWard"]';
$monster[351][0] = '//h1[@id="skiplinks"]';
$monster[351][1] = '//h2[contains(text(),"Political party")]/following-sibling::p[1]/span';
$monster[351][2] = '//meta[@name="Description"]/@content';
$monster[358][0] = '//h5';
$monster[358][1] = '//h5/span[3]';
$monster[358][2] = '//b[contains(text(),"Ward:")]/following-sibling::text()';
$monster[375][0] = '//div[@id="headingtext"]/h1';
$monster[375][1] = '//div[@id="introtext"]/p';
$monster[375][2] = '//div[@id="introtext"]/p';
$monster[387][0] = '//table[contains(@class,"ms-rteTable-1")]/tbody/tr/th[2]';
$monster[387][1] = '//table[contains(@class,"ms-rteTable-1")]/tbody/tr[2]/td[2]';
$monster[387][2] = '//table[contains(@class,"ms-rteTable-1")]/tbody/tr[4]/td[2]';
$monster[407][0] = '//td[contains(text(),"Councillor:")]/following-sibling::td/strong';
$monster[407][1] = '//td[@class="dynamic"]/a[contains(@href,"party/")]';
$monster[407][2] = '//td[contains(text(),"Ward:")]/following-sibling::td/a';
$monster[1002][0] = '//span[@class="family-name"]';
$monster[1002][1] = '//span[contains(@class,"organization-name")]/a/@title';
$monster[1002][2] = '//span[contains(@class,"organization-unit")]/a/@title';
$monster[1006][0] = '//h1';
$monster[1006][1] = '//div[@class="about-section"]//text()[contains(.,"Union") or contains(.,"Social") or contains(.,"Independent") or contains(.,"Sinn")]';
$monster[1006][2] = '//div[@class="medium-12 columns"]/p/b';
$monster[1009][0] = '//article[@class="councillor-detail"]/div/h1';
$monster[1009][1] = '//article[@class="councillor-detail"]/div/h2';
$monster[1009][2] = '//article[@class="councillor-detail"]/div/h3[contains(text(),"DEA")]/following-sibling::p[1]';

/* Define child url patterns */
$childURL[] = array();
$childURL[26] = "https://www.westsussex.gov.uk";
$childURL[33] = "http://www.babergh.gov.uk";
$childURL[37] = "http://www.bolsover.gov.uk";
$childURL[43] = "https://www.broxtowe.gov.uk";
$childURL[46] = "https://www.chelmsford.gov.uk/your-council/councillors-and-decision-making/councillors/find-a-councillor/view-chelmsford-city-councillors/";
$childURL[66] = "";
$childURL[81] = "https://localdemocracy.harrogate.gov.uk/";
$childURL[97] = "";
$childURL[108] = "https://www.north-norfolk.gov.uk";
$childURL[113] = "https://www.dorsetforyou.gov.uk";
$childURL[115] = "http://www.richmondshire.gov.uk";
$childURL[120] = "";
$childURL[121] = "http://www.selby.gov.uk";
$childURL[127] = "http://www.southhams.gov.uk/";
$childURL[131] = "http://www.south-norfolk.gov.uk/your-councillors?field_parishes_target_id=All&amp;field_ward_target_id=All&amp;title=&amp;page=";
$childURL[135] = "https://www.southsomerset.gov.uk";
$childURL[145] = "";
$childURL[146] = "https://tdcdemocracy.tendringdc.gov.uk/";
$childURL[159] = "http://www.westdevon.gov.uk/";
$childURL[167] = "https://www.gosport.gov.uk";
$childURL[192] = "http://www.hart.gov.uk";
$childURL[198] = "http://www.molevalley.gov.uk";
$childURL[208] = "";
$childURL[209] = "";
$childURL[211] = "http://www.stevenage.gov.uk";
$childURL[215] = "";
$childURL[222] = "http://www.winchester.gov.uk";
$childURL[226] = "";
$childURL[268] = "http://www.calderdale.gov.uk/council/councillors/councillors/search/";
$childURL[275] = "http://my.northtyneside.gov.uk";
$childURL[288] = "";
$childURL[307] = "http://www.cne-siar.gov.uk/members/";
$childURL[308] = "http://www.falkirk.gov.uk";
$childURL[310] = "http://www.glasgow.gov.uk/councillorsandcommittees/";
$childURL[312] = "http://www.inverclyde.gov.uk";
$childURL[317] = "http://www.orkney.gov.uk/";
$childURL[325] = "http://www.west-dunbarton.gov.uk";
$childURL[326] = "";
$childURL[337] = "http://www.darlington.gov.uk";
$childURL[339] = "http://www2.eastriding.gov.uk/council/councillors-and-members-of-parliament/councillor-finder";
$childURL[348] = "";
$childURL[349] = "http://committee.northumberland.gov.uk/";
$childURL[351] = "http://www.poole.gov.uk";
$childURL[358] = "http://apps.telford.gov.uk/CouncilAndDemocracy/Councillors?page=";
$childURL[375] = "";
$childURL[387] = "https://www.ceredigion.gov.uk";
$childURL[407] = "http://www.staffordbc.gov.uk/";
$childURL[1002] = "http://www.armaghbanbridgecraigavon.gov.uk/yourcouncil/elected-members/pg/";
$childURL[1006] = "";
$childURL[1009] = "http://www.midulstercouncil.org/Council/Councillors";

/* Get url list & convert to array */
$partyList = $xpath->query($urls[$councilNumber]);
foreach($partyList as $item) {$pL[] = trim($item->nodeValue);}

/* Second stage loop for North Norfolk (108) only */
if($councilNumber == 108) {
 $pL[0] = "/members/?page=1"; $pL[1] = "/members/?page=2"; $pL[2] = "/members/?page=3"; $pL[3] = "/members/?page=4"; $pL[4] = "/members/?page=5"; $pL[5] = "/members/?page=6"; $pL[6] = "/members/?page=7"; $pL[7] = "/members/?page=8"; 
for($m=0;$m<count($pL);$m++) { $oldPL[$m] = $pL[$m]; }
unset($pL);
for($m=0;$m<count($oldPL);$m++) {
 $string = file_get_contents($childURL[$councilNumber].$oldPL[$m]);
 $doc = new DOMDocument();
 @$doc->loadHTML($string);
 $xpath = new DOMXPath($doc);
 $partyList = $xpath->query('//a[@class="committee-councillor-results-item"]/@href');
 foreach($partyList as $item) {$pL[] = str_replace("&nbsp;", "", htmlentities(addslashes(trim($item->nodeValue)), null, 'utf-8'));}
}}

/* Second stage loop for West Sussex only (26) */
if($councilNumber == 26) {
$pL[0] = "/find-my-nearest/councillor/?Keyword=&Location=&amp;politicalParty=&currentPage=1";
$pL[1] = "/find-my-nearest/councillor/?Keyword=&Location=&amp;politicalParty=&currentPage=2";
$pL[2] = "/find-my-nearest/councillor/?Keyword=&Location=&amp;politicalParty=&currentPage=3";
$pL[3] = "/find-my-nearest/councillor/?Keyword=&Location=&amp;politicalParty=&currentPage=4";
for($m=0;$m<count($pL);$m++) { $oldPL[$m] = $pL[$m]; }
unset($pL);
for($m=0;$m<count($oldPL);$m++) {
 $string = file_get_contents($childURL[$councilNumber].$oldPL[$m]);
 $doc = new DOMDocument();
 @$doc->loadHTML($string);
 $xpath = new DOMXPath($doc);
 $partyList = $xpath->query('//a[@class="list__link soft-half"]/@href');
 foreach($partyList as $item) {$pL[] = str_replace("&nbsp;", "", htmlentities(addslashes(trim($item->nodeValue)), null, 'utf-8'));}
}}

/* Second stage loop for Eastbourne only (66) */
if($councilNumber == 66) {
for($m=0;$m<count($pL);$m++) { $oldPL[$m] = $pL[$m]; }
unset($pL);
for($m=0;$m<count($oldPL);$m++) {
 $string = file_get_contents("http://www.eastbourne.gov.uk/about-the-council/councillors-and-committees/find-a-councillor/?memberid=".$oldPL[$m]);
 $doc = new DOMDocument();
 @$doc->loadHTML($string);
 $xpath = new DOMXPath($doc);
 $partyList = $xpath->query('//li[contains(@id,"furtherInformation")]/a/@href');
 foreach($partyList as $item) {$pL[] = str_replace("&nbsp;", "", htmlentities(addslashes(trim($item->nodeValue)), null, 'utf-8'));}
}}

/* Second stage loop for West Lothian only (326) */
if($councilNumber == 326) {
for($m=0;$m<count($pL);$m++) { $oldPL[$m] = $pL[$m]; }
unset($pL);
for($m=0;$m<count($oldPL);$m++) {
 $string = file_get_contents($oldPL[$m]);
 $doc = new DOMDocument();
 @$doc->loadHTML($string);
 $xpath = new DOMXPath($doc);
 $partyList = $xpath->query('//li[@class="child"]/div/a/@href');
 foreach($partyList as $item) {$pL[] = str_replace("&nbsp;", "", htmlentities(addslashes(trim($item->nodeValue)), null, 'utf-8'));}
}}

/* Special URL trim for Selby only (121) */
if($councilNumber == 121) { for($k=0;$k<count($pL);$k++) { $pL[$k] = substr($pL[$k], strpos($pL[$k], '::/')+2); }}

/* URL loader for South Norfolk only (131) */
if($councilNumber == 131) { $pL[0] = "0"; $pL[1] = "1"; $pL[2] = "2"; $pL[3] = "3"; $pL[4] = "4"; }

/* URL loader for Telford and Wreckin only (358) */
if($councilNumber == 358) { $pL[0] = "1"; $pL[1] = "2"; $pL[2] = "3"; }

/* Add additional URL for Reading only (375) */
if($councilNumber == 375) { $pL[] = "http://www.reading.gov.uk/cllrdavidabsolom"; }

/* URL loader for Armagh, Banbridge and Craigavon only (1002) */
if($councilNumber == 1002) { $pL[0] = "1"; $pL[1] = "2"; $pL[2] = "3"; $pL[3] = "4"; }

/* Main loop over each url in list */
for($k=0;$k<count($pL);$k++) {
$councilNumber = $_GET['c'];

/* Fixes for odd URLs */
if($councilNumber == 198) { $pL[$k] = substr($pL[$k],1); }

/* Download child URL as string */
$thisChildURL = $childURL[$councilNumber].$pL[$k]; echo "<br>k=".$k."/ URL=".$thisChildURL;
$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
$context = stream_context_create($opts);
$string = mb_convert_encoding(file_get_contents($thisChildURL,false,$context), "HTML-ENTITIES", "UTF-8");

/* Convert HTML to navigable DOMXPATH object */
$doc = new DOMDocument(); 
@$doc->loadHTML($string);
$xpath = new DOMXPath($doc);

/* Search strings for this file */
$name = $xpath->query($monster[$councilNumber][0]);
$party = $xpath->query($monster[$councilNumber][1]);
$ward = $xpath->query($monster[$councilNumber][2]);

/* Convert scraped data to arrays n, p and w */
foreach($name as $item) {$n[] = str_replace("&nbsp;", "", htmlentities(addslashes(trim($item->nodeValue)), null, 'utf-8'));}
foreach($party as $item) {$p[] = str_replace("&nbsp;", "", htmlentities(addslashes(trim($item->nodeValue)), null, 'utf-8'));}
foreach($ward as $item) {$w[] = str_replace("&nbsp;", "", addslashes(trim($item->nodeValue)));}

/* Loop back to next page */
unset($name);
unset($ward);
unset($party);
unset($nTmp);
unset($pTmp);
unset($wTmp);
}

?>
