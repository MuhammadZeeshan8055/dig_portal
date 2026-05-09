<?php

include('session.php');

$isEdit = false;
$fareData = [];

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $id = (int) $_GET['id'];

    $obj->select("fares", "*", null, "id = $id");

    $result = $obj->getResult();

    if (!empty($result)) {

        $fareData = $result[0];

        $isEdit = true;
    }
}

if (isset($_POST['add_fare'])) {

    $data = array(
        'airline_name' => $_POST['airline_name'],
        'route' => $_POST['route'],
        'fare_type' => $_POST['fare_type'],
        'booking_class' => $_POST['booking_class'],
        'base_fare' => $_POST['base_fare'],
        'taxes' => $_POST['taxes'],
        'total_fare' => $_POST['total_fare'],
        'validity_from' => $_POST['validity_from'],
        'validity_to' => $_POST['validity_to'],
        'status' => $_POST['status'],
        'refund_policy' => $_POST['refund_policy'],
    );

    if (!empty($_POST['fare_id'])) {

        $fare_id = (int) $_POST['fare_id'];

        $update = $obj->update("fares", $data, "id = $fare_id");

        if ($update) {

            $_SESSION['toast'] = [
                'type' => 'success',
                'message' => 'Fare updated successfully!'
            ];

        } else {

            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Failed to update fare.'
            ];
        }

    } else {

        $insert = $obj->insert('fares', $data);

        if ($insert) {

            $_SESSION['toast'] = [
                'type' => 'success',
                'message' => 'Fare added successfully!'
            ];

        } else {

            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Failed to add fare.'
            ];
        }
    }

    header("Location: fares");
    exit;
}

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
                                Entry Fare Form
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form action="add_fare" method="post">
                                    <input type="hidden" name="fare_id" value="<?= $fareData['id'] ?? ''; ?>">
                                    <div class="row">

                                        <div class="col-md-1"></div>

                                        <div class="col-md-10">

                                            <div class="col-md-6">
                                                <label class="control-label">Airline Name</label>
                                                <input type="text" name="airline_name" class="form-control"
                                                    placeholder="Enter airline name"
                                                    value="<?= htmlspecialchars($fareData['airline_name'] ?? ''); ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="control-label">Route</label>
                                                <input type="text" name="route" class="form-control"
                                                    placeholder="e.g. Karachi → Jeddah"
                                                    value="<?= htmlspecialchars($fareData['route'] ?? ''); ?>" required>
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label class="control-label">Fare Type</label>
                                                <select name="fare_type" class="form-control" required>
                                                    <?php $fare_type = $fareData['fare_type'] ?? ''; ?>

                                                    <option value="">-- Select Fare Type --</option>

                                                    <option value="one_way" <?= ($fare_type == 'one_way') ? 'selected' : ''; ?>>
                                                        One Way
                                                    </option>

                                                    <option value="round_trip" <?= ($fare_type == 'round_trip') ? 'selected' : ''; ?>>
                                                        Round Trip
                                                    </option>

                                                    <option value="umrah" <?= ($fare_type == 'umrah') ? 'selected' : ''; ?>>
                                                        Umrah
                                                    </option>

                                                    <option value="group" <?= ($fare_type == 'group') ? 'selected' : ''; ?>>
                                                        Group Fare
                                                    </option>

                                                    <option value="promotion" <?= ($fare_type == 'promotion') ? 'selected' : ''; ?>>
                                                        Promotion Fare
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="control-label">Booking Class</label>
                                                <input type="text" name="booking_class" class="form-control"
                                                    placeholder="e.g. Economy / Business"
                                                    value="<?= htmlspecialchars($fareData['booking_class'] ?? ''); ?>">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label class="control-label">Base Fare</label>
                                                <input type="number" step="0.01" name="base_fare" class="form-control"
                                                    placeholder="Enter base fare"
                                                    value="<?= $fareData['base_fare'] ?? ''; ?>" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="control-label">Taxes</label>
                                                <input type="number" step="0.01" name="taxes" class="form-control"
                                                    placeholder="Enter taxes amount"
                                                    value="<?= $fareData['taxes'] ?? ''; ?>">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label class="control-label">Total Fare</label>
                                                <input type="number" step="0.01" name="total_fare" class="form-control"
                                                    placeholder="Enter total fare"
                                                    value="<?= $fareData['total_fare'] ?? ''; ?>" required>
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label class="control-label">Validity From</label>
                                                <input type="date" name="validity_from" class="form-control"
                                                    value="<?= $fareData['validity_from'] ?? ''; ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="control-label">Validity To</label>
                                                <input type="date" name="validity_to" class="form-control"
                                                    value="<?= $fareData['validity_to'] ?? ''; ?>">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label class="control-label">Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="active" <?= (($fareData['status'] ?? '') == 'active') ? 'selected' : ''; ?>>
                                                        Active
                                                    </option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                    <option value="expired">Expired</option>
                                                </select>
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-12">
                                                <label class="control-label">Refund Policy</label>

                                                <textarea name="refund_policy"
                                                    class="form-control ckeditor"><?= $fareData['refund_policy'] ?? ''; ?></textarea>

                                            </div>

                                        </div>

                                        <div class="clear"></div><br>

                                        <div class="col-md-12 text-center">
                                            <button type="submit" name="add_fare" class="btn btn-success">
                                                <?= $isEdit ? 'Update Fare' : 'Submit Fare Details'; ?>
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

    <script src="<?= $base_url ?>assets/js/neon-custom.js" id="script-resource-17"></script>
    <script src="https://themes.laborator.co/neon/demo/assets/js/ckeditor/ckeditor.js" id="script-resource-10"></script>
    <script src="https://themes.laborator.co/neon/demo/assets/js/ckeditor/adapters/jquery.js"
        id="script-resource-11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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