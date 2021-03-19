<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/-bwm/b-php/Bwm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/-bwm/b-php/file/File.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/-bwm/b-php/site/Site.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/-bwm/b-php/page/Page.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/home/class/conf/SiteConf.php';

//spl_autoload_register('b_autoload');

/*spl_autoload_register('b_loadConf');
spl_autoload_register('b_loadBwm');
spl_autoload_register('b_loadSvc');*/

//require_once $_SERVER['DOCUMENT_ROOT'] . '/-bwm/bwm/file/File.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/-bwm/bwm/page/Page.php';




use Bwm\Bwm;
use Bwm\Site\Site;
use Bwm\Conf\SiteConf;
use Bwm\Page\Page;
use Bwm\File\File;


$site = new Site();
$site_conf = new SiteConf();
$page = new Page();
$file = new File();

$B = new Bwm();
$B->site_conf = new SiteConf();
$B->file = new File();

$B->file->getFileName();








function b_autoload($class)
{
	//$file = new \Bwm\File\File();
	$file = new File();
	$list = $file->getRcsFileList('-bwm/bwm');

	foreach ($list as $v) {
		echo $v . '<br>';
		$v = $_SERVER['DOCUMENT_ROOT'] . $v;
		//if (file_exists($v)) {
		require_once $v;
		//}
	}
}

/*$file = new File();
$list = $file->getRcsFileList('./-bwm/bwm');
$file->show($list);*/
//exit;
function b_loadBwm($class)
{
	$dir = $_SERVER['DOCUMENT_ROOT'] . '/-bwm/bwm';
	b_loadAuto($dir, $class);
}

function b_loadConf($class)
{
	$dir = $_SERVER['DOCUMENT_ROOT'] . '/home/class/-bwm-conf';
	b_loadAuto($dir, $class);
}

function b_loadSvc($class)
{
	$dir = $_SERVER['DOCUMENT_ROOT'] . '/home/class/svc';
	b_loadAuto($dir, $class);
}

function b_loadAuto($dir, $class)
{
	$class = explode('\\', $class . '.php');
	$class = end($class);
	$path = $dir . '/' . $class;

	if (file_exists($path)) {
		require_once $path;
	}
}