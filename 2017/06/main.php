<?php
/**
 * Created by PhpStorm.
 * User: dweipert
 * Date: 09.12.17
 * Time: 13:24
 */

$input = "14	0	15	12	11	11	3	5	1	6	8	4	9	1	8	4";

/**
 * First Half
 */

$list = explode("\t", $input);
$configs = [
    $list,
];
$cycles = 0;

while (true) {
    $max_v = max($list);
    $max_k = array_keys($list, $max_v)[0];
    $list[$max_k] = 0;

    for ($i = $max_v, $j = $max_k + 1;
        $i > 0;
        $i--, $j++) {
        if ($j >= count($list)) {
            $j = 0;
        }

        $list[$j]++;
    }

    $cycles++;

    if (in_array($list, $configs)) {
        break;
    }

    $configs[] = $list;
}

AOC::solution('First Half', $cycles);

/**
 * Second Half
 */

$loop = array_keys($configs, $list)[0];
$size = count($configs) - $loop;

AOC::solution('Second Half', $size);
