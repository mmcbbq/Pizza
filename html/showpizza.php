<?php

function myAutoloader($className)
{
    $classFile = "../Class/" . $className . '.php'; //Class/Kundedfgfdg.php

    if (file_exists($classFile)) {
        require_once $classFile;
    }
}
spl_autoload_register('myAutoloader');
$pizza = new Pizza($_POST['gk'],8);
//print_r( $pizza);
print_r($_POST);