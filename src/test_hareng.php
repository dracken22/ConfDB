<?php

function my_autoloader($class) {
    include $class . '.php';
}

spl_autoload_register('my_autoloader');
set_time_limit(0);

$languageFr = 1;
$languageEn = 2;

// MES TEST
echo '<h1>On est bien là !</h1>';