<?php
function __autoload($className)
{
	$className = str_replace("levidurfee\\", "", $className);
    include "src" . DIRECTORY_SEPARATOR . $className . ".php";
}
spl_autoload_register("__autoload");