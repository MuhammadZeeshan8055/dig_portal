<?php

include('../session.php');
include('../database.php');

$obj = new Database();

$id = $_POST['id'];

// get task first (optional safety)
$obj->select("task_management", "*", null, "id = $id");
$task = $obj->getResult();

if (!empty($task)) {

    $delete = $obj->delete("task_management", "id=$id");

    if ($delete) {
        echo "success";
    } else {
        echo "error";
    }

} else {
    echo "error";
}