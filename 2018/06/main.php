<?php
/**
 * Created by PhpStorm.
 * User: dweipert
 * Date: 2018-12-06
 * Time: 16:34
 */

$input = explode("\n", file_get_contents(__DIR__ . '/input.txt'));
$input = array_map(function ($item) {
    return explode(',', str_replace(' ', '', $item));
}, $input);

# matrix = 349x359 - highestX x highestY
$maxX = 349; $maxY = 359;
$matrix = [];
$area = array_fill(-1, count($input)+1, 0);
$total = [];
foreach (range(0, $maxX) as $x) {
    foreach (range(0, $maxY) as $y) {
        $closest = PHP_INT_MAX;
        $point = -1;

        foreach ($input as $key => $coord) {
            $dist = abs($x - $coord[0]) + abs($y - $coord[1]);

            // Second Half
            $total[$x][$y] = ($total[$x][$y] ?? 0) + $dist;

            if ($dist < $closest) {
                $closest = $dist;
                $point = $key;
            } else if ($dist == $closest) {
                $point = -1;
            }
        }

        $area[$point] += 1;
        $matrix[$x][$y] = $point;
    }
}

// traverse edges for infinite removal
foreach (range(0, $maxX) as $x) {
    $point = $matrix[$x][0];
    if (isset($area[$point])) unset($area[$point]);
    $point = $matrix[$x][$maxY];
    if (isset($area[$point])) unset($area[$point]);
}
foreach (range(0, $maxY) as $y) {
    $point = $matrix[0][$y];
    if (isset($area[$point])) unset($area[$point]);
    $point = $matrix[$maxX][$y];
    if (isset($area[$point])) unset($area[$point]);
}

AOC::solution('First Half', max($area));

$region = 0;
foreach (range(0, $maxX) as $x) {
    foreach (range(0, $maxY) as $y) {
        if ($total[$x][$y] < 10000) {
            $region++;
        }
    }
}

AOC::solution('Second Half', $region);

#file_put_contents(__DIR__ . '/matrix.txt', print_r($matrix, true));
#file_put_contents(__DIR__ . '/input_parsed.txt', print_r($input, true));
#file_put_contents(__DIR__ . '/area.txt', print_r($area, true));
