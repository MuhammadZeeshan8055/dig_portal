<?php

include('session.php');

$staffData = [];
$profileData = [];
$permissionData = [];

$isEdit = false;
$staff_id = 0;

/* ================= LOAD EDIT DATA ================= */
if (!empty($_GET['id'])) {

    $staff_id = (int) $_GET['id'];
    $isEdit = true;

    /* ================= LOGIN ================= */
    $obj->select("staff_login", "*", null, "id = $staff_id");
    $loginResult = $obj->getResult();


    if (!empty($loginResult)) {
        $staffData = $loginResult[0];
    }

    /* ================= PROFILE ================= */
    $obj->select("staff_profile", "*", null, "staff_id = $staff_id");
    $profileResult = $obj->getResult();

    if (!empty($profileResult)) {
        $profileData = $profileResult[0];
    }

    /* ================= PERMISSIONS ================= */
    $obj->select("staff_permissions", "*", null, "staff_id = $staff_id");
    $permissionResult = $obj->getResult();

    if (!empty($permissionResult)) {
        $permissionData = $permissionResult[0];
    }
}


/* ================= SAVE STAFF ================= */
if (isset($_POST['save_staff'])) {

    $staff_id = !empty($_POST['staff_id']) ? (int) $_POST['staff_id'] : 0;

    /* ================= LOGIN DATA ================= */
    $loginData = array(
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'email' => $_POST['email'],
        'role' => $_POST['role']
    );

    if (!empty($_POST['password'])) {
        $loginData['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
    }

    /* ================= LOGIN INSERT / UPDATE ================= */
    if (!empty($staff_id)) {

        $obj->update("staff_login", $loginData, "id = $staff_id");

    } else {

        $loginData['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $obj->insert("staff_login", $loginData);

        $staff_id = $obj->lastInsertedId();
    }



    /* ================= PROFILE DATA ================= */
    $profileData = array(
        'staff_id' => $staff_id,
        'company' => $_POST['company'],
        'designation' => $_POST['designation'],
        'date_of_joining' => $_POST['date_of_joining'],
        'salary' => $_POST['salary'],
        'currency' => $_POST['currency'],
        'cnic_passport' => $_POST['cnic_passport'],
        'permanent_address' => $_POST['permanent_address'],
        'country' => $_POST['country'],
        'phone_1' => $_POST['phone_1'],
        'phone_2' => $_POST['phone_2'],
        'bank_name' => $_POST['bank_name'],
        'account_title' => $_POST['account_title'],
        'iban' => $_POST['iban']
    );



    /* ================= PROFILE INSERT / UPDATE ================= */
    $obj->select("staff_profile", "*", null, "staff_id = $staff_id");
    $profileExists = $obj->getResult();

    if (!empty($profileExists)) {
        $obj->update("staff_profile", $profileData, "staff_id = $staff_id");
    } else {
        $obj->insert("staff_profile", $profileData);
    }


    /* ================= PERMISSIONS DATA ================= */
    $permissionData = array(
        'staff_id' => $staff_id,
        'can_view' => isset($_POST['can_view']) ? 1 : 0,
        'can_add' => isset($_POST['can_add']) ? 1 : 0,
        'can_update' => isset($_POST['can_update']) ? 1 : 0,
        'can_delete' => isset($_POST['can_delete']) ? 1 : 0,
        'manage_accounts' => isset($_POST['manage_accounts']) ? 1 : 0
    );

    // pr($permissionData);

    /* ================= PERMISSION INSERT / UPDATE ================= */
    $obj->select("staff_permissions", "*", null, "staff_id = $staff_id");
    $permExists = $obj->getResult();

    if (!empty($permExists)) {
        $obj->update("staff_permissions", $permissionData, "staff_id = $staff_id");
    } else {
        $obj->insert("staff_permissions", $permissionData);
    }


    /* ================= TOAST ================= */
    $_SESSION['toast'] = array(
        'type' => 'success',
        'message' => (!empty($_POST['staff_id']))
            ? 'Staff updated successfully!'
            : 'Staff created successfully!'
    );

    header("Location: staff_details");
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
    <title>Dhothar International DIG | Staff</title>

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
                <li> <a href="#">Staff</a> </li>
                <li class="active"> <strong>Add Staff</strong> </li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary" data-collapsed="0">
                        <div class="panel-heading">
                            <div class="panel-title">
                                Entry Staff Details
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form action="" method="post">

                                    <input type="hidden" name="staff_id" value="<?= $staffData['id'] ?? ''; ?>">

                                    <div class="row">

                                        <div class="col-md-1"></div>

                                        <div class="col-md-10">

                                            <hr>

                                            <h3>Login Information</h3>

                                            <hr>

                                            <div class="col-md-6">
                                                <label>First Name</label>
                                                <input type="text" name="firstname" class="form-control"
                                                    value="<?= $staffData['firstname'] ?? ''; ?>"
                                                    placeholder="Enter first name">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Last Name</label>
                                                <input type="text" name="lastname" class="form-control"
                                                    value="<?= $staffData['lastname'] ?? ''; ?>"
                                                    placeholder="Enter last name">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="<?= $staffData['email'] ?? ''; ?>" placeholder="Enter email">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="Enter password">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label>Role</label>
                                                <select name="role" class="form-control">
                                                    <option value="">-- Select Role --</option>
                                                    <option value="staff" <?= ($staffData['role'] ?? '') == 'staff' ? 'selected' : '' ?>>Staff</option>
                                                    <option value="admin" <?= ($staffData['role'] ?? '') == 'admin' ? 'selected' : '' ?>>Admin</option>
                                                    <option value="manager" <?= ($staffData['role'] ?? '') == 'manager' ? 'selected' : '' ?>>Manager</option>
                                                    <option value="super_admin" <?= ($staffData['role'] ?? '') == 'super_admin' ? 'selected' : '' ?>>Super Admin</option>
                                                </select>
                                            </div>

                                            <div class="clear"></div><br>

                                            <hr>

                                            <h3>Profile Information</h3>

                                            <hr>

                                            <div class="col-md-6">
                                                <label>Company</label>
                                                <input type="text" name="company" class="form-control"
                                                    value="<?= $profileData['company'] ?? ''; ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Designation</label>
                                                <input type="text" name="designation" class="form-control"
                                                    value="<?= $profileData['designation'] ?? ''; ?>">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label>Date of Joining</label>
                                                <input type="date" name="date_of_joining" class="form-control"
                                                    value="<?= $profileData['date_of_joining'] ?? ''; ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Salary</label>
                                                <input type="number" name="salary" class="form-control"
                                                    value="<?= $profileData['salary'] ?? ''; ?>">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label>Currency</label>
                                                <input type="text" name="currency" class="form-control"
                                                    value="<?= $profileData['currency'] ?? 'PKR'; ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>CNIC / Passport</label>
                                                <input type="text" name="cnic_passport" class="form-control"
                                                    value="<?= $profileData['cnic_passport'] ?? ''; ?>">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-12">
                                                <label>Permanent Address</label>
                                                <input type="text" name="permanent_address" class="form-control"
                                                    value="<?= $profileData['permanent_address'] ?? ''; ?>">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label>Country</label>
                                                <input type="text" name="country" class="form-control"
                                                    value="<?= $profileData['country'] ?? ''; ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Phone 1</label>
                                                <input type="text" name="phone_1" class="form-control"
                                                    value="<?= $profileData['phone_1'] ?? ''; ?>">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label>Phone 2</label>
                                                <input type="text" name="phone_2" class="form-control"
                                                    value="<?= $profileData['phone_2'] ?? ''; ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Bank Name</label>
                                                <input type="text" name="bank_name" class="form-control"
                                                    value="<?= $profileData['bank_name'] ?? ''; ?>">
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-6">
                                                <label>Account Title</label>
                                                <input type="text" name="account_title" class="form-control"
                                                    value="<?= $profileData['account_title'] ?? ''; ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>IBAN</label>
                                                <input type="text" name="iban" class="form-control"
                                                    value="<?= $profileData['iban'] ?? ''; ?>">
                                            </div>

                                            <div class="clear"></div><br>

                                            <hr>

                                            <!-- ================= PERMISSIONS ================= -->
                                            <h3>Staff Permissions</h3>

                                            <hr>

                                            <div class="col-md-12">
                                                <label>
                                                    <input type="checkbox" id="all_permissions">
                                                    <strong>All Permissions</strong>
                                                </label>
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-3">
                                                <label>
                                                    <input type="checkbox" name="can_view" class="perm-checkbox"
                                                        value="1" <?= !empty($permissionData['can_view']) ? 'checked' : ''; ?>>
                                                    Can View
                                                </label>
                                            </div>

                                            <div class="col-md-3">
                                                <label>
                                                    <input type="checkbox" name="can_add" class="perm-checkbox"
                                                        value="1" <?= !empty($permissionData['can_add']) ? 'checked' : ''; ?>>
                                                    Can Add
                                                </label>
                                            </div>

                                            <div class="col-md-3">
                                                <label>
                                                    <input type="checkbox" name="can_update" class="perm-checkbox"
                                                        value="1" <?= !empty($permissionData['can_update']) ? 'checked' : ''; ?>>
                                                    Can Update
                                                </label>
                                            </div>

                                            <div class="col-md-3">
                                                <label>
                                                    <input type="checkbox" name="can_delete" class="perm-checkbox"
                                                        value="1" <?= !empty($permissionData['can_delete']) ? 'checked' : ''; ?>>
                                                    Can Delete
                                                </label>
                                            </div>

                                            <div class="clear"></div><br>

                                            <div class="col-md-12">
                                                <label>
                                                    <input type="checkbox" name="manage_accounts" class="perm-checkbox"
                                                        value="1" <?= !empty($permissionData['manage_accounts']) ? 'checked' : ''; ?>>
                                                    Manage Accounts Access
                                                </label>
                                            </div>

                                        </div>

                                        <div class="clear"></div><br>

                                        <div class="col-md-12 text-center">
                                            <button type="submit" name="save_staff" class="btn btn-success">
                                                <?= $isEdit ? 'Update Staff' : 'Submit Staff' ?>
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
    <script>
        $(document).ready(function () {

            const allBox = $('#all_permissions');
            const perms = $('.perm-checkbox');

            /* ===============================
               SYNC FUNCTION
            =============================== */
            function syncAll() {

                let total = perms.length;
                let checked = perms.filter(':checked').length;

                allBox.prop('checked', total > 0 && total === checked);
            }

            /* ===============================
               ALL PERMISSIONS CLICK
            =============================== */
            allBox.on('change', function () {

                if ($(this).is(':checked')) {

                    perms.prop('checked', true);

                } else {

                    perms.prop('checked', false);

                }

                syncAll();
            });

            /* ===============================
               INDIVIDUAL PERMISSION CHANGE
            =============================== */
            perms.on('change', function () {

                syncAll();
            });

            /* ===============================
               EDIT MODE INITIAL SYNC
            =============================== */
            syncAll();

            /* ===============================
               FORM SUBMIT SAFETY (IMPORTANT)
            =============================== */
            $('form').on('submit', function () {

                // ensure all selected values are sent correctly
                syncAll();

            });

        });
    </script>
</body>

</html>