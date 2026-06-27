<?php

include('../session.php');

$current_month = date("F");
$year = date('Y');


if (isset($_POST['Empid'])) {
    $start_time = currentTime(); // Get current time

    $data = [
        "staff_id" => $_POST['Empid'],
        "shift_date" => currentDate(),
        "start_time" => $start_time,
        "month" => $current_month,
        "year" => $year
    ];

    if ($obj->insert("attendance_record", $data)) {
        echo json_encode(["status" => 1, "start_time" => $start_time]);
    } else {
        echo json_encode(["status" => 0]);
    }
}



?>