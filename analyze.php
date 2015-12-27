<?php
error_reporting(0);
include('src' . DIRECTORY_SEPARATOR . 'fcgiCacheAnalyze.php');
echo "Website\n";
$c = new levidurfee\fcgiCacheAnalyze('sample' . DIRECTORY_SEPARATOR . 'website.cache.txt');
$c->analyze();