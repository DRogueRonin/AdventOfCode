<?php
/**
 * Created by PhpStorm.
 * User: dweipert
 * Date: 03.12.18
 * Time: 17:15
 */

ini_set('memory_limit', '512M');

$input = explode("\n", trim(file_get_contents(__DIR__ . '/input.txt')));

/**
 * First Half
 */

$parsed = [];
foreach ($input as $row) {
    preg_match('~#(\d+) @ (\d+),(\d+): (\d+)x(\d+)~', $row, $matches);
    $parsed[] = (object)[
        'id' => $matches[1],
        'rect' => (object)[
            'left' => $matches[2],
            'top' => $matches[3],
            'wide' => $matches[4],
            'tall' => $matches[5],
        ],
    ];
}

$matrix = [];
foreach (range(0, 1000) as $row) {
    foreach (range(0, 1000) as $col) {
        $matrix[$row][$col] = 0;
    }
}

foreach ($parsed as $item) {
    foreach (range($item->rect->left, $item->rect->left+$item->rect->wide-1) as $row) {
        foreach (range($item->rect->top, $item->rect->top+$item->rect->tall-1) as $col) {
            $matrix[$row][$col] += 1;
        }
    }
}

$flattened = \Underscore\Types\Arrays::flatten($matrix);
$solution = array_filter($flattened, function ($item) {
    return $item > 1;
});

AOC::solution('First Half', count($solution));

/**
 * Second Half
 */

$solution = '';
foreach ($parsed as $item) {
    $cells = $item->rect->wide * $item->rect->tall;

    foreach (range($item->rect->left, $item->rect->left+$item->rect->wide-1) as $row) {
        foreach (range($item->rect->top, $item->rect->top+$item->rect->tall-1) as $col) {
            if ($matrix[$row][$col] === 1) {
                $cells--;
            }
        }
    }

    if ($cells === 0) {
        $solution = $item->id;
        break;
    }
}

AOC::solution('Second Half', $solution);
