<?php
/**
 * Created by PhpStorm.
 * User: dweipert
 * Date: 09.12.17
 * Time: 12:16
 */

$txt = file_get_contents(__DIR__ . '/maze.txt');

/**
 *  First Half
 */

$maze = explode(PHP_EOL, $txt);
$i = 0;
$steps = 0;

while (true) {
    $new_i = $i + $maze[$i];
    $maze[$i] += 1;
    $i = $new_i;

    $steps++;

    if ($i > count($maze) - 1) {
        break;
    }
}

AOC::solution('First Half', $steps);

/**
 * Second Half
 */

$maze = explode(PHP_EOL, $txt);
$i = 0;
$steps = 0;

while (true) {
    $new_i = $i + $maze[$i];
    $maze[$i] += ($maze[$i] >= 3 ? -1 : 1);
    $i = $new_i;

    $steps++;

    if ($i > count($maze) - 1) {
        break;
    }
}

AOC::solution('Second Half', $steps);
