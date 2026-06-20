<?php

include('session.php');

$join = "INNER JOIN staff_profile on staff_profile.staff_id = staff_login.id";
$obj->select('staff_login', "staff_login.*,staff_profile.designation,staff_profile.cnic_passport,staff_profile.phone_1",$join);
$staff_details = $obj->getResult();


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
                <li> <a href=#><i
                            class="fa-home"></i>Dashboard</a>
                </li>
                <li> <a href="#">Staff</a> </li>
                <li class="active"> <strong>Data</strong> </li>
            </ol>

            <h3>Exporting Staff Table Data</h3>
            <br />

            <!-- Add Task Button -->
            <a href="<?= $base_url ?>add_staff" class="btn btn-primary">
                + Add Staff
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Designation</th>
                        <th>Phone</th>
                        <th>CNIC/PASSPORT</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sno = 1;

                    foreach ($staff_details as $staff) {
                        ?>
                        <tr>
                            <td><?= $sno++; ?></td>

                            <!-- Display route properly -->
                            <td><?php echo $staff['firstname'].' '.$staff['lastname'];; ?></td>

                            <td><?= $staff['email']; ?></td>
                            <td><?= $staff['designation']; ?></td>
                            <td><?= $staff['phone_1']; ?></td>
                            <td><?= $staff['cnic_passport']; ?></td>
                            <td><?= ($staff['is_active']) ? 'Active' : 'In Active'; ?></td>
                            <td>
                                <div style="display:flex;gap:10px">

                                    <!-- EDIT -->
                                    <a href="add_staff?id=<?= $staff['id']; ?>" class="btn btn-info btn-sm">
                                        Edit
                                    </a>

                                    <!-- DELETE -->
                                    <button data-id="<?= $staff['id']; ?>"
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
    
</body>

</html>