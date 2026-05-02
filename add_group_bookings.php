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
                <li> <a href="https://themes.laborator.co/neon/demo/layouts/layout-api/">Group Booking</a> </li>
                <li class="active"> <strong>Add Group Booking</strong> </li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary" data-collapsed="0">
                        <div class="panel-heading">
                            <div class="panel-title">
                                Entry Group Booking Form
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form action="add_group_booking" method="post">

                                    <div class="row">

                                        <div class="col-md-1"></div>

                                        <div class="col-md-10">

                                            <div class="col-md-6">
                                                <label class="control-label">Group Name</label>
                                                <input type="text" name="group_name" class="form-control"
                                                    placeholder="Enter group name" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="control-label">Group Type</label>
                                                <select name="group_type" class="form-control">
                                                    <option value="">-- Select Group Type --</option>
                                                    <option value="umrah">Umrah</option>
                                                    <option value="corporate">Corporate</option>
                                                    <option value="family">Family</option>
                                                    <option value="tour">Tour</option>
                                                </select>
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label class="control-label">Total Passengers</label>
                                                <input type="number" name="total_passengers" class="form-control"
                                                    placeholder="Enter total passengers" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="control-label">Departure City</label>
                                                <input type="text" name="departure_city" class="form-control"
                                                    placeholder="Enter departure city">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label class="control-label">Travel Date</label>
                                                <input type="date" name="travel_date" class="form-control">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="control-label">Package Type</label>
                                                <input type="text" name="package_type" class="form-control"
                                                    placeholder="e.g. Economy / VIP Package">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label class="control-label">Total Amount</label>
                                                <input type="number" step="0.01" name="total_amount"
                                                    class="form-control" placeholder="Enter total amount">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="control-label">Deposit Amount</label>
                                                <input type="number" step="0.01" name="deposit_amount"
                                                    class="form-control" placeholder="Enter deposit amount">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label class="control-label">Payment Deadline</label>
                                                <input type="date" name="payment_deadline" class="form-control">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="control-label">Assigned Agent</label>
                                                <input type="text" name="assigned_agent" class="form-control"
                                                    placeholder="Enter assigned agent name">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label class="control-label">Booking Status</label>
                                                <select name="booking_status" class="form-control">
                                                    <option value="">-- Select Booking Status --</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="confirmed">Confirmed</option>
                                                    <option value="cancelled">Cancelled</option>
                                                    <option value="completed">Completed</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="clear"></div><br>

                                        <div class="col-md-12 text-center">
                                            <button type="submit" name="add_group_booking" class="btn btn-success">
                                                Submit Group Booking
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