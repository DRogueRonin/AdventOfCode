<?php
/**
 * Created by PhpStorm.
 * User: dweipert
 * Date: 09.12.17
 * Time: 14:38
 */

use \Underscore\Types\Arrays;

function eval_tower()
{
    $txt = file_get_contents(__DIR__ . '/tower.txt');

    $tower = [];

    foreach (explode("\n", $txt) as $data) {
        $brace_start = strpos($data, '(');
        $brace_end = strpos($data, ')');

        $program = substr($data, 0, $brace_start - 1);
        $weight = substr($data, $brace_start + 1, $brace_end - $brace_start - 1);
        $sub = explode(', ', substr($data, strpos($data, '>') + 2));

        $tower[$program] = [
            'weight' => $weight,
            'sub' => $sub,
        ];
    }

    file_put_contents(__DIR__ . '/tower.json', json_encode($tower));
}

#eval_tower();

$tower = json_decode(file_get_contents(__DIR__ . '/tower.json'));

// TODO: build nested tower array

/**
 * First Half
 */

// TODO: get first value of tower array

AOC::solution('First Half', 'rqwgj');

/**
 * Second Half
 */

// TODO: calculate weights and check for unbalanced towers
