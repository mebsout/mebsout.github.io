<?php

@session_start();

error_reporting(0);

function isBot($user_agent){
  $bots = array('robot','crawler', 'spider', 'curl',
		'bingbot', 'msn', 'abacho', 'abcdatos', 'abcsearch',
		'acoon', 'adsarobot', 'aesop', 'ah-ha',
		'alkalinebot', 'almaden', 'altavista', 'antibot',
		'anzwerscrawl', 'aol', 'search', 'appie', 'arachnoidea',
		'araneo', 'architext', 'ariadne', 'arianna', 'ask',
		'jeeves', 'aspseek', 'asterias', 'astraspider', 'atomz',
		'augurfind', 'backrub', 'baiduspider', 'bannana_bot',
		'bbot', 'bdcindexer', 'blindekuh', 'boitho', 'boito',
		'borg-bot', 'bsdseek', 'christcrawler',
		'computer_and_automation_research_institute_crawler', 'coolbot',
		'cosmos', 'crawler', 'crawler@fast', 'crawlerboy', 'cruiser',
		'cusco', 'cyveillance', 'deepindex', 'denmex',
		'dittospyder', 'docomo', 'dogpile', 'dtsearch', 'elfinbot',
		'entire', 'web', 'esismartspider', 'exalead',
		'excite', 'ezresult', 'fast', 'fast-webcrawler', 'fdse',
		'felix', 'fido', 'findwhat', 'finnish', 'firefly',
		'firstgov', 'fluffy', 'freecrawl', 'frooglebot', 'galaxy',
		'gaisbot', 'geckobot', 'gencrawler', 'geobot',
		'gigabot', 'girafa', 'goclick', 'goliat', 'googlebot',
		'griffon', 'gromit', 'grub-client', 'gulliver',
		'gulper', 'henrythemiragorobot', 'hometown', 'hotbot',
		'htdig', 'hubater', 'ia_archiver', 'ibm_planetwide',
		'iitrovatore-setaccio', 'incywincy', 'incrawler', 'indy',
		'infonavirobot', 'infoseek', 'ingrid', 'inspectorwww',
		'intelliseek', 'internetseer', 'ip3000.com-crawler',
		'iron33', 'jcrawler', 'jeeves', 'jubii', 'kanoodle',
		'kapito', 'kit_fireball', 'kit-fireball', 'ko_yappo_robot',
		'kototoi', 'lachesis', 'larbin', 'legs',
		'linkwalker', 'lnspiderguy', 'look.com', 'lycos', 'mantraagent',
		'markwatch', 'maxbot', 'mercator', 'merzscope',
		'meshexplorer', 'metacrawler', 'mirago', 'mnogosearch',
		'moget', 'motor', 'muscatferret', 'nameprotect',
		'nationaldirectory', 'naverrobot', 'nazilla', 'ncsa',
		'beta', 'netnose', 'netresearchserver', 'ng/1.0',
		'northerlights', 'npbot', 'nttdirectory_robot', 'nutchorg',
		'nzexplorer', 'odp', 'openbot', 'openfind',
		'osis-project', 'overture', 'perlcrawler', 'phpdig',
		'pjspide', 'polybot', 'pompos', 'poppi', 'portalb',
		'psbot', 'quepasacreep', 'rabot', 'raven', 'rhcs',
		'robi', 'robocrawl', 'robozilla', 'roverbot', 'scooter',
		'scrubby', 'search.ch', 'search.com.ua', 'searchfeed',
		'searchspider', 'searchuk', 'seventwentyfour',
		'sidewinder', 'sightquestbot', 'skymob', 'sleek',
		'slider_search', 'slurp', 'solbot', 'speedfind', 'speedy',
		'spida', 'spider_monkey', 'spiderku', 'stackrambler',
		'steeler', 'suchbot', 'suchknecht.at-robot', 'suntek',
		'szukacz', 'surferf3', 'surfnomore', 'surveybot',
		'suzuran', 'synobot', 'tarantula', 'teomaagent', 'teradex',
		't-h-u-n-d-e-r-s-t-o-n-e', 'tigersuche', 'topiclink',
		'toutatis', 'tracerlock', 'turnitinbot', 'tutorgig',
		'uaportal', 'uasearch.kiev.ua', 'uksearcher', 'ultraseek',
		'unitek', 'vagabondo', 'verygoodsearch', 'vivisimo',
		'voilabot', 'voyager', 'vscooter', 'w3index', 'w3c_validator',
		'wapspider', 'wdg_validator', 'webcrawler',
		'webmasterresourcesdirectory', 'webmoose', 'websearchbench',
		'webspinne', 'whatuseek', 'whizbanglab', 'winona',
		'wire', 'wotbox', 'wscbot', 'www.webwombat.com.au', 'xenu',
		'link', 'sleuth', 'xyro', 'yahoobot', 'yahoo!',
		'slurp', 'yandex', 'yellopet-spider', 'zao/0', 'zealbot',
		'zippy', 'zyborg', 'mediapartners-google'
                );
  $user_agent = strtolower($user_agent);
  foreach($bots as $bot){
    if(strpos($user_agent, $bot) !== false){
      return true;
    }
  }
  return false;
}

function register_this_user(){
    /* $ip = getenv("HTTP_X_FORWARDED_FOR"); */
    $ip = $_SERVER['REMOTE_ADDR'];

    $dt = date(DATE_COOKIE);
  /* $dt = $_SERVER['REQUEST_TIME']; */

  $page_uri = $_SERVER['REQUEST_URI'];
  
  $ref = "";
  if (isset($_SERVER['HTTP_REFERER'])) {
    $ref = $_SERVER['HTTP_REFERER'];
  }

  $ua = $_SERVER['HTTP_USER_AGENT'];

  if(!isBot($ua)) {  /* Discrad robots */
    
    $domain_name =
      shell_exec("nslookup $ip | grep 'name = ' | awk -F' = ' '{print $2}'");
    $long_domain = shell_exec("nslookup $ip");
    $whois = shell_exec("whois $ip");
    
    
    $output  = "";
    $output .= "Connexion from $domain_name\n\n";
    $output .= "Date: $dt\n";
    $output .= "User Agent: $ua\n";
    $output .= "From page: $ref \n";
    $output .= "Maps:\n";
    $output .= "    http://www.localiser-ip.com/?ip=$ip\n";
    $output .= "    http://www.geoiptool.com/?IP=$ip\n";
    $output .= "    http://geomaplookup.net/?ip=$ip\n";
    $output .= "\n-----------------\nDomain:\n $long_domain";
    $output .= "\n-----------------\nWHOIS:\n $whois";
    $output .= "-----------------\n\n";


    mail ("alainmebsout@gmail.com", "Connexion to $page_uri from $domain_name" , $output);
  }
}


if ((!isset($_SESSION["REGISTERED"]) || (time() - $_SESSION["REGISTERED"]) > 86400) && !isset($_GET["moi"])){
  $_SESSION["REGISTERED"] = time();
  register_this_user ();
}
/* else{ */
/*   $_SESSION["REGISTERED"] = time(); */
/* } */

@session_commit();

?>
