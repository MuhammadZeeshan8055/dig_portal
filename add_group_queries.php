<?php
include('session.php');

$isEdit = false;
$groupData = [];

// =========================
// EDIT FETCH
// =========================
if (!empty($_GET['id'])) {

    $id = (int) $_GET['id'];

    $obj->select("group_queries", "*", null, "id = '$id'");
    $result = $obj->getResult();

    if (!empty($result)) {
        $groupData = $result[0];
        $isEdit = true;
    }
}

// =========================
// INSERT / UPDATE
// =========================
if (isset($_POST['save_group_query'])) {

    $data = [
        'group_booking_id' => $_POST['group_booking_id'],
        'query_type' => $_POST['query_type'],
        'customer_name' => $_POST['customer_name'],
        'contact_number' => $_POST['contact_number'],
        'query_details' => $_POST['query_details'],
        'assigned_to' => $_POST['assigned_to'],
        'followup_date' => $_POST['followup_date'],
        'notes' => $_POST['notes'],
        'query_status' => $_POST['query_status'],
    ];

    // UPDATE
    if (!empty($_POST['group_query_id'])) {

        $id = (int) $_POST['group_query_id'];

        $obj->update("group_queries", $data, "id = $id");

        $_SESSION['toast'] = ['type' => 'success', 'message' => 'Updated successfully'];
    }
    // INSERT
    else {

        $obj->insert("group_queries", $data);

        $_SESSION['toast'] = ['type' => 'success', 'message' => 'Added successfully'];
    }

    header("Location: group_queries.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Dhothar International" />
    <meta name="author" content="Laborator.co" />
    <link rel="icon" href="<?= $base_url ?>assets/images/favicon.ico">
    <title>Dhothar International DIG | Dashboard</title>

    <link rel="stylesheet" href="<?= $base_url ?>assets/css/font-icons/entypo/css/entypo.css" id="style-resource-2">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic"
        id="style-resource-3">
    <link rel="stylesheet" href="<?= $base_url ?>assets/css/bootstrap.css" id="style-resource-4">
    <link rel="stylesheet" href="<?= $base_url ?>assets/css/neon-core.css" id="style-resource-5">

    <script src="<?= $base_url ?>assets/js/jquery-1.11.3.min.js"></script>
</head>

<body class="">
    <div class="page-container">
        <div class="sidebar-menu">

            <?php include('components/sidebar.php'); ?>


        </div>
        <div class="main-content">


            <?php include('components/header.php'); ?>


            <hr />

            <ol class="breadcrumb bc-3">
                <li> <a href="https://themes.laborator.co/neon/demo/dashboard/main/"><i
                            class="fa-home"></i>Dashboard</a>
                </li>
                <li> <a href="https://themes.laborator.co/neon/demo/layouts/layout-api/">Fares</a> </li>
                <li class="active"> <strong>Add Fare</strong> </li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary" data-collapsed="0">
                        <div class="panel-heading">
                            <div class="panel-title">
                                Entry Form
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form action="" method="post">
                                    <input type="hidden" name="group_query_id" value="<?= $groupData['id'] ?? ''; ?>">
                                    <div class="row">

                                        <div class="col-md-1"></div>

                                        <div class="col-md-10">

                                            <!-- GROUP BOOKING -->
                                            <div class="col-md-6">
                                                <label>Select Group Booking</label>
                                                <select name="group_booking_id" class="form-control">

                                                    <option value="">-- Select --</option>

                                                    <?php
                                                    $obj->select('group_bookings', 'id, group_name, departure_city');
                                                    $groups = $obj->getResult();

                                                    $selected_group = $groupData['group_booking_id'] ?? '';
                                                    ?>

                                                    <?php foreach ($groups as $g): ?>
                                                        <option value="<?= $g['id']; ?>" <?= ($selected_group == $g['id']) ? 'selected' : '' ?>>
                                                            <?= $g['group_name']; ?> - <?= $g['departure_city']; ?>
                                                        </option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>

                                            <!-- QUERY TYPE -->
                                            <div class="col-md-6">
                                                <label>Query Type</label>
                                                <?php $qt = $groupData['query_type'] ?? ''; ?>
                                                <select name="query_type" class="form-control">
                                                    <option value="">-- Select --</option>

                                                    <?php foreach (['visa', 'hotel', 'fare', 'transport', 'ticketing', 'other'] as $t): ?>
                                                        <option value="<?= $t ?>" <?= ($qt == $t) ? 'selected' : '' ?>>
                                                            <?= ucfirst($t) ?>
                                                        </option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>

                                            <div class="clear"></div><br>

                                            <!-- CUSTOMER -->
                                            <div class="col-md-6">
                                                <label>Customer Name</label>
                                                <input type="text" name="customer_name" class="form-control"
                                                    value="<?= $groupData['customer_name'] ?? '' ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Contact Number</label>
                                                <input type="text" name="contact_number" class="form-control"
                                                    value="<?= $groupData['contact_number'] ?? '' ?>">
                                            </div>

                                            <div class="clear"></div><br>

                                            <!-- DETAILS -->
                                            <div class="col-md-12">
                                                <label>Query Details</label>
                                                <textarea name="query_details"
                                                    class="form-control"><?= $groupData['query_details'] ?? '' ?></textarea>
                                            </div>

                                            <div class="clear"></div><br>

                                            <!-- ASSIGN -->
                                            <div class="col-md-6">
                                                <label>Assign To</label>
                                                <input type="text" name="assigned_to" class="form-control"
                                                    value="<?= $groupData['assigned_to'] ?? '' ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Follow-up Date</label>
                                                <input type="date" name="followup_date" class="form-control"
                                                    value="<?= $groupData['followup_date'] ?? '' ?>">
                                            </div>

                                            <div class="clear"></div><br>

                                            <!-- NOTES -->
                                            <div class="col-md-12">
                                                <label>Notes</label>
                                                <textarea name="notes"
                                                    class="form-control"><?= $groupData['notes'] ?? '' ?></textarea>
                                            </div>

                                            <div class="clear"></div><br>

                                            <!-- STATUS -->
                                            <div class="col-md-6">
                                                <label>Status</label>

                                                <?php $st = $groupData['query_status'] ?? ''; ?>

                                                <select name="query_status" class="form-control">
                                                    <option value="">-- Select --</option>

                                                    <?php foreach (['open', 'in_progress', 'resolved', 'closed'] as $s): ?>
                                                        <option value="<?= $s ?>" <?= ($st == $s) ? 'selected' : '' ?>>
                                                            <?= ucfirst(str_replace('_', ' ', $s)) ?>
                                                        </option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>

                                        </div>

                                        <div class="clear"></div><br>


                                        <!-- BUTTON -->
                                        <div class="col-md-12 text-center" style="margin-top:20px;">
                                            <button type="submit" name="save_group_query" class="btn btn-success">
                                                <?= $isEdit ? 'Update Query' : 'Add Query' ?>
                                            </button>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>



    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="<?= $base_url ?>assets/js/datatables/datatables.js" id="script-resource-8"></script>
    <link rel="stylesheet" href="<?= $base_url ?>assets/js/datatables/datatables.css" id="style-resource-1">
    <link rel="stylesheet" href="<?= $base_url ?>assets/js/jvectormap/jquery-jvectormap-1.2.2.css"
        id="style-resource-1">
    <link rel="stylesheet" href="<?= $base_url ?>assets/js/rickshaw/rickshaw.min.css" id="style-resource-2">
    <script src="<?= $base_url ?>assets/js/gsap/TweenMax.min.js" id="script-resource-1"></script>
    <script src="<?= $base_url ?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"
        id="script-resource-2"></script>
    <script src="<?= $base_url ?>assets/js/bootstrap.js" id="script-resource-3"></script>
    <script src="<?= $base_url ?>assets/js/joinable.js" id="script-resource-4"></script>
    <script src="<?= $base_url ?>assets/js/resizeable.js" id="script-resource-5"></script>
    <script src="<?= $base_url ?>assets/js/neon-api.js" id="script-resource-6"></script>
    <script src="<?= $base_url ?>assets/js/cookies.min.js" id="script-resource-7"></script>
    <script src="<?= $base_url ?>assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js" id="script-resource-8"></script>
    <script src="<?= $base_url ?>assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"
        id="script-resource-9"></script>


</body>

</html>