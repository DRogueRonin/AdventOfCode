<?php
/**
 * Created by PhpStorm.
 * User: dweipert
 * Date: 03.12.17
 * Time: 09:03
 */

$input = 325489;

/**
 * Second Half
 */

$n = 0;
$coord = [
    serialize([0, 0]) => 1,
];

function getNext($new_coord, &$coord, $input)
{
    // get next number
    $new_sum = sumNeighbouring($new_coord, $coord);

    // win condition
    if ($new_sum > $input) {
        AOC::solution('Second Half', $new_sum);
        exit;
    }

    // add new coordinates with number
    $coord[serialize($new_coord)] = $new_sum;
}

function sumNeighbouring($new, $coord)
{
    // get all possible neighbours
    $ru = [$new[0] + 1, $new[1] + 1];
    $r = [$new[0] + 1, $new[1]];
    $rd = [$new[0] + 1, $new[1] - 1];
    $lu = [$new[0] - 1, $new[1] + 1];
    $l = [$new[0] - 1, $new[1]];
    $ld = [$new[0] - 1, $new[1] - 1];
    $u = [$new[0], $new[1] + 1];
    $d = [$new[0], $new[1] - 1];
    $neighbours = compact('ru', 'r', 'rd', 'lu', 'l', 'ld', 'u', 'd');

    $nn = 0;

    // check if neighbour exists and if add its value
    foreach ($neighbours as $neighbour) {
        $nn += $coord[serialize($neighbour)] ?? 0;
    }

    return $nn;
}

$direction = true;

while (true) {
    $n++;

    // get next x coordinates
    for ($i = 1; $i <= $n; $i++) { // x
        $last = @unserialize(end(array_keys($coord)));
        if ($direction) {
            getNext([$last[0] + 1, $last[1]], $coord, $input);
        } else {
            getNext([$last[0] - 1, $last[1]], $coord, $input);
        }
    }

    // get next y coordinates
    for ($j = 1; $j <= $n; $j++) { // y
        $last = @unserialize(end(array_keys($coord)));
        if ($direction) {
            getNext([$last[0], $last[1] + 1], $coord, $input);
        } else {
            getNext([$last[0], $last[1] - 1], $coord, $input);
        }
    }

    // change direction from right/up to left/down
    $direction = ! $direction;
}
