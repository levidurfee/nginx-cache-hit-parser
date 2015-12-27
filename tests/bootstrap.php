<?php
date_default_timezone_set("America/New_York");
function loader($class)
{
    $file = $class . ".php";
    if (file_exists($file)) {
        require $file;
    }
}
spl_autoload_register("loader");