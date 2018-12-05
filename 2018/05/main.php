<?php
/**
 * Created by PhpStorm.
 * User: dweipert
 * Date: 2018-12-05
 * Time: 18:40
 */

$input = file_get_contents(__DIR__ . '/input.txt');

$letters = range('a', 'z');
$solution = $input;
$lengths = [];

$outer_letters = array_merge($letters, [0]); # to have the last iteration be the correct result for the First Half
foreach ($outer_letters as $outer_letter) {
    $solution = str_replace([$outer_letter, strtoupper($outer_letter)], '', $input);

    while (true) {
        $continue = false;

        foreach ($letters as $letter) {
            $pair = $letter . strtoupper($letter);
            $pair_rev = strrev($pair);

            if (strpos($solution, $pair) !== false || strpos($solution, $pair_rev) !== false) {
                $solution = str_replace([$pair, $pair_rev], '', $solution);
                $continue = true;
            }
        }

        if (! $continue) {
            $lengths[] = strlen($solution);
            break;
        }
    }
}

AOC::solution('First Half', strlen($solution));
AOC::solution('Second Half', min($lengths));
