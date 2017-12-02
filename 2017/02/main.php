<?php
/**
 * Created by PhpStorm.
 * User: dweipert
 * Date: 02.12.17
 * Time: 16:04
 */

/**
 * First Half
 */

$spreadsheet = fopen(__DIR__ . '/spreadsheet.tsv', 'r');
$sum = 0;

while ($row = fgetcsv($spreadsheet, 1000, "\t")) {
    $low = $row[0];
    $high = $row[0];

    foreach ($row as $v) {
        if ($v < $low) {
            $low = $v;
        }

        if ($v > $high) {
            $high = $v;
        }
    }

    $sum += ($high - $low);
}

AOC::solution('First Half', $sum);

/**
 * Second Half
 */

$spreadsheet = fopen(__DIR__ . '/spreadsheet.tsv', 'r');
$sum = 0;

while ($row = fgetcsv($spreadsheet, 1000, "\t")) {
    $num = 0;

    foreach ($row as $col) {
        foreach ($row as $col2) {
            if ($col != $col2 && $col % $col2 == 0) {
                $num = max($col, $col2) / min($col, $col2);
                break;
            }
        }
    }

    $sum += $num;
}

AOC::solution('Second Half', $sum);
