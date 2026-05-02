<?php

include('session.php');
include('database.php');



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
    <title>Dhothar International Employee DB | Dashboard</title>

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
                <li> <a href="https://themes.laborator.co/neon/demo/layouts/layout-api/">Group Bookings</a> </li>
                <li class="active"> <strong>Data</strong> </li>
            </ol>

            <h3>Exporting Group Bookings Table Data</h3>
            <br />

            <!-- Add Task Button -->
            <a href="<?= $base_url ?>add_group_bookings" class="btn btn-primary">
                + Add Group Bookings
            </a>

            <br /><br />

            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    var $table4 = jQuery("#table-4");
                    $table4.DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5'
                        ]
                    });
                });
            </script>

            <table class="table table-bordered datatable table-3" id="table-4">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Group Name</th>
                        <th>Type</th>
                        <th>Pax</th>
                        <th>Departure</th>
                        <th>Travel Date</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sno = 1;

                    $group_bookings = [
                        [
                            'id' => 1,
                            'group_name' => 'Al Noor Umrah Group',
                            'group_type' => 'Umrah',
                            'pax' => 45,
                            'departure_city' => 'Karachi',
                            'travel_date' => '2026-05-25',
                            'total_amount' => 3800000,
                            'status' => 'confirmed'
                        ],
                        [
                            'id' => 2,
                            'group_name' => 'ABC Corporate Trip',
                            'group_type' => 'Corporate',
                            'pax' => 20,
                            'departure_city' => 'Islamabad',
                            'travel_date' => '2026-06-10',
                            'total_amount' => 1450000,
                            'status' => 'pending'
                        ],
                    ];

                    foreach ($group_bookings as $gb) {
                        ?>
                        <tr>
                            <td><?= $sno++; ?></td>
                            <td><?= $gb['group_name']; ?></td>
                            <td><?= $gb['group_type']; ?></td>
                            <td><?= $gb['pax']; ?></td>
                            <td><?= $gb['departure_city']; ?></td>
                            <td><?= date('d M Y', strtotime($gb['travel_date'])); ?></td>
                            <td><?= number_format($gb['total_amount']); ?></td>
                            <td>
                                <span class="label <?=
                                    $gb['status'] == 'confirmed' ? 'label-success' :
                                    ($gb['status'] == 'pending' ? 'label-primary' : 'label-default')
                                    ?>">
                                    <?= $gb['status']; ?>
                                </span>
                            </td>
                            <td>
                                <div style="display:flex;gap:10px">
                                    <button class="btn btn-info btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                    <button class="btn btn-warning btn-sm">View</button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <br />



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

    <script src="<?= $base_url ?>assets/js/neon-chat.js" id="script-resource-16"></script>
    <script src="<?= $base_url ?>assets/js/neon-custom.js" id="script-resource-17"></script>

</body>

</html>