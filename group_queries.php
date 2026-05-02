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
                <li> <a href="https://themes.laborator.co/neon/demo/layouts/layout-api/">Group Queries</a> </li>
                <li class="active"> <strong>Data</strong> </li>
            </ol>

            <h3>Exporting Group Queries Table Data</h3>
            <br />

            <!-- Add Task Button -->
            <a href="<?= $base_url ?>add_group_queries" class="btn btn-primary">
                + Add Group Queries
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
                        <th>Group</th>
                        <th>Customer</th>
                        <th>Query Type</th>
                        <th>Query Message</th>
                        <th>Contact</th>
                        <th>Follow-up</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sno = 1;

                    $group_queries = [
                        [
                            'id' => 1,
                            'group' => 'Al Noor Umrah Group',
                            'customer' => 'Muhammad Ali',
                            'query_type' => 'Visa',
                            'query_message' => 'Visa processing time kitna lagay ga aur documents kya required hain?',
                            'contact' => '03001234567',
                            'followup_date' => '2026-05-05',
                            'assigned_to' => 'Farhan',
                            'status' => 'open'
                        ],
                        [
                            'id' => 2,
                            'group' => 'ABC Corporate Trip',
                            'customer' => 'Sara Khan',
                            'query_type' => 'Hotel',
                            'query_message' => 'Hotel 4 star confirmed hai ya availability check karni hogi?',
                            'contact' => '03111222333',
                            'followup_date' => '2026-05-07',
                            'assigned_to' => 'Zeeshan',
                            'status' => 'in_progress'
                        ],
                        [
                            'id' => 3,
                            'group' => 'Family Tour Group',
                            'customer' => 'Usman Tariq',
                            'query_type' => 'Fare',
                            'query_message' => 'Group discount apply ho sakta hai 12 passengers par?',
                            'contact' => '03214567890',
                            'followup_date' => '2026-05-03',
                            'assigned_to' => 'Ch Zulfiqar',
                            'status' => 'resolved'
                        ],
                    ];

                    foreach ($group_queries as $gq) {
                        ?>
                        <tr>
                            <td><?= $sno++; ?></td>

                            <td><?= $gq['group']; ?></td>

                            <td><?= $gq['customer']; ?></td>

                            <td><?= $gq['query_type']; ?></td>

                            <td style="max-width:250px;">
                                <a href="javascript:void(0)" class="view-query-message"
                                    data-message="<?= htmlspecialchars($gq['query_message']); ?>">
                                    <?= substr($gq['query_message'], 0, 80); ?>...
                                </a>
                            </td>

                            <td><?= $gq['contact']; ?></td>

                            <td><?= date('d M Y', strtotime($gq['followup_date'])); ?></td>
                            <td><?= $gq['assigned_to']; ?></td>

                            <td>
                                <span class="label 
                    <?= $gq['status'] == 'open' ? 'label-primary' :
                        ($gq['status'] == 'in_progress' ? 'label-warning' : 'label-success') ?>">
                                    <?= $gq['status']; ?>
                                </span>
                            </td>

                            <td>
                                <div style="display:flex;gap:10px">
                                    <button class="btn btn-info btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                    <button class="btn btn-success btn-sm">Reply</button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div id="queryMessageModal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">Query Message</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <p id="fullQueryMessage" style="white-space: pre-wrap;"></p>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>

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
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            document.querySelectorAll('.view-query-message').forEach(function (el) {
                el.addEventListener('click', function () {

                    let message = this.getAttribute('data-message');

                    document.getElementById('fullQueryMessage').innerText = message;

                    $('#queryMessageModal').modal('show'); // Bootstrap modal
                });
            });

        });
    </script>
</body>

</html>