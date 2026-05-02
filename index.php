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
    <title>Dhothar International | Dashboard</title>
    <link rel="stylesheet" href="<?= $base_url ?>assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"
        id="style-resource-1">
    <link rel="stylesheet" href="<?= $base_url ?>assets/css/font-icons/entypo/css/entypo.css" id="style-resource-2">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic"
        id="style-resource-3">
    <link rel="stylesheet" href="<?= $base_url ?>assets/css/bootstrap.css" id="style-resource-4">
    <link rel="stylesheet" href="<?= $base_url ?>assets/css/neon-core.css" id="style-resource-5">
    <link rel="stylesheet" href="<?= $base_url ?>assets/css/neon-theme.css" id="style-resource-6">
    <link rel="stylesheet" href="<?= $base_url ?>assets/css/neon-forms.css" id="style-resource-7">
    <link rel="stylesheet" href="<?= $base_url ?>assets/css/custom.css" id="style-resource-8">

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


            <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <div class="tile-stats tile-red">
                        <div class="icon"><i class="entypo-users"></i></div>
                        <div class="num" data-start="0" data-end="4" data-postfix="" data-duration="1500"
                            data-delay="0">
                            4 </div>
                        <h3>Todays Tickets</h3>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="tile-stats tile-green">
                        <div class="icon"><i class="entypo-chart-bar"></i></div>
                        <div class="num" data-start="0" data-end="96000" data-postfix="" data-duration="1500"
                            data-delay="600">96000</div>
                        <h3>Todays Revenue</h3>
                    </div>
                </div>
                <div class="clear visible-xs"></div>
                <div class="col-sm-3 col-xs-6">
                    <div class="tile-stats tile-aqua">
                        <div class="icon"><i class="entypo-mail"></i></div>
                        <div class="num" data-start="0" data-end="5" data-postfix="" data-duration="1500"
                            data-delay="1200">5</div>
                        <h3>Pending Tickets</h3>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="tile-stats tile-blue">
                        <div class="icon"><i class="entypo-rss"></i></div>
                        <div class="num" data-start="0" data-end="3" data-postfix="" data-duration="1500"
                            data-delay="1800">3</div>
                        <h3>Failed Payments</h3>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-6">
                    <div class="tile-stats tile-aqua">
                        <div class="icon"><i class="entypo-mail"></i></div>
                        <div class="num" data-postfix="" data-duration="1500" data-delay="1200">Dubai To London</div>
                        <h3>Top Route</h3>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-6">
                    <div class="tile-stats tile-red">
                        <div class="icon"><i class="entypo-chart-bar"></i></div>
                        <div class="num" data-start="0" data-end="3" data-postfix="" data-duration="1500"
                            data-delay="600">3</div>
                        <h3>Refunds Today</h3>
                    </div>
                </div>
            </div>

            <hr>
            <br>
            <br>

            <div class="row">
                <div class="col-12 col-lg-6 col-xl-6 d-flex">
                    <div class="card radius-10 overflow-hidden w-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <form action="index_search" method="post">

                                    <table class="table-1">
                                        <tr>
                                            <td><select class='form-control' name="date" required>
                                                    <option value=''>Select</option>
                                                    <option value="2026-02-14/2026-02-14">Today</option>
                                                    <option value="2026-02-13/2026-02-13">Yesterday</option>
                                                    <option value="2026-02-08/2026-02-14">Last 7 Days</option>
                                                    <option value="2026-02-01/2026-02-28">This Month</option>
                                                    <option value="2026-01-01/2026-01-31">Last Month</option>
                                                    <option value="2026-01-01/2026-12-31">This Year</option>
                                                    <option value="2025-01-01/2025-12-31">Last Year</option>
                                                    <option value="1969-12-31/2026-12-31">All Time</option>
                                                </select>
                                            </td>
                                            <td> <input type="submit" name="date_select" value="search" id=""
                                                    class="form-control">

                                            </td>
                                        </tr>
                                    </table>


                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6 col-xl-6 d-flex">
                    <div class="card radius-10 overflow-hidden w-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">


                                <form action="index_search" method="post">

                                    <table class="table-2">
                                        <tr>
                                            <td> <input type='date' name='date1' class='form-control' value="" />
                                            </td>
                                            <td> <input type='date' name='date2' class='form-control' value="" />

                                            </td>
                                            <td>
                                                <input type="submit" name="date_range" value="search" id=""
                                                    class="form-control">

                                            </td>
                                        </tr>
                                    </table>



                                    <!--<input type='date' name='date1' class='form-control' value=""   />-->
                                    <!--  	<input type='date' name='date2' class='form-control' value=""   />-->
                                    <!--  <input type="submit" name="date_range" value="search" id="" class="form-control">-->




                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <br>
            <br>

            <hr>


            <div class="row">
                <div class="col-12 col-lg-6 col-xl-6 d-flex">
                    <div class="card radius-10 overflow-hidden w-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Date Wise Entry Graph</h6>
                                </div>
                                <div class="font-22 ms-auto text-white"><i class="bx bx-dots-horizontal-rounded"></i>
                                </div>
                            </div>

                            <canvas id="myChart"></canvas>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        </script>

                    </div>
                </div>

                <div class="col-12 col-lg-6 col-xl-6 d-flex">
                    <div class="card radius-10 overflow-hidden w-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Status Wise Data</h6>
                                </div>
                                <div class="font-22 ms-auto text-white"><i class="bx bx-dots-horizontal-rounded"></i>
                                </div>
                            </div>
                            <div>

                                <canvas id="myChart2"></canvas>
                            </div>

                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>  // === include 'setup' then 'config' above ===
                            Chart.defaults.color = "black";
                            //   Chart.defaults.backgroundcolor = "re";

                            const ctx = document.getElementById('myChart');
                            const ctx2 = document.getElementById('myChart2');

                            const myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: [
                                        "2025-02-01", "2025-02-05", "2025-02-06", "2025-02-11",
                                        "2025-02-12", "2025-02-17", "2025-02-19", "2025-02-24",
                                        "2025-02-26", "2025-02-27", "2025-02-28", "2026-02-02",
                                        "2026-02-05", "2026-02-06", "2026-02-09", "2026-02-10",
                                        "2026-02-11", "2026-02-12", "2026-02-13"
                                    ],
                                    datasets: [{
                                        label: 'Entry by Date',
                                        data: [
                                            4, 4, 1, 1, 1, 8, 1, 11, 4, 2,
                                            2, 8, 1, 3, 1, 2, 1, 4, 1
                                        ],
                                        borderColor: '#0d6efd',
                                        backgroundColor: 'rgba(13,110,253,0.2)',
                                        fill: true,
                                        borderWidth: 2,
                                        tension: 0.4
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            labels: {
                                                color: "black"
                                            }
                                        }
                                    },
                                    scales: {
                                        x: {
                                            ticks: {
                                                color: "black"
                                            }
                                        },
                                        y: {
                                            ticks: {
                                                color: "black"
                                            }
                                        }
                                    }
                                }
                            });

                            const myChart2 = new Chart(ctx2, {
                                type: 'bar',
                                data: {
                                    labels: ["Today’s tickets count", "Today’s revenue", "Pending tickets", "Failed payments", "Refunds today",],
                                    datasets: [{
                                        label: 'Status by Category',
                                        data: ["12", "96", "5", "3", "3",],


                                        backgroundColor: [
                                            '#28a745',
                                            '#dc3545',
                                            '#ffc107',
                                            '#0dcaf0'
                                        ],
                                        borderColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(255, 159, 64)',
                                            'rgb(255, 205, 86)',
                                            'rgb(75, 192, 192)',
                                            'rgb(54, 162, 235)',
                                            'rgb(153, 102, 255)',
                                            'rgb(201, 203, 207)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                            });
                        </script>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    </div>
                </div>
            </div><!--End Row-->




            <br />


            <footer class="main">
                &copy; <strong>Dhothar International</strong>
            </footer>

        </div>



    </div>

    
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



</body>

</html>