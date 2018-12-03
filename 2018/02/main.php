<?php
/**
 * Created by PhpStorm.
 * User: dweipert
 * Date: 02.12.18
 * Time: 20:12
 */

$input = explode("\n", file_get_contents(__DIR__ . '/input.txt'));

/**
 * First Half
 */

$two_times = 0;
$three_times = 0;

foreach ($input as $id) {
    $id = str_split($id);
    $occ = array_count_values($id);

    if (in_array(2, $occ)) {
        $two_times++;
    }
    if (in_array(3, $occ)) {
        $three_times++;
    }
}

AOC::solution('First Half', $two_times * $three_times);

/**
 * Second Half
 */

$id = '';
foreach ($input as $outer) {
    $outer = str_split($outer);
    foreach ($input as $inner) {
        $inner = str_split($inner);

        if ($inner == $outer) continue;

        $diff = array_intersect_assoc($outer, $inner);
        if (count($diff) == count($outer)-1) {
            $id = implode($diff);
            break 2;
        }
    }
}

AOC::solution('Second Half', $id);
