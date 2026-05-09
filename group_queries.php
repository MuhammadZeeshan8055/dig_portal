<?php

include('session.php');

$join = "INNER JOIN group_bookings on group_bookings.id = group_queries.group_booking_id";
$obj->select('group_queries', "group_queries.*,group_bookings.group_name", $join);
$group_queries = $obj->getResult();

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
    <link rel="stylesheet" href="<?= $base_url ?>assets/css/custom.css">
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

                    // $group_queries = [
                    //     [
                    //         'id' => 1,
                    //         'group_booking_id' => 'Al Noor Umrah Group',
                    //         'customer_name' => 'Muhammad Ali',
                    //         'query_type' => 'Visa',
                    //         'query_details' => 'Visa processing time kitna lagay ga aur documents kya required hain?',
                    //         'contact_number' => '03001234567',
                    //         'followup_date' => '2026-05-05',
                    //         'assigned_to' => 'Farhan',
                    //         'query_status' => 'open'
                    //     ],
                    //     [
                    //         'id' => 2,
                    //         'group_booking_id' => 'ABC Corporate Trip',
                    //         'customer_name' => 'Sara Khan',
                    //         'query_type' => 'Hotel',
                    //         'query_details' => 'Hotel 4 star confirmed hai ya availability check karni hogi?',
                    //         'contact_number' => '03111222333',
                    //         'followup_date' => '2026-05-07',
                    //         'assigned_to' => 'Zeeshan',
                    //         'query_status' => 'in_progress'
                    //     ],
                    //     [
                    //         'id' => 3,
                    //         'group_booking_id' => 'Family Tour Group',
                    //         'customer_name' => 'Usman Tariq',
                    //         'query_type' => 'Fare',
                    //         'query_details' => 'Group discount apply ho sakta hai 12 passengers par?',
                    //         'contact_number' => '03214567890',
                    //         'followup_date' => '2026-05-03',
                    //         'assigned_to' => 'Ch Zulfiqar',
                    //         'query_status' => 'resolved'
                    //     ],
                    // ];
                    
                    foreach ($group_queries as $gq) {
                        ?>
                        <tr>
                            <td><?= $sno++; ?></td>

                            <td><?= htmlspecialchars($gq['group_name']); ?></td>

                            <td><?= htmlspecialchars($gq['customer_name']); ?></td>

                            <td><?= ucfirst($gq['query_type']); ?></td>

                            <!-- QUERY DETAILS (VIEW MODAL SUPPORT) -->
                            <td>
                                <button class="btn btn-link view-group-query"
                                    data-group_name="<?= htmlspecialchars($gq['group_name']); ?>"
                                    data-customer_name="<?= htmlspecialchars($gq['customer_name']); ?>"
                                    data-query_type="<?= $gq['query_type']; ?>"
                                    data-query_details="<?= htmlspecialchars($gq['query_details']); ?>"
                                    data-contact_number="<?= $gq['contact_number']; ?>"
                                    data-followup_date="<?= date('d M Y', strtotime($gq['followup_date'])); ?>"
                                    data-assigned_to="<?= htmlspecialchars($gq['assigned_to']); ?>"
                                    data-notes="<?= htmlspecialchars($gq['notes']); ?>"
                                    data-query_status="<?= $gq['query_status']; ?>" data-toggle="modal"
                                    data-target="#viewGroupQueryModal">

                                    <?= substr(strip_tags($gq['query_details']), 0, 80); ?>...
                                </button>
                            </td>

                            <td><?= $gq['contact_number']; ?></td>

                            <td><?= date('d M Y', strtotime($gq['followup_date'])); ?></td>

                            <td><?= htmlspecialchars($gq['assigned_to']); ?></td>

                            <td>
                                <span class="label 
                                    <?= $gq['query_status'] == 'open' ? 'label-primary' :
                                        ($gq['query_status'] == 'in_progress' ? 'label-warning' : 'label-success') ?>">
                                    <?= ucfirst($gq['query_status']); ?>
                                </span>
                            </td>

                            <td>
                                <div style="display:flex;gap:10px">

                                    <a href="add_group_queries.php?id=<?= $gq['id'] ?>" class="btn btn-info btn-sm">
                                        Edit
                                    </a>

                                    <button data-id="<?= $gq['id'] ?>" class="btn btn-danger btn-sm delete-group-query">
                                        Delete
                                    </button>

                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="modal fade" id="viewGroupQueryModal" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">Group Query Details</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">

                            <div class="row">

                                <div class="col-md-6">
                                    <label>Group Name</label>
                                    <input type="text" class="form-control" id="v_group_name" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label>Customer Name</label>
                                    <input type="text" class="form-control" id="v_customer_name" readonly>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-6">
                                    <label>Query Type</label>
                                    <input type="text" class="form-control" id="v_query_type" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label>Contact Number</label>
                                    <input type="text" class="form-control" id="v_contact_number" readonly>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-12">
                                    <label>Query Details</label>
                                    <textarea class="form-control" id="v_query_details" rows="4" readonly></textarea>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-6">
                                    <label>Assigned To</label>
                                    <input type="text" class="form-control" id="v_assigned_to" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label>Follow-up Date</label>
                                    <input type="text" class="form-control" id="v_followup_date" readonly>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-12">
                                    <label>Notes</label>
                                    <textarea class="form-control" id="v_notes" rows="3" readonly></textarea>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-12">
                                    <label>Status</label>
                                    <input type="text" class="form-control" id="v_query_status" readonly>
                                </div>

                            </div>

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
    <?php if (isset($_SESSION['toast'])) { ?>
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "3000"
            };

            toastr["<?= $_SESSION['toast']['type'] ?>"]("<?= $_SESSION['toast']['message'] ?>");
        </script>
        <?php unset($_SESSION['toast']);
    } ?>
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
    <script>
        $(document).on('click', '.delete-group-query', function () {

            let id = $(this).data('id');
            let row = $(this).closest('tr');

            if (confirm("Are you sure you want to delete this fare?")) {

                $.ajax({
                    url: 'ajax/delete',
                    type: 'POST',
                    data: {
                        id: id,
                        table: 'group_queries'
                    },
                    success: function (response) {

                        if (response.trim() == 'success') {

                            row.fadeOut(400, function () {
                                $(this).remove();
                            });

                            toastr.success("Group Query deleted successfully!");

                        } else {
                            toastr.error("Delete failed!");
                        }
                    }
                });

            }

        });
    </script>


    <script>
        $(document).on('click', '.view-group-query', function () {

            $('#v_group_name').val($(this).data('group_name'));
            $('#v_customer_name').val($(this).data('customer_name'));
            $('#v_query_type').val($(this).data('query_type'));

            $('#v_query_details').val($(this).data('query_details'));
            $('#v_contact_number').val($(this).data('contact_number'));

            $('#v_assigned_to').val($(this).data('assigned_to'));
            $('#v_followup_date').val($(this).data('followup_date'));

            $('#v_notes').val($(this).data('notes'));
            $('#v_query_status').val($(this).data('query_status'));

        });
    </script>
</body>

</html>