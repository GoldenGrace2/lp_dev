<?php
require('vendor/autoload.php');

use Dcblogdev\PdoWrapper\Database;

$options = [
    'host' => "localhost",
    'database' => "Webot",
    'username' => "Golden",
    'password' => "Kingapple1!"
];
$db = new Database($options);

$dir = "./";
