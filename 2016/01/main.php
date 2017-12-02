<?php
/**
 * Created by PhpStorm.
 * User: dweipert
 * Date: 02.12.17
 * Time: 22:02
 */

$input = "L3, R2, L5, R1, L1, L2, L2, R1, R5, R1, L1, L2, R2, R4, L4, L3, L3, R5, L1, R3, L5, L2, R4, L5, R4, R2, L2, L1, R1, L3, L3, R2, R1, L4, L1, L1, R4, R5, R1, L2, L1, R188, R4, L3, R54, L4, R4, R74, R2, L4, R185, R1, R3, R5, L2, L3, R1, L1, L3, R3, R2, L3, L4, R1, L3, L5, L2, R2, L1, R2, R1, L4, R5, R4, L5, L5, L4, R5, R4, L5, L3, R4, R1, L5, L4, L3, R5, L5, L2, L4, R4, R4, R2, L1, L3, L2, R5, R4, L5, R1, R2, R5, L2, R4, R5, L2, L3, R3, L4, R3, L2, R1, R4, L5, R1, L5, L3, R4, L2, L2, L5, L5, R5, R2, L5, R1, L3, L2, L2, R3, L3, L4, R2, R3, L1, R2, L5, L3, R4, L4, R4, R3, L3, R1, L3, R5, L5, R1, R5, R3, L1";

/**
 * First Half
 */

function facing($facing, $turn)
{
    if ($turn == 'R') {
        switch ($facing) {
            case ['y', '1']:
                return ['x', '1'];
            case ['x', '1']:
                return ['y', '-1'];
            case ['y', '-1']:
                return ['x', '-1'];
            case ['x', '-1']:
                return ['y', '1'];
        }
    } else if ($turn == 'L') {
        switch ($facing) {
            case ['y', '1']:
                return ['x', '-1'];
            case ['x', '-1']:
                return ['y', '-1'];
            case ['y', '-1']:
                return ['x', '1'];
            case ['x', '1']:
                return ['y', '1'];
        }
    }
}

$x = 0;
$y = 0;
$facing = ['y', '1'];

foreach (explode(',', $input) as $direction) {
    $direction = trim($direction);

    $turn = substr($direction, 0, 1);
    $length = intval(substr($direction, 1));

    $facing = facing($facing, $turn);

    ${$facing[0]} += ($length * intval($facing[1]));
}

AOC::solution('First Half', abs($x) + abs($y));

/**
 * Second Half
 */

$x = 0;
$y = 0;
$facing = ['y', '1'];
$visited = [];

foreach (explode(',', $input) as $direction) {
    $direction = trim($direction);

    $turn = substr($direction, 0, 1);
    $length = intval(substr($direction, 1));

    $facing = facing($facing, $turn);

    $break = false;

    for ($i = 1; $i <= $length; $i++) {
        ${$facing[0]} += (1 * intval($facing[1]));

        foreach ($visited as $v) {
            if ($v == [$x, $y]) {
                $break = true;
                break;
            }
        }

        if ($break) {
            break;
        }

        $visited[] = [$x, $y];
    }

    if ($break) {
        break;
    }
}

AOC::solution('Second Half', abs($x) + abs($y));
