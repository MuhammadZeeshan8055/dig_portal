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
                                <form action="add_group_query" method="post">

                                    <div class="row">

                                        <div class="col-md-1"></div>

                                        <div class="col-md-10">

                                            <div class="col-md-6">
                                                <label class="control-label">Select Group Booking</label>
                                                <select name="group_booking_id" class="form-control" required>
                                                    <option value="">-- Select Group Booking --</option>
                                                    <option value="1">Umrah Group - Karachi 45 Pax</option>
                                                    <option value="2">Corporate Group - Islamabad 20 Pax</option>
                                                    <option value="3">Family Group - Lahore 12 Pax</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="control-label">Query Type</label>
                                                <select name="query_type" class="form-control">
                                                    <option value="">-- Select Query Type --</option>
                                                    <option value="visa">Visa</option>
                                                    <option value="hotel">Hotel</option>
                                                    <option value="fare">Fare</option>
                                                    <option value="transport">Transport</option>
                                                    <option value="ticketing">Ticketing</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label class="control-label">Customer Name</label>
                                                <input type="text" name="customer_name" class="form-control"
                                                    placeholder="Enter customer name" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="control-label">Contact Number</label>
                                                <input type="text" name="contact_number" class="form-control"
                                                    placeholder="Enter contact number">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-12">
                                                <label class="control-label">Query Details</label>
                                                <textarea name="query_details" class="form-control" rows="4"
                                                    placeholder="Enter full query details"></textarea>
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label class="control-label">Assign To</label>
                                                <input type="text" name="assigned_to" class="form-control"
                                                    placeholder="Assign to staff member">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="control-label">Follow-up Date</label>
                                                <input type="date" name="followup_date" class="form-control">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-12">
                                                <label class="control-label">Notes</label>
                                                <textarea name="notes" class="form-control" rows="3"
                                                    placeholder="Internal notes (optional)"></textarea>
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label class="control-label">Query Status</label>
                                                <select name="query_status" class="form-control">
                                                    <option value="">-- Select Status --</option>
                                                    <option value="open">Open</option>
                                                    <option value="in_progress">In Progress</option>
                                                    <option value="resolved">Resolved</option>
                                                    <option value="closed">Closed</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="clear"></div><br>

                                        <div class="col-md-12 text-center">
                                            <button type="submit" name="add_group_query" class="btn btn-success">
                                                Submit Group Query
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