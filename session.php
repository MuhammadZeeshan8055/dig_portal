<?php

session_start();

if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $base_url = "http://localhost/dig_portal/";
} else {
    $base_url = "https://dhotharinternational.com/dhothar_dig_portal/";
}

$userrole = 'Super Admin';

function pr($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";

    die();
}

function formatDate($date)
{
    if (empty($date)) {
        return "";
    }

    return date("d-m-Y", strtotime($date));
}
?>