<?php
define('FORMAT_STRING', 'Y-m-d H:i:s.u');
$value = '2015-01-22 17:57:50.504835';

/**
 * 
 * @var DateTime $val
 */
$val = \DateTime::createFromFormat(FORMAT_STRING, $value);

var_dump($val);

echo $val->format('Y-m-d H:i:s.u');