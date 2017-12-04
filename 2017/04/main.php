<?php
/**
 * Created by PhpStorm.
 * User: dweipert
 * Date: 04.12.17
 * Time: 14:27
 */

$passphrases = file_get_contents(__DIR__ . '/passphrases.txt');

/**
 * First Half
 */

$valid = 0;

foreach (explode("\n", $passphrases) as $passphrase) {
    $passphrase = explode(' ', $passphrase);

    if ($passphrase == array_unique($passphrase)) {
        $valid++;
    }
}

AOC::solution('First Half', $valid);

/**
 * Second Half
 */

$valid = 0;
$continue = false;

foreach (explode("\n", $passphrases) as $p) {
    $ws = explode(' ', $p);

    for ($i = 0; $i < count($ws); $i++) {
        $w = $ws[$i];
        $w = str_split($w);
        sort($w);
        $w = implode('', $w);

        for ($j = $i + 1; $j < count($ws); $j++) {
            $w2 = $ws[$j];
            $w2 = str_split($w2);
            sort($w2);
            $w2 = implode('', $w2);

            if ($w == $w2) {
                $continue = true;
                break;
            }
        }

        if ($continue) {
            break;
        }
    }

    if ($continue) {
        $continue = false;
        continue;
    }

    $valid++;
}

AOC::solution('Second Half', $valid);
