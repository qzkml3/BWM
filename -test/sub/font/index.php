<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/home/load-bwm.php';

$B->page->setTitle('');
$B->page->setLayout('sub');
$B->setTag('font');

require_once $B->page->getPage();
?>