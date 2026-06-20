<?php

include('session.php');

$fareData = [];
$isEdit = false;

if (!empty($_GET['id'])) {

    $id = (int) $_GET['id'];

    $obj->select("discounted_fares", "*", null, "id = $id");
    $result = $obj->getResult();

    if (!empty($result)) {
        $fareData = $result[0];
        $isEdit = true;
    }
}


if (isset($_POST['add_discounted_fare'])) {

    $data = array(
        'fare_id' => $_POST['fare_id'],
        'discount_name' => $_POST['discount_name'],
        'discount_type' => $_POST['discount_type'],
        'discount_value' => $_POST['discount_value'],
        'discounted_total' => $_POST['discounted_total'],
        'promo_code' => $_POST['promo_code'],
        'valid_from' => $_POST['valid_from'],
        'valid_to' => $_POST['valid_to'],
        'status' => $_POST['status'],
    );

    // EDIT MODE
    if (!empty($_POST['discounted_fare_id'])) {

        $id = (int) $_POST['discounted_fare_id'];

        $update = $obj->update("discounted_fares", $data, "id = $id");

        if ($update) {
            $_SESSION['toast'] = [
                'type' => 'success',
                'message' => 'Discounted fare updated successfully!'
            ];
        } else {
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Failed to update discounted fare!'
            ];
        }

    }
    // ADD MODE
    else {

        $insert = $obj->insert("discounted_fares", $data);

        if ($insert) {
            $_SESSION['toast'] = [
                'type' => 'success',
                'message' => 'Discounted fare added successfully!'
            ];
        } else {
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Failed to add discounted fare!'
            ];
        }
    }

    header("Location: discounted_fares");
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
                <li> <a href=#><i
                            class="fa-home"></i>Dashboard</a>
                </li>
                <li> <a href="#">Disounted Fare</a> </li>
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
                                <form action="" method="post">

                                    <input type="hidden" name="discounted_fare_id"
                                        value="<?= $fareData['id'] ?? ''; ?>">

                                    <div class="row">

                                        <div class="col-md-1"></div>

                                        <div class="col-md-10">

                                            <!-- Fare Select -->
                                            <div class="col-md-6">
                                                <label class="control-label">Select Fare</label>

                                                <select name="fare_id" class="form-control" required>

                                                    <option value="">-- Select Fare --</option>

                                                    <?php
                                                    $obj->select('fares', 'id, route');
                                                    $fares = $obj->getResult();

                                                    $selected_fare = $fareData['fare_id'] ?? '';
                                                    ?>

                                                    <?php foreach ($fares as $fare): ?>

                                                        <option value="<?= $fare['id']; ?>" <?= ($selected_fare == $fare['id']) ? 'selected' : ''; ?>>

                                                            <?= $fare['route']; ?>

                                                        </option>

                                                    <?php endforeach; ?>

                                                </select>
                                            </div>

                                            <!-- Discount Name -->
                                            <div class="col-md-6">
                                                <label class="control-label">Discount Name</label>
                                                <input type="text" name="discount_name" class="form-control"
                                                    value="<?= htmlspecialchars($fareData['discount_name'] ?? ''); ?>"
                                                    placeholder="e.g. Ramadan Offer" required>
                                            </div>

                                            <div class="clear"></div><br>

                                            <!-- Discount Type -->
                                            <?php $discount_type = $fareData['discount_type'] ?? ''; ?>

                                            <div class="col-md-6">
                                                <label class="control-label">Discount Type</label>
                                                <select name="discount_type" class="form-control" required>

                                                    <option value="">-- Select Discount Type --</option>

                                                    <option value="percentage" <?= ($discount_type == 'percentage') ? 'selected' : ''; ?>>
                                                        Percentage
                                                    </option>

                                                    <option value="fixed" <?= ($discount_type == 'fixed') ? 'selected' : ''; ?>>
                                                        Fixed Amount
                                                    </option>

                                                </select>
                                            </div>

                                            <!-- Discount Value -->
                                            <div class="col-md-6">
                                                <label class="control-label">Discount Value</label>
                                                <input type="number" step="0.01" name="discount_value"
                                                    class="form-control"
                                                    value="<?= $fareData['discount_value'] ?? ''; ?>"
                                                    placeholder="Enter discount value" required>
                                            </div>

                                            <div class="clear"></div><br>

                                            <!-- Discounted Total -->
                                            <div class="col-md-6">
                                                <label class="control-label">Discounted Total</label>
                                                <input type="number" step="0.01" name="discounted_total"
                                                    class="form-control"
                                                    value="<?= $fareData['discounted_total'] ?? ''; ?>"
                                                    placeholder="Enter discounted total fare" required>
                                            </div>

                                            <!-- Promo Code -->
                                            <div class="col-md-6">
                                                <label class="control-label">Promo Code</label>
                                                <input type="text" name="promo_code" class="form-control"
                                                    value="<?= htmlspecialchars($fareData['promo_code'] ?? ''); ?>"
                                                    placeholder="Enter promo code">
                                            </div>

                                            <div class="clear"></div><br>

                                            <!-- Valid From -->
                                            <div class="col-md-6">
                                                <label class="control-label">Valid From</label>
                                                <input type="date" name="valid_from" class="form-control"
                                                    value="<?= $fareData['valid_from'] ?? ''; ?>">
                                            </div>

                                            <!-- Valid To -->
                                            <div class="col-md-6">
                                                <label class="control-label">Valid To</label>
                                                <input type="date" name="valid_to" class="form-control"
                                                    value="<?= $fareData['valid_to'] ?? ''; ?>">
                                            </div>

                                            <div class="clear"></div><br>

                                            <!-- Status -->
                                            <?php $status = $fareData['status'] ?? ''; ?>

                                            <div class="col-md-6">
                                                <label class="control-label">Status</label>
                                                <select name="status" class="form-control">

                                                    <option value="">-- Select Status --</option>

                                                    <option value="active" <?= ($status == 'active') ? 'selected' : ''; ?>>
                                                        Active
                                                    </option>

                                                    <option value="inactive" <?= ($status == 'inactive') ? 'selected' : ''; ?>>
                                                        Inactive
                                                    </option>

                                                    <option value="expired" <?= ($status == 'expired') ? 'selected' : ''; ?>>
                                                        Expired
                                                    </option>

                                                </select>
                                            </div>

                                        </div>

                                        <div class="clear"></div><br>

                                        <div class="col-md-12 text-center">
                                            <button type="submit" name="add_discounted_fare" class="btn btn-success">
                                                <?= $isEdit ? 'Update Discounted Fare' : 'Submit Discounted Fare'; ?>
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