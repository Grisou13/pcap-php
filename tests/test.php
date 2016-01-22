<?php
/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 28.10.2015
 * Time: 08:45
 */

use LibPcap\Reader;

require_once dirname(__FILE__)."/../vendor/autoload.php";
error_reporting(E_ALL);

$a = array("some"=>"data","something","other","than that common");
$b = array("some"=>"thing","dsfngfh","asdf");
/*function foo($test)
{
  return false;
}
$bar = @foo();
var_dump($bar);
var_dump($bar["test"]);
var_dump(isset($bar));
var_dump(empty($bar));
die();*/
//var_dump(array_merge($b,$a));
//die();

$r = new Reader();
$r->open(__DIR__."/http_gzip.cap");

foreach($r->packets() as $p)
{

  var_dump($p->getProtocol()->protocolName);
}
