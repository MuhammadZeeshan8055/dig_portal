<?php

include('../session.php');

$table = $_POST['table'] ?? '';
$id = $_POST['id'] ?? '';

$id = (int) $id;

// whitelist tables (VERY IMPORTANT for security)
$allowedTables = [
    'task_management',
    'fares',
    'discounted_fares',
    'group_bookings',
    'group_queries'
];

if (!in_array($table, $allowedTables)) {
    echo "error";
    exit;
}

// check record exists (optional but safe)
$obj->select($table, "*", null, "id = $id");
$record = $obj->getResult();

if (!empty($record)) {

    $delete = $obj->delete($table, "id=$id");

    echo $delete ? "success" : "error";

} else {
    echo "error";
}