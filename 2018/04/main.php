<?php
/**
 * Created by PhpStorm.
 * User: dweipert
 * Date: 2018-12-04
 * Time: 22:08
 */

$input = explode("\n", trim(file_get_contents(__DIR__ . '/input.txt')));

// sort
$parsed = [];
foreach ($input as $row) {
    preg_match('~\[(.*)\] .*~', $row, $matches);

    $parsed[] = [
        'date' => new DateTime($matches[1]),
        'string' => $matches[0],
    ];
}
$sorted = $parsed;
usort($sorted, function ($a, $b) {
    return $a['date'] <=> $b['date'];
});

// assign and group by guards
$guards = [];
$current_guard = 0;
$prev_time = $sorted[0]['date'];
foreach ($sorted as $row) {
    preg_match('~Guard #(\d+)~', $row['string'], $guard);
    if (isset($guard[1])) {
        $current_guard = $guard[1];
    }

    $row['guard'] = $current_guard;
    $row['prev_time'] = $prev_time;
    $guards[$current_guard][] = $row;

    $prev_time = $row['date'];
}

// calculate times
$guard_most_asleep = ['meta' => ['asleep' => 0]];
$guard_most_asleep_min = ['meta' => ['minute_most_asleep_value' => 0]];
foreach ($guards as $id => $guard) {
    $awake = 0;
    $asleep = 0;
    $time_most_asleep = 0;
    $date_most_asleep = 0;

    // second half
    $minutes = [];
    foreach (range(0, 60) as $col) {
        $minutes[$col] = 0;
    }

    foreach ($guard as $row) {
        if (strpos($row['string'], 'falls asleep')) {
            $awake += $row['prev_time']->diff($row['date'])->i;
        }
        else if (strpos($row['string'], 'wakes up')) {
            $slept = $row['prev_time']->diff($row['date'])->i;
            $asleep += $slept;
            if ($time_most_asleep < $slept) {
                $time_most_asleep = $slept;
                $date_most_asleep = $row['prev_time'];
            }

            // second half
            foreach (range(intval($row['prev_time']->format('i')), intval($row['date']->format('i'))) as $min) {
                $minutes[$min] += 1;
            }
        }

        /*/
        ob_start();
        echo ($row['string']);echo "\n";
        echo ($row['prev_time']->format('Y-m-d H:i'));echo "\n";
        echo ($row['date']->format('Y-m-d H:i'));echo "\n";
        echo ('diff: ' . $row['prev_time']->diff($row['date'])->i);echo "\n";
        echo ('awake: ' . $awake);echo "\n";
        echo ('asleep: ' . $asleep);echo "\n";
        echo "\n";echo "\n";
        file_put_contents(__DIR__ . '/debug_input.txt', ob_get_clean(), FILE_APPEND);
        /*/
    }

    $minute_most_asleep_value = max($minutes);
    $guard['meta'] = [
        'guard' => $id,
        'awake' => $awake,
        'asleep' => $asleep,
        'time_most_asleep' => $time_most_asleep,
        'date_most_asleep' => $date_most_asleep,
        'minutes' => $minutes,
        'minute_most_asleep_value' => $minute_most_asleep_value,
        'minute_most_asleep' => array_search(max($minutes), $minutes),
    ];

    // get most sleepy guard
    if ($guard_most_asleep['meta']['asleep'] < $asleep) {
        $guard_most_asleep = $guard;
    }

    // get most sleepy guard by minute
    if ($guard_most_asleep_min['meta']['minute_most_asleep_value'] < $minute_most_asleep_value) {
        $guard_most_asleep_min = $guard;
    }
}

AOC::solution('First Half', $guard_most_asleep['meta']['guard'] * $guard_most_asleep['meta']['minute_most_asleep']);

AOC::solution('Second Half', $guard_most_asleep_min['meta']['guard'] * $guard_most_asleep_min['meta']['minute_most_asleep']);

/*/
// debug check
$print = array_map(function ($item) {
    $string = implode(' -- ', $item);
    return "{$item[0]['guard']} -- {$item[0]['string']} -- $string";
}, $guards);
file_put_contents(__DIR__ . '/sorted_input.txt', implode("\n", $print));
/*/
