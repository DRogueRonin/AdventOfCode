<?php
/**
 * Created by PhpStorm.
 * User: dweipert
 * Date: 02.12.17
 * Time: 16:38
 */

class AOC
{
    public static function debug($s)
    {
        echo "\e[31m$s\e[0m";
    }

    public static function solution($text, $solution)
    {
        echo "\e[34m$text\e[0m: \e[32m$solution\e[0m\n";
    }
}

$year = $argv[1];
$day = $argv[2] ?? $argv[1];

if (! isset($argv[2])) {
    $year = date("y");
}

$day = sprintf('%02d', $day);
$include = __DIR__ . "/20$year/$day/main.php";

if (file_exists($include)) {
    require 'vendor/autoload.php';
    include $include;
} else {
    AOC::debug($include . " doesn't exist!\nDay {$argv[1]} not yet created!\n");
}
