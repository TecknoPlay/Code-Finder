<?php
error_reporting(-1);
ini_set('display_errors', 1);
include("CodeFinder.class.php");

$result = CodeFinder::find('test',"/var/www","php");

?>