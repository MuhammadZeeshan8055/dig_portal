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
                <li> <a href="https://themes.laborator.co/neon/demo/layouts/layout-api/">Fares</a> </li>
                <li class="active"> <strong>Data</strong> </li>
            </ol>

            <h3>Exporting Fare Table Data</h3>
            <br />

            <!-- Add Task Button -->
            <a href="<?= $base_url ?>add_fare" class="btn btn-primary">
                + Add Fare
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
                        <th>Airline</th>
                        <th>Route</th>
                        <th>Fare Type</th>
                        <th>Total Fare</th>
                        <th>Validity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sno = 1;

                    // Dummy data (replace with $fares from DB later)
                    $fares = [
                        [
                            'id' => 1,
                            'airline_name' => 'PIA',
                            'route' => 'Karachi → Jeddah',
                            'fare_type' => 'Umrah',
                            'total_fare' => 85000,
                            'validity_to' => '2026-06-30',
                            'status' => 'active'
                        ],
                        [
                            'id' => 2,
                            'airline_name' => 'Saudia',
                            'route' => 'Lahore → Madinah',
                            'fare_type' => 'Group',
                            'total_fare' => 92000,
                            'validity_to' => '2026-05-20',
                            'status' => 'inactive'
                        ],
                        [
                            'id' => 3,
                            'airline_name' => 'Emirates',
                            'route' => 'Islamabad → Dubai',
                            'fare_type' => 'Promotion',
                            'total_fare' => 78000,
                            'validity_to' => '2026-07-10',
                            'status' => 'active'
                        ]
                    ];

                    foreach ($fares as $fare) {
                        ?>
                        <tr>
                            <td><?php echo $sno++; ?></td>

                            <td><?php echo $fare['airline_name']; ?></td>

                            <td><?php echo $fare['route']; ?></td>

                            <td>
                                <span class="badge badge-info">
                                    <?php echo $fare['fare_type']; ?>
                                </span>
                            </td>

                            <td><?php echo number_format($fare['total_fare']); ?></td>

                            <td><?php echo date('d M Y', strtotime($fare['validity_to'])); ?></td>

                            <td>
                                <?php if ($fare['status'] == 'active'): ?>
                                    <span class="label label-success">Active</span>
                                <?php elseif ($fare['status'] == 'inactive'): ?>
                                    <span class="label label-default">Inactive</span>
                                <?php else: ?>
                                    <span class="label label-warning">Expired</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <div style="display:flex;gap:10px">

                                    <a href="javascript:void(0)" class="btn btn-info btn-sm edit-fare"
                                        data-id="<?= $fare['id']; ?>"
                                        data-airline="<?= htmlspecialchars($fare['airline_name']); ?>"
                                        data-route="<?= htmlspecialchars($fare['route']); ?>"
                                        data-fare_type="<?= $fare['fare_type']; ?>"
                                        data-total_fare="<?= $fare['total_fare']; ?>" data-toggle="modal"
                                        data-target="#addFareModal">
                                        Edit
                                    </a>

                                    <button class="btn btn-danger btn-sm delete-fare" data-id="<?= $fare['id']; ?>">
                                        Delete
                                    </button>

                                    <?php
                                    echo ($fare['status'] == 'active')
                                        ? '<a href="#" class="btn btn-warning btn-sm deactivate-fare" data-id="' . $fare['id'] . '">Deactivate</a>'
                                        : '<a href="#" class="btn btn-success btn-sm activate-fare" data-id="' . $fare['id'] . '">Activate</a>';
                                    ?>

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