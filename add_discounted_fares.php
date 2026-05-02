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
                <li> <a href="https://themes.laborator.co/neon/demo/layouts/layout-api/">Disounted Fare</a> </li>
                <li class="active"> <strong>Add Disounted Fare</strong> </li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary" data-collapsed="0">
                        <div class="panel-heading">
                            <div class="panel-title">
                                Entry Disounted Fare Form
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form action="add_discounted_fare" method="post">

                                    <div class="row">

                                        <div class="col-md-1"></div>

                                        <div class="col-md-10">

                                            <div class="col-md-6">
                                                <label class="control-label">Select Fare</label>
                                                <select name="fare_id" class="form-control" required>
                                                    <option value="">-- Select Fare --</option>
                                                    <option value="1">PIA - Karachi → Jeddah</option>
                                                    <option value="2">Saudia - Lahore → Madinah</option>
                                                    <option value="3">Emirates - Islamabad → Dubai</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="control-label">Discount Name</label>
                                                <input type="text" name="discount_name" class="form-control"
                                                    placeholder="e.g. Ramadan Offer" required>
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label class="control-label">Discount Type</label>
                                                <select name="discount_type" class="form-control" required>
                                                    <option value="">-- Select Discount Type --</option>
                                                    <option value="percentage">Percentage</option>
                                                    <option value="fixed">Fixed Amount</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="control-label">Discount Value</label>
                                                <input type="number" step="0.01" name="discount_value"
                                                    class="form-control" placeholder="Enter discount value" required>
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label class="control-label">Discounted Total</label>
                                                <input type="number" step="0.01" name="discounted_total"
                                                    class="form-control" placeholder="Enter discounted total fare"
                                                    required>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="control-label">Promo Code</label>
                                                <input type="text" name="promo_code" class="form-control"
                                                    placeholder="Enter promo code">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label class="control-label">Valid From</label>
                                                <input type="date" name="valid_from" class="form-control">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="control-label">Valid To</label>
                                                <input type="date" name="valid_to" class="form-control">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label class="control-label">Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="">-- Select Status --</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                    <option value="expired">Expired</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="clear"></div><br>

                                        <div class="col-md-12 text-center">
                                            <button type="submit" name="add_discounted_fare" class="btn btn-success">
                                                Submit Discounted Fare
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