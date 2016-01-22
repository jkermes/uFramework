<?php

$cacheFilePath = __DIR__ . '/cache.php';

if (file_exists($cacheFilePath)) {
    $cache = require $cacheFilePath;
}
else {
    $cache = array();
}

spl_autoload_register(function ($className) use (&$cache, $cacheFilePath) {
    if (isset($cache[$className])) {
        $path = $cache[$className];   
    }
    else {
        $path = str_replace(array('\\', '_'), '/', $className) . '.php';
    }    
    
    $completePath = __DIR__ . '/' . $path;
    
    if (file_exists($completePath)) {
        require_once($completePath);
        $cache[str_replace(array('\\', '_'), '/', $className)] = $path;
    }

    file_put_contents($cacheFilePath, sprintf("<?php\n return %s;", var_export($cache, true)));
});


