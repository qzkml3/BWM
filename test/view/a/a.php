<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/test/load-bwm.php';

$b->setLayout('sub');
$b->setTitle('a');

require_once $b->getPage();
?>