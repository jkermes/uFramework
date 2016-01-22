<?php

$cacheFilePath = __DIR__ . '/app/cache.php';

$sourceDirectories = [
    'src' => 'src',
    'tests' => 'tests',
];

if (file_exists($cacheFilePath)) {
    $cache = require $cacheFilePath;
}
else {
    $cache = array();
}

spl_autoload_register(function ($className) use (&$cache, $cacheFilePath, $sourceDirectories) {
    if (isset($cache[$className])) {
        $path = $cache[$className];   
    }
    else {
        $path = str_replace(array('\\', '_'), '/', $className) . '.php';
    }

    foreach ($sourceDirectories as $key => $dir) {
        $completePath = __DIR__ . '/' . $dir . '/' . $path;

        if (file_exists($completePath)) {
            require_once($completePath);
            $cache[str_replace(array('\\', '_'), '/', $className)] = $path;
        }
    }

    file_put_contents($cacheFilePath, sprintf("<?php\n return %s;", var_export($cache, true)));
});


