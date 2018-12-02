<?php
/**
 * Created by PhpStorm.
 * User: dweipert
 * Date: 02.12.18
 * Time: 20:00
 */

$list = explode(
    "\n",
    trim(
        file_get_contents(
            __DIR__ . '/input.txt'
        )
    )
);

/**
 * First Half
 */

$r = 0;
foreach ($list as $v) {
    $r += intval($v);
}

AOC::solution('First Half', $r);

/**
 * Second Half
 */

$r = 0;
$freqs = [];
#$list = ['+7', '+7', '-2', '-7', '-4'];
$count = count($list);
$run = true;
for ($i = 0; true; $i++) {
    $el = $list[$i];
    if ($i+1 == $count) $i = -1;
    $r += intval($el);

    if (in_array($r, $freqs)) break;
    $freqs[] = $r;
}

AOC::solution('Second Half', $r);
