<?php

include('session.php');

$obj->select('fares', "*");
$fares = $obj->getResult();

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
                        <th>Validity From</th>
                        <th>Validity To</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sno = 1;

                    // Dummy data (replace with $fares from DB later)
                    // $fares = [
                    //     [
                    //         'id' => 1,
                    //         'airline_name' => 'PIA',
                    //         'route' => 'Karachi → Jeddah',
                    //         'fare_type' => 'Umrah',
                    //         'total_fare' => 85000,
                    //         'validity_to' => '2026-06-30',
                    //         'status' => 'active'
                    //     ],
                    //     [
                    //         'id' => 2,
                    //         'airline_name' => 'Saudia',
                    //         'route' => 'Lahore → Madinah',
                    //         'fare_type' => 'Group',
                    //         'total_fare' => 92000,
                    //         'validity_to' => '2026-05-20',
                    //         'status' => 'inactive'
                    //     ],
                    //     [
                    //         'id' => 3,
                    //         'airline_name' => 'Emirates',
                    //         'route' => 'Islamabad → Dubai',
                    //         'fare_type' => 'Promotion',
                    //         'total_fare' => 78000,
                    //         'validity_to' => '2026-07-10',
                    //         'status' => 'active'
                    //     ]
                    // ];
                    
                    foreach ($fares as $fare) {
                        ?>
                        <tr class="<?php echo ($fare['status'] == 'inactive') ? 'completed' : ''; ?>">
                            <td><?php echo $sno++; ?></td>

                            <td><?php echo $fare['airline_name']; ?></td>

                            <td><?php echo $fare['route']; ?></td>

                            <td>
                                <span class="badge badge-info">
                                    <?php echo $fare['fare_type']; ?>
                                </span>
                            </td>

                            <td><?php echo number_format($fare['total_fare']); ?></td>

                            <td><?php echo date('d M Y', strtotime($fare['validity_from'])); ?></td>
                            <td><?php echo date('d M Y', strtotime($fare['validity_to'])); ?></td>

                            <td>
                                <?php if ($fare['status'] == 'active'): ?>
                                    <span class="label label-success fare-status">Active</span>
                                <?php elseif ($fare['status'] == 'inactive'): ?>
                                    <span class="label label-default fare-status">Inactive</span>
                                <?php else: ?>
                                    <span class="label label-warning fare-status">Expired</span>
                                <?php endif; ?>
                            </td>

                            <?php
                            $buttonText = ($fare['status'] == 'active') ? 'Deactivate' : 'Activate';

                            $buttonClass = ($fare['status'] == 'active')
                                ? 'btn btn-warning btn-sm toggle-fare-status'
                                : 'btn btn-success btn-sm toggle-fare-status';
                            ?>

                            <td>
                                <div style="display:flex;gap:10px">

                                    <button class="btn btn-warning btn-sm view-fare" data-id="<?= $fare['id']; ?>"
                                        data-airline_name="<?= htmlspecialchars($fare['airline_name']); ?>"
                                        data-route="<?= htmlspecialchars($fare['route']); ?>"
                                        data-fare_type="<?= $fare['fare_type']; ?>"
                                        data-booking_class="<?= htmlspecialchars($fare['booking_class'] ?? ''); ?>"
                                        data-base_fare="<?= $fare['base_fare'] ?? 0; ?>"
                                        data-taxes="<?= $fare['taxes'] ?? 0; ?>"
                                        data-total_fare="<?= $fare['total_fare']; ?>"
                                        data-validity_from="<?= date('d M Y', strtotime($fare['validity_from'])); ?>"
                                        data-validity_to="<?= date('d M Y', strtotime($fare['validity_to'])); ?>"
                                        data-status="<?= $fare['status']; ?>"
                                        data-refund_policy="<?= $fare['refund_policy']; ?>" data-toggle="modal"
                                        data-target="#viewFareModal">

                                        View
                                    </button>


                                    <a href="<?= $base_url ?>add_fare?id=<?= $fare['id']; ?>"
                                        class="btn btn-info btn-sm edit-fare">
                                        Edit
                                    </a>

                                    <button class="btn btn-danger btn-sm delete-fare" data-id="<?= $fare['id']; ?>">
                                        Delete
                                    </button>

                                    <a href="#" class="<?= $buttonClass; ?>" data-id="<?= $fare['id']; ?>">
                                        <?= $buttonText; ?>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="modal fade" id="viewFareModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">Fare Details</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">

                            <div class="row">

                                <div class="col-md-6">
                                    <label>Airline Name</label>
                                    <input type="text" class="form-control" id="v_airline_name" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label>Route</label>
                                    <input type="text" class="form-control" id="v_route" readonly>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-6">
                                    <label>Fare Type</label>
                                    <input type="text" class="form-control" id="v_fare_type" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label>Booking Class</label>
                                    <input type="text" class="form-control" id="v_booking_class" readonly>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-6">
                                    <label>Base Fare</label>
                                    <input type="text" class="form-control" id="v_base_fare" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label>Taxes</label>
                                    <input type="text" class="form-control" id="v_taxes" readonly>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-12">
                                    <label>Total Fare</label>
                                    <input type="text" class="form-control" id="v_total_fare" readonly>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-6">
                                    <label>Validity From</label>
                                    <input type="text" class="form-control" id="v_validity_from" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label>Validity To</label>
                                    <input type="text" class="form-control" id="v_validity_to" readonly>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-12">
                                    <label>Status</label>
                                    <input type="text" class="form-control" id="v_status" readonly>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-12">
                                    <label>Refund Policy</label>
                                    <div id="v_refund_policy"></div>
                                </div>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
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
        $(document).ready(function () {

            $(document).on('click', '.delete-fare', function () {

                let id = $(this).data('id');
                let row = $(this).closest('tr');

                if (confirm("Are you sure you want to delete this fare?")) {

                    $.ajax({
                        url: 'ajax/delete',
                        type: 'POST',
                        data: {
                            id: id,
                            table: 'fares'
                        },
                        success: function (response) {

                            if (response.trim() == 'success') {

                                row.fadeOut(400, function () {
                                    $(this).remove();
                                });

                                toastr.success("Fare deleted successfully!");

                            } else {
                                toastr.error("Delete failed!");
                            }
                        }
                    });

                }

            });

        });

        $(document).on('click', '.toggle-fare-status', function (e) {

            e.preventDefault();

            let id = $(this).data('id');
            let button = $(this);
            let row = button.closest('tr');

            $.ajax({
                url: 'ajax/toggle_fare_status',
                type: 'POST',
                data: { id: id },

                success: function (response) {

                    response = response.trim();

                    if (response == 'active') {

                        button
                            .removeClass('btn-success')
                            .addClass('btn-warning')
                            .text('Deactivate');

                        row.removeClass('completed');

                        row.find('.fare-status')
                            .removeClass('label-default label-warning')
                            .addClass('label-success')
                            .text('Active');

                        toastr.success("Fare activated successfully!");

                    } else if (response == 'inactive') {

                        button
                            .removeClass('btn-warning')
                            .addClass('btn-success')
                            .text('Activate');

                        row.addClass('completed');

                        row.find('.fare-status')
                            .removeClass('label-success label-warning')
                            .addClass('label-default')
                            .text('Inactive');

                        toastr.success("Fare deactivated successfully!");

                    } else {

                        toastr.error("Update failed!");

                    }
                }
            });

        });
    </script>
    <script>
        $(document).on('click', '.view-fare', function () {

            $('#v_airline_name').val($(this).data('airline_name'));
            $('#v_route').val($(this).data('route'));
            $('#v_fare_type').val($(this).data('fare_type'));
            $('#v_booking_class').val($(this).data('booking_class'));

            $('#v_base_fare').val($(this).data('base_fare'));
            $('#v_taxes').val($(this).data('taxes'));
            $('#v_total_fare').val($(this).data('total_fare'));

            $('#v_validity_from').val($(this).data('validity_from'));
            $('#v_validity_to').val($(this).data('validity_to'));

            let status = $(this).data('status');
            $('#v_status').val(
                status == 'active' ? 'Active' :
                    status == 'inactive' ? 'Inactive' :
                        'Expired'
            );

            $('#v_refund_policy').html($(this).data('refund_policy'));
        });
    </script>
</body>

</html>