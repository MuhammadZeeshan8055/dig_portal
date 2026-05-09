<?php
include('../session.php');

$id = (int) $_POST['id'];

$obj->select("task_management", "status", null, "id = $id");
$task = $obj->getResult();

if (!empty($task)) {
    $currentStatus = $task[0]['status'];

    $newStatus = ($currentStatus === 'completed') ? 'incomplete' : 'completed';

    $update = $obj->update(
        "task_management",
        ["status" => $newStatus],
        "id = $id"
    );

    if ($update) {
        echo $newStatus;
    } else {
        echo "error";
    }
} else {
    echo "error";
}