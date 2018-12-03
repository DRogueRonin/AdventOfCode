<?php
/**
 * Created by PhpStorm.
 * User: dweipert
 * Date: 03.12.18
 * Time: 17:15
 */

$input = explode("\n", trim(file_get_contents(__DIR__ . '/input.txt')));

/**
 * First Half
 */

$parsed = [];
foreach ($input as $row) {
    preg_match('~#(\d+) @ (\d+),(\d+): (\d+)x(\d+)~', $row, $matches);
    $parsed[] = (object)[
        'id' => $matches[1],
        'rect' => [
            'left' => $matches[2],
            'top' => $matches[3],
            'wide' => $matches[4],
            'tall' => $matches[5],
        ],
    ];
}

foreach ($parsed as $item) {

}

AOC::solution('First Half', '');

/**
 * Second Half
 */



AOC::solution('Second Half', '');
