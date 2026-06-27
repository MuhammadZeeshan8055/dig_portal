<?php

include('../session.php');

// 1) Determine year/month (default to today if none posted)
$month_name = $_POST['month'] ?? date('F');
$month_num  = date('n', strtotime($month_name));
$year       = date('Y');

// 2) Compute days to loop
$firstOfMonth  = "$year-$month_num-01";
$totalInMonth  = date('t', strtotime($firstOfMonth));
$isCurrent     = ($year == date('Y') && $month_num == date('n'));
$lastDayToShow = $isCurrent ? date('j') : $totalInMonth;

// 3) Fetch all records for this staff and month
$where = "
    staff_id = '{$staff_id}'
    AND YEAR(shift_date)  = {$year}
    AND MONTH(shift_date) = {$month_num}
";
$obj->select('attendance_record', '*', null, $where);
$rows = $obj->getResult();

// 4) Index rows by date
$byDate = [];
foreach ($rows as $r) {
    $key = date('Y-m-d', strtotime($r['shift_date']));
    $byDate[$key] = $r;
}

// 5) Build table
echo '<table class="table">
        <thead style="position: sticky; top: 0; background: white; z-index: 2;">
            <tr>
                <th class="fs-3 ps-0">Shift Date</th>
                <th class="fs-3">Start Time</th>
                <th class="fs-3">End Time</th>
                <th class="fs-3">Worked Hours</th>
                <th class="fs-3">Overtime</th>
            </tr>
        </thead>
        <tbody>';

// 6) Loop through each day
for ($d = 1; $d <= $lastDayToShow; $d++) {
    $current = date('Y-m-d', strtotime("$year-$month_num-$d"));
    $weekday = date('w', strtotime($current));

    // Sunday
    if ($weekday === '0') {
        echo '<tr style="background:#f9f9f9;">
                <td class="ps-0 fs-3">'. formatDate($current) .'</td>
                <td colspan="4" class="fs-3 text-center text-muted">Holiday</td>
              </tr>';
        continue;
    }

    if (isset($byDate[$current])) {
        extract($byDate[$current]);
        $hrs   = (int) explode(' ', $worked_hours)[0];
        $style = $hrs < $total_working_hours ? 'style="color:red;"' : '';
        $cls   = $style ? 'text-danger' : 'text-success';

        echo "<tr {$style}>
                <td {$style} class=\"ps-0 fs-3\">". formatDate($shift_date) ."</td>
                <td {$style} class=\"fs-3\">{$start_time}</td>
                <td {$style} class=\"fs-3\">{$end_time}</td>
                <td {$style} class=\"pe-0\">
                    <span class=\"{$cls} fw-medium fs-3\">{$worked_hours}</span>
                </td>
                <td {$style}>{$overtime}</td>
              </tr>";
    } else {
        echo "<tr>
                <td class='ps-0 fs-3 text-danger'>". formatDate($current) ."</td>
                <td class='fs-3 text-danger'>--</td>
                <td class='fs-3 text-danger'>--</td>
                <td class='fs-3 text-danger'>--</td>
                <td class='fs-3 text-danger'>--</td>
              </tr>";
    }
}

echo '</tbody></table>';
?>