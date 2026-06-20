<?php

include('session.php');

$groupData = [];
$isEdit = false;

if (!empty($_GET['id'])) {

    $id = (int) $_GET['id'];

    $obj->select("group_bookings", "*", null, "id = $id");
    $result = $obj->getResult();

    if (!empty($result)) {
        $groupData = $result[0];
        $isEdit = true;
    }
}

if (isset($_POST['add_group_booking'])) {

    $data = array(
        'group_name' => $_POST['group_name'],
        'group_type' => $_POST['group_type'],
        'total_passengers' => $_POST['total_passengers'],
        'departure_city' => $_POST['departure_city'],
        'travel_date' => $_POST['travel_date'],
        'package_type' => $_POST['package_type'],
        'total_amount' => $_POST['total_amount'],
        'deposit_amount' => $_POST['deposit_amount'],
        'payment_deadline' => $_POST['payment_deadline'],
        'assigned_agent' => $_POST['assigned_agent'],
        'booking_status' => $_POST['booking_status'],
    );

    // EDIT MODE
    if (!empty($_POST['group_booking_id'])) {

        $id = (int) $_POST['group_booking_id'];

        $update = $obj->update("group_bookings", $data, "id = $id");

        if ($update) {
            $_SESSION['toast'] = [
                'type' => 'success',
                'message' => 'Group booking updated successfully!'
            ];
        } else {
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Failed to update group booking!'
            ];
        }

    }
    // ADD MODE
    else {

        $insert = $obj->insert("group_bookings", $data);

        if ($insert) {
            $_SESSION['toast'] = [
                'type' => 'success',
                'message' => 'Group booking added successfully!'
            ];
        } else {
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Failed to add group booking!'
            ];
        }
    }

    header("Location: group_bookings");
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
                <li> <a href="#">Group Booking</a> </li>
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
                                <form action="" method="post">

                                    <input type="hidden" name="group_booking_id" value="<?= $groupData['id'] ?? ''; ?>">

                                    <div class="row">

                                        <div class="col-md-1"></div>

                                        <div class="col-md-10">

                                            <!-- Group Name -->
                                            <div class="col-md-6">
                                                <label class="control-label">Group Name</label>
                                                <input type="text" name="group_name" class="form-control"
                                                    value="<?= htmlspecialchars($groupData['group_name'] ?? ''); ?>"
                                                    placeholder="Enter group name" required>
                                            </div>

                                            <!-- Group Type -->
                                            <?php $group_type = $groupData['group_type'] ?? ''; ?>

                                            <div class="col-md-6">
                                                <label class="control-label">Group Type</label>
                                                <select name="group_type" class="form-control">

                                                    <option value="">-- Select Group Type --</option>

                                                    <option value="umrah" <?= ($group_type == 'umrah') ? 'selected' : ''; ?>>Umrah</option>
                                                    <option value="corporate" <?= ($group_type == 'corporate') ? 'selected' : ''; ?>>Corporate</option>
                                                    <option value="family" <?= ($group_type == 'family') ? 'selected' : ''; ?>>Family</option>
                                                    <option value="tour" <?= ($group_type == 'tour') ? 'selected' : ''; ?>>
                                                        Tour</option>

                                                </select>
                                            </div>

                                            <div class="clear"></div><br>

                                            <!-- Total Passengers -->
                                            <div class="col-md-6">
                                                <label class="control-label">Total Passengers</label>
                                                <input type="number" name="total_passengers" class="form-control"
                                                    value="<?= $groupData['total_passengers'] ?? ''; ?>"
                                                    placeholder="Enter total passengers" required>
                                            </div>

                                            <!-- Departure City -->
                                            <div class="col-md-6">
                                                <label class="control-label">Departure City</label>
                                                <input type="text" name="departure_city" class="form-control"
                                                    value="<?= htmlspecialchars($groupData['departure_city'] ?? ''); ?>"
                                                    placeholder="Enter departure city">
                                            </div>

                                            <div class="clear"></div><br>

                                            <!-- Travel Date -->
                                            <div class="col-md-6">
                                                <label class="control-label">Travel Date</label>
                                                <input type="date" name="travel_date" class="form-control"
                                                    value="<?= $groupData['travel_date'] ?? ''; ?>">
                                            </div>

                                            <!-- Package Type -->
                                            <div class="col-md-6">
                                                <label class="control-label">Package Type</label>
                                                <input type="text" name="package_type" class="form-control"
                                                    value="<?= htmlspecialchars($groupData['package_type'] ?? ''); ?>"
                                                    placeholder="e.g. Economy / VIP Package">
                                            </div>

                                            <div class="clear"></div><br>

                                            <!-- Total Amount -->
                                            <div class="col-md-6">
                                                <label class="control-label">Total Amount</label>
                                                <input type="number" step="0.01" name="total_amount"
                                                    class="form-control"
                                                    value="<?= $groupData['total_amount'] ?? ''; ?>"
                                                    placeholder="Enter total amount">
                                            </div>

                                            <!-- Deposit Amount -->
                                            <div class="col-md-6">
                                                <label class="control-label">Deposit Amount</label>
                                                <input type="number" step="0.01" name="deposit_amount"
                                                    class="form-control"
                                                    value="<?= $groupData['deposit_amount'] ?? ''; ?>"
                                                    placeholder="Enter deposit amount">
                                            </div>

                                            <div class="clear"></div><br>

                                            <!-- Payment Deadline -->
                                            <div class="col-md-6">
                                                <label class="control-label">Payment Deadline</label>
                                                <input type="date" name="payment_deadline" class="form-control"
                                                    value="<?= $groupData['payment_deadline'] ?? ''; ?>">
                                            </div>

                                            <!-- Assigned Agent -->
                                            <div class="col-md-6">
                                                <label class="control-label">Assigned Agent</label>
                                                <input type="text" name="assigned_agent" class="form-control"
                                                    value="<?= htmlspecialchars($groupData['assigned_agent'] ?? ''); ?>"
                                                    placeholder="Enter assigned agent name">
                                            </div>

                                            <div class="clear"></div><br>

                                            <!-- Booking Status -->
                                            <?php $status = $groupData['booking_status'] ?? ''; ?>

                                            <div class="col-md-6">
                                                <label class="control-label">Booking Status</label>
                                                <select name="booking_status" class="form-control">

                                                    <option value="">-- Select Booking Status --</option>

                                                    <option value="pending" <?= ($status == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                                    <option value="confirmed" <?= ($status == 'confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                                                    <option value="cancelled" <?= ($status == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                                                    <option value="completed" <?= ($status == 'completed') ? 'selected' : ''; ?>>Completed</option>

                                                </select>
                                            </div>

                                        </div>

                                        <div class="clear"></div><br>

                                        <!-- Submit -->
                                        <div class="col-md-12 text-center">
                                            <button type="submit" name="add_group_booking" class="btn btn-success">
                                                <?= !empty($groupData['id']) ? 'Update Group Booking' : 'Submit Group Booking'; ?>
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