<?php

include('../session.php');

$id = (int) $_POST['id'];

$obj->select("fares", "status", null, "id = $id");

$fare = $obj->getResult();

if (!empty($fare)) {

    $currentStatus = $fare[0]['status'];

    $newStatus = ($currentStatus == 'active') ? 'inactive' : 'active';

    $update = $obj->update(
        "fares",
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