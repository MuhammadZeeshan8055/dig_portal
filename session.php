<?php

session_start();
include('database.php');

$obj = new Database();

if (!isset($_SESSION['staff_id'])) {

    header("Location: login.php");
    exit;
}

$total_working_hours = 8 ?? null;


$staff_id = $_SESSION['staff_id'];
$userrole = $_SESSION['role'];
$staff_name = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];


$join = "LEFT JOIN staff_profile ON staff_profile.staff_id = staff_login.id
        LEFT JOIN staff_permissions ON staff_permissions.staff_id = staff_login.id";
$obj->select(
    "staff_login",
    "staff_login.*, staff_profile.*,staff_permissions.*",
    "$join",
    "staff_login.id = $staff_id"
);

$user = $obj->getResult();

if (!empty($user)) {
    $user = $user[0];
}


$can_show_actions =
    !empty($user['can_view']) ||
    !empty($user['can_update']) ||
    !empty($user['can_delete']);

$can_add = !empty($user['can_add']);

if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $base_url = "http://localhost/dig_portal/";
} else {
    $base_url = "https://dhotharinternational.com/dig_portal/";
}

$current_url = basename($_SERVER['REQUEST_URI']);

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

function currentDate(){
    return date('Y-m-d');
}
function currentTime() {
    date_default_timezone_set('Asia/Karachi'); // Set timezone to Pakistan
    return date('h:i A');
}

?>