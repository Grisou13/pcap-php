<?php
/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 28.10.2015
 * Time: 08:45
 */

use LibPcap\Reader;

function __autoload($cls)
{
    //echo "Tentative de chargement de $cls.php\n";
    require $cls.".php";
}

$a = array("some"=>"data","something","other","than that common");
$b = array("some"=>"thing","dsfngfh","asdf");

//var_dump(array_merge($b,$a));
//die();

$r = new Reader();
$r->open(__DIR__."/../../tests/fixture/20151030_ShavatvPlus_boot.pcap");

foreach($r->packets()-limit(10) as $p)
{

  var_dump($p->getProtocol());
}
