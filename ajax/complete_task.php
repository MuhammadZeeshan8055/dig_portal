<?php

include('../session.php');
include('../database.php');

$obj = new Database();

$id = $_POST['id'];

// check task exists (optional but safe)
$obj->select("task_management", "*", null, "id = $id");
$task = $obj->getResult();

if (!empty($task)) {

    // update status
    $update = $obj->update(
        "task_management",
        ["status" => "completed"],
        "id=$id"
    );

    if ($update) {
        echo "success";
    } else {
        echo "error";
    }

} else {
    echo "error";
}