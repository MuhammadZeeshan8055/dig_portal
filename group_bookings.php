<?php

include('session.php');

$obj->select('group_bookings', "*");
$group_bookings = $obj->getResult();

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
                <li> <a href="https://themes.laborator.co/neon/demo/layouts/layout-api/">Discounted Fares</a> </li>
                <li class="active"> <strong>Data</strong> </li>
            </ol>

            <h3>Exporting Group Bookings Table Data</h3>
            <br />

            <!-- Add Task Button -->
            <a href="<?= $base_url ?>add_discounted_fares" class="btn btn-primary">
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

                    // $group_bookings = [
                    //     [
                    //         'id' => 1,
                    //         'group_name' => 'Al Noor Umrah Group',
                    //         'group_type' => 'Umrah',
                    //         'total_passengers' => 45,
                    //         'departure_city' => 'Karachi',
                    //         'travel_date' => '2026-05-25',
                    //         'total_amount' => 3800000,
                    //         'status' => 'confirmed'
                    //     ],
                    //     [
                    //         'id' => 2,
                    //         'group_name' => 'ABC Corporate Trip',
                    //         'group_type' => 'Corporate',
                    //         'total_passengers' => 20,
                    //         'departure_city' => 'Islamabad',
                    //         'travel_date' => '2026-06-10',
                    //         'total_amount' => 1450000,
                    //         'booking_status' => 'pending'
                    //     ],
                    // ];
                    
                    foreach ($group_bookings as $gb) {
                        ?>
                        <tr>
                            <td><?= $sno++; ?></td>
                            <td><?= $gb['group_name']; ?></td>
                            <td><?= $gb['group_type']; ?></td>
                            <td><?= $gb['total_passengers']; ?></td>
                            <td><?= $gb['departure_city']; ?></td>
                            <td><?= date('d M Y', strtotime($gb['travel_date'])); ?></td>
                            <td><?= number_format($gb['total_amount']); ?></td>
                            <td>
                                <span class="label <?=
                                    $gb['booking_status'] == 'confirmed' ? 'label-success' :
                                    ($gb['booking_status'] == 'pending' ? 'label-primary' : 'label-default')
                                    ?>">
                                    <?= $gb['booking_status']; ?>
                                </span>
                            </td>
                            <td>
                                <div style="display:flex;gap:10px">
                                    <button class="btn btn-warning btn-sm view-group" data-id="<?= $gb['id']; ?>"
                                        data-group_name="<?= htmlspecialchars($gb['group_name']); ?>"
                                        data-group_type="<?= $gb['group_type']; ?>"
                                        data-total_passengers="<?= $gb['total_passengers']; ?>"
                                        data-departure_city="<?= htmlspecialchars($gb['departure_city']); ?>"
                                        data-travel_date="<?= date('d M Y', strtotime($gb['travel_date'])); ?>"
                                        data-package_type="<?= htmlspecialchars($gb['package_type']); ?>"
                                        data-total_amount="<?= $gb['total_amount']; ?>"
                                        data-deposit_amount="<?= $gb['deposit_amount']; ?>"
                                        data-payment_deadline="<?= $gb['payment_deadline']; ?>"
                                        data-assigned_agent="<?= htmlspecialchars($gb['assigned_agent']); ?>"
                                        data-booking_status="<?= $gb['booking_status']; ?>" data-toggle="modal"
                                        data-target="#viewGroupModal">

                                        View
                                    </button>
                                    <a href="add_group_bookings?id=<?= $gb['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                    <button data-id="<?= $gb['id']; ?>"
                                        class="btn btn-danger btn-sm delete-group-bookings">Delete</button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="modal fade" id="viewGroupModal" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">Group Booking Details</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">

                            <div class="row">

                                <div class="col-md-6">
                                    <label>Group Name</label>
                                    <input type="text" class="form-control" id="v_group_name" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label>Group Type</label>
                                    <input type="text" class="form-control" id="v_group_type" readonly>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-6">
                                    <label>Total Passengers</label>
                                    <input type="text" class="form-control" id="v_total_passengers" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label>Departure City</label>
                                    <input type="text" class="form-control" id="v_departure_city" readonly>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-6">
                                    <label>Travel Date</label>
                                    <input type="text" class="form-control" id="v_travel_date" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label>Package Type</label>
                                    <input type="text" class="form-control" id="v_package_type" readonly>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-6">
                                    <label>Total Amount</label>
                                    <input type="text" class="form-control" id="v_total_amount" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label>Deposit Amount</label>
                                    <input type="text" class="form-control" id="v_deposit_amount" readonly>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-6">
                                    <label>Payment Deadline</label>
                                    <input type="text" class="form-control" id="v_payment_deadline" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label>Assigned Agent</label>
                                    <input type="text" class="form-control" id="v_assigned_agent" readonly>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-12">
                                    <label>Status</label>
                                    <input type="text" class="form-control" id="v_booking_status" readonly>
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
        $(document).on('click', '.view-group', function () {

            $('#v_group_name').val($(this).data('group_name'));
            $('#v_group_type').val($(this).data('group_type'));
            $('#v_total_passengers').val($(this).data('total_passengers'));
            $('#v_departure_city').val($(this).data('departure_city'));
            $('#v_travel_date').val($(this).data('travel_date'));
            $('#v_package_type').val($(this).data('package_type'));
            $('#v_total_amount').val($(this).data('total_amount'));
            $('#v_deposit_amount').val($(this).data('deposit_amount'));
            $('#v_payment_deadline').val($(this).data('payment_deadline'));
            $('#v_assigned_agent').val($(this).data('assigned_agent'));
            $('#v_booking_status').val($(this).data('booking_status'));

        });
    </script>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.delete-group-bookings', function () {

                let id = $(this).data('id');
                let row = $(this).closest('tr');

                if (confirm("Are you sure you want to delete this group booking?")) {

                    $.ajax({
                        url: 'ajax/delete',
                        type: 'POST',
                        data: {
                            id: id,
                            table: 'group_bookings'
                        },
                        success: function (response) {

                            if (response.trim() == 'success') {

                                row.fadeOut(400, function () {
                                    $(this).remove();
                                });

                                toastr.success("Group Bookings deleted successfully!");

                            } else {
                                toastr.error("Delete failed!");
                            }
                        }
                    });

                }

            });
        });
    </script>
</body>

</html>