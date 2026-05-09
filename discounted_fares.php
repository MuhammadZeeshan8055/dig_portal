<?php

include('session.php');

$join = "INNER JOIN fares ON fares.id = discounted_fares.fare_id";

$obj->select(
    'discounted_fares',
    'discounted_fares.*, fares.route',
    $join
);

$discounted_fares = $obj->getResult();

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

            <h3>Exporting Discounted Fare Table Data</h3>
            <br />

            <!-- Add Task Button -->
            <a href="<?= $base_url ?>add_discounted_fares" class="btn btn-primary">
                + Add Discounted Fare
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
                        <th>Fare</th>
                        <th>Discount Name</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Discounted Fare</th>
                        <th>Valid From</th>
                        <th>Valid To</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sno = 1;

                    // $discounted_fares = [
                    //     [
                    //         'id' => 1,
                    //         'fare_id' => 'PIA - KHI → JED',
                    //         'discount_name' => 'Ramadan Offer',
                    //         'discount_type' => 'percentage',
                    //         'discount_value' => 10,
                    //         'discounted_total' => 76500,
                    //         'valid_from' => '2026-05-30',
                    //         'valid_to' => '2026-05-30',
                    //         'status' => 'active'
                    //     ],
                    //     [
                    //         'id' => 2,
                    //         'fare_id' => 'Saudia - LHE → MED',
                    //         'discount_name' => 'Umrah Special',
                    //         'discount_type' => 'fixed',
                    //         'discount_value' => 5000,
                    //         'discounted_total' => 87000,
                    //         'valid_from' => '2026-05-30',
                    //         'valid_to' => '2026-06-15',
                    //         'status' => 'inactive'
                    //     ],
                    // ];
                    
                    foreach ($discounted_fares as $df) {
                        ?>
                        <tr>
                            <td><?= $sno++; ?></td>

                            <!-- Display route properly -->
                            <td><?= htmlspecialchars($df['route']); ?></td>

                            <td><?= htmlspecialchars($df['discount_name']); ?></td>

                            <td><?= ucfirst($df['discount_type']); ?></td>

                            <td><?= $df['discount_value']; ?></td>

                            <td><?= number_format($df['discounted_total']); ?></td>

                            <td><?= date('d M Y', strtotime($df['valid_from'])); ?></td>

                            <td><?= date('d M Y', strtotime($df['valid_to'])); ?></td>

                            <td>
                                <span class="label <?= $df['status'] == 'active' ? 'label-success' : 'label-default' ?>">
                                    <?= ucfirst($df['status']); ?>
                                </span>
                            </td>

                            <td>
                                <div style="display:flex;gap:10px">

                                    <!-- VIEW BUTTON -->
                                    <button class="btn btn-warning btn-sm view-discounted-fare" data-id="<?= $df['id']; ?>"
                                        data-fare_id="<?= $df['fare_id']; ?>"
                                        data-route="<?= htmlspecialchars($df['route']); ?>"
                                        data-discount_name="<?= htmlspecialchars($df['discount_name']); ?>"
                                        data-discount_type="<?= $df['discount_type']; ?>"
                                        data-discount_value="<?= $df['discount_value']; ?>"
                                        data-discounted_total="<?= $df['discounted_total']; ?>"
                                        data-promo_code="<?= htmlspecialchars($df['promo_code']); ?>"
                                        data-valid_from="<?= date('d M Y', strtotime($df['valid_from'])); ?>"
                                        data-valid_to="<?= date('d M Y', strtotime($df['valid_to'])); ?>"
                                        data-status="<?= $df['status']; ?>" data-toggle="modal"
                                        data-target="#viewDiscountedFareModal">

                                        View
                                    </button>

                                    <!-- EDIT -->
                                    <a href="add_discounted_fares?id=<?= $df['id']; ?>" class="btn btn-info btn-sm">
                                        Edit
                                    </a>

                                    <!-- DELETE -->
                                    <button data-id="<?= $df['id']; ?>"
                                        class="btn btn-danger btn-sm delete-discounted-fare">
                                        Delete
                                    </button>

                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="modal fade" id="viewDiscountedFareModal" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">Discounted Fare Details</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">

                            <div class="row">

                                <div class="col-md-6">
                                    <label>Fare</label>
                                    <input type="text" class="form-control" id="v_fare_name" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label>Discount Name</label>
                                    <input type="text" class="form-control" id="v_discount_name" readonly>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-6">
                                    <label>Discount Type</label>
                                    <input type="text" class="form-control" id="v_discount_type" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label>Discount Value</label>
                                    <input type="text" class="form-control" id="v_discount_value" readonly>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-6">
                                    <label>Discounted Total</label>
                                    <input type="text" class="form-control" id="v_discounted_total" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label>Promo Code</label>
                                    <input type="text" class="form-control" id="v_promo_code" readonly>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-6">
                                    <label>Valid From</label>
                                    <input type="text" class="form-control" id="v_valid_from" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label>Valid To</label>
                                    <input type="text" class="form-control" id="v_valid_to" readonly>
                                </div>

                                <div class="clear"></div><br>

                                <div class="col-md-12">
                                    <label>Status</label>
                                    <input type="text" class="form-control" id="v_status" readonly>
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

        $(document).ready(function () {

            $(document).on('click', '.delete-discounted-fare', function () {

                let id = $(this).data('id');
                let row = $(this).closest('tr');

                if (confirm("Are you sure you want to delete this discounted fare?")) {

                    $.ajax({
                        url: 'ajax/delete',
                        type: 'POST',
                        data: {
                            id: id,
                            table: 'discounted_fares'
                        },
                        success: function (response) {

                            if (response.trim() == 'success') {

                                row.fadeOut(400, function () {
                                    $(this).remove();
                                });

                                toastr.success("Discounted Fare deleted successfully!");

                            } else {
                                toastr.error("Delete failed!");
                            }
                        }
                    });

                }

            });

        });

    </script>

    <script>
        $(document).on('click', '.view-discounted-fare', function () {

            $('#v_fare_name').val($(this).data('route'));
            $('#v_discount_name').val($(this).data('discount_name'));
            $('#v_discount_type').val($(this).data('discount_type'));
            $('#v_discount_value').val($(this).data('discount_value'));

            $('#v_discounted_total').val($(this).data('discounted_total'));
            $('#v_promo_code').val($(this).data('promo_code'));

            $('#v_valid_from').val($(this).data('valid_from'));
            $('#v_valid_to').val($(this).data('valid_to'));

            $('#v_status').val($(this).data('status'));

        });
    </script>
</body>

</html>