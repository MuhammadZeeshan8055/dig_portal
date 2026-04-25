<?php

include('session.php');
include('database.php');

$obj = new Database();

$obj->select("task_management", "*");
$tasks = $obj->getResult();

if (isset($_POST['save_task'])) {

    $data = [
        "title" => $_POST['title'],
        "description" => $_POST['description'],
        "priority" => $_POST['priority'],
        "due_date" => $_POST['due_date']
    ];

    if (!empty($_POST['task_id'])) {

        // UPDATE
        $id = $_POST['task_id'];
        $obj->update("task_management", $data, "id=$id");

        $_SESSION['toast'] = [
            'type' => 'success',
            'message' => 'Task updated successfully!'
        ];

    } else {

        // INSERT
        $obj->insert("task_management", $data);

        $_SESSION['toast'] = [
            'type' => 'success',
            'message' => 'Task added successfully!'
        ];
    }

    header("Location: working_queries.php");
    exit;
}

if (isset($_POST['add_task'])) {

    $obj = new Database();

    $data = array(
        "title" => $_POST['title'],
        "description" => $_POST['description'],
        "priority" => $_POST['priority'],
        "due_date" => $_POST['due_date'],
        "status" => 'pending'
    );

    $insert = $obj->insert("task_management", $data);

    if ($insert) {
        $_SESSION['toast'] = [
            'type' => 'success',
            'message' => 'Task added successfully!'
        ];
    } else {
        $_SESSION['toast'] = [
            'type' => 'error',
            'message' => 'Failed to add task!'
        ];
    }

    header("Location: " . $_SERVER['PHP_SELF']);
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
    <title>Dhothar International Employee DB | Dashboard</title>

    <link rel="stylesheet" href="<?= $base_url ?>assets/css/font-icons/entypo/css/entypo.css" id="style-resource-2">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic"
        id="style-resource-3">
    <link rel="stylesheet" href="<?= $base_url ?>assets/css/bootstrap.css" id="style-resource-4">
    <link rel="stylesheet" href="<?= $base_url ?>assets/css/neon-core.css" id="style-resource-5">

    <script src="<?= $base_url ?>assets/js/jquery-1.11.3.min.js"></script>

    <style>
        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .4px;
        }

        .badge-high {
            background: #e74c3c;
            color: #fff;
        }

        .badge-medium {
            background: #fad839;
            color: #fff;
        }

        .badge-low {
            background: #27ae60;
            color: #fff;
        }

        .label {
            border-radius: 12px;
            font-size: 12px;

        }

        .btn {
            border-radius: 15px;
        }

        .completed {
            text-decoration: line-through;
        }
    </style>

</head>

<body class="">
    <div class="page-container">
        <div class="sidebar-menu">

            <?php include('components/sidebar.php'); ?>


        </div>
        <div class="main-content">


            <?php include('components/header.php'); ?>


            <hr />


            <h3>Exporting Table Data</h3>
            <br />

            <!-- Add Task Button -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTaskModal">
                + Add Task
            </button>

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
                        <th>Title</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sno = 1;
                    foreach ($tasks as $task) {
                        ?>
                        <tr class="<?php echo ($task['status'] == 'completed') ? 'completed' : ''; ?>">
                            <td><?php echo $sno++; ?></td>
                            <td><?php echo $task['title']; ?></td>
                            <td><?php echo $task['description']; ?></td>
                            <td>
                                <?php if ($task['priority'] == 'Low'): ?>
                                    <span class="badge badge-low">Low</span>
                                <?php elseif ($task['priority'] == 'Medium'): ?>
                                    <span class="badge badge-medium">Medium</span>
                                <?php elseif ($task['priority'] == 'High'): ?>
                                    <span class="badge badge-high">High</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo formatDate($task['due_date']); ?></td>
                            <td>
                                <?php if ($task['status'] == 'completed'): ?>
                                    <span class="label label-success">
                                        <?php echo $task['status']; ?>
                                    </span>

                                <?php elseif ($task['status'] == 'pending'): ?>
                                    <span class="label label-primary">
                                        <?php echo $task['status']; ?>
                                    </span>

                                <?php else: ?>
                                    <span class="label label-default">
                                        <?php echo $task['status']; ?>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div style="display:flex;gap:10px">
                                    <a href="javascript:void(0)" class="btn btn-info btn-sm edit-task"
                                        data-id="<?= $task['id']; ?>" data-title="<?= htmlspecialchars($task['title']); ?>"
                                        data-description="<?= htmlspecialchars($task['description']); ?>"
                                        data-priority="<?= $task['priority']; ?>" data-due_date="<?= $task['due_date']; ?>"
                                        data-toggle="modal" data-target="#addTaskModal">
                                        <span class="entypo-pencil"></span> Edit
                                    </a>
                                    <button class="btn btn-danger btn-sm delete-task" data-id="<?= $task['id']; ?>">
                                        <span class="entypo-trash"></span> Delete
                                    </button>

                                    <?php
                                    echo ($task['status'] == 'completed')
                                        ? ''
                                        : '<a href="#" class="btn btn-warning btn-sm complete-task" data-id="' . $task['id'] . '">
                                        Mark As Completed
                                    </a>';
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>


            <!-- ADD TASK MODAL -->
            <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="addTaskForm" method="post">

                            <input type="hidden" name="task_id" id="task_id">

                            <div class="modal-header">
                                <h5 class="modal-title">Add / Edit Task</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" id="title" required>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="3"
                                        required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Priority</label>
                                    <select class="form-control" name="priority" id="priority">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Due Date</label>
                                    <input type="date" class="form-control" name="due_date" id="due_date" required>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="submit" name="save_task" class="btn btn-primary">
                                    Save Task
                                </button>
                            </div>

                        </form>

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
        $('#addTaskModal').on('hidden.bs.modal', function () {
            document.getElementById('addTaskForm').reset(); // clears all inputs
            $('#task_id').val('');                          // clears edit ID (important)
        });
    </script>

    <script>
        $(document).on('click', '.edit-task', function () {

            $('#task_id').val($(this).data('id'));
            $('#title').val($(this).data('title'));
            $('#description').val($(this).data('description'));
            $('#priority').val($(this).data('priority'));
            $('#due_date').val($(this).data('due_date'));

        });
    </script>

    <script>
        $(document).ready(function () {

            $(document).on('click', '.delete-task', function () {

                let id = $(this).data('id');
                let row = $(this).closest('tr');

                if (confirm("Are you sure you want to delete this task?")) {

                    $.ajax({
                        url: 'ajax/delete_task',
                        type: 'POST',
                        data: { id: id },
                        success: function (response) {

                            if (response.trim() == 'success') {

                                row.fadeOut(400, function () {
                                    $(this).remove();
                                });

                                toastr.success("Task deleted successfully!");

                            } else {
                                toastr.error("Delete failed!");
                            }
                        }
                    });

                }

            });

            $(document).on('click', '.complete-task', function () {

                let id = $(this).data('id');
                let row = $(this).closest('tr');

                $.ajax({
                    url: 'ajax/complete_task',
                    type: 'POST',
                    data: { id: id },
                    success: function (response) {

                        if (response.trim() == 'success') {

                            row.find('.label')
                                .removeClass('label-primary')
                                .addClass('label-success')
                                .text('completed');

                            // ✅ add completed class to row
                            row.addClass('completed');

                            toastr.success("Task marked as completed!");

                        } else {
                            toastr.error("Update failed!");
                        }
                    }
                });



            });

        });
    </script>

</body>

</html>