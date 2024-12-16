<?php
session_start();
error_reporting(0);
include('admin/config.php');

if (strlen($_SESSION['login']) == 0) {	
    header('location:login.php'); // Redirect to login if not logged in
    exit();
} 
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#3e454c">
    
    <title>Car Rental Portal | Admin Dashboard</title>

    <!-- CSS Links -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php include('admin/leftbar.php'); ?>

<div class="ts-main-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Dashboard</h2>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-body bk-primary text-light">
                                    <div class="stat-panel text-center">
                                        <?php 
                                        $sql = "SELECT id FROM tblusers";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $regusers = $query->rowCount();
                                        ?>
                                        <div class="stat-panel-number h1"><?php echo htmlentities($regusers); ?></div>
                                        <div class="stat-panel-title text-uppercase">Registered Users</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-body bk-success text-light">
                                    <div class="stat-panel text-center">
                                        <?php 
                                        $sql1 = "SELECT id FROM tblvehicles";
                                        $query1 = $dbh->prepare($sql1);
                                        $query1->execute();
                                        $totalvehicle = $query1->rowCount();
                                        ?>
                                        <div class="stat-panel-number h1"><?php echo htmlentities($totalvehicle); ?></div>
                                        <div class="stat-panel-title text-uppercase">Listed Vehicles</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-body bk-info text-light">
                                    <div class="stat-panel text-center">
                                        <?php 
                                        $sql2 = "SELECT id FROM tblbooking";
                                        $query2 = $dbh->prepare($sql2);
                                        $query2->execute();
                                        $bookings = $query2->rowCount();
                                        ?>
                                        <div class="stat-panel-number h1"><?php echo htmlentities($bookings); ?></div>
                                        <div class="stat-panel-title text-uppercase">Total Bookings</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-body bk-warning text-light">
                                    <div class="stat-panel text-center">
                                        <?php 
                                        $sql3 = "SELECT id FROM tblbrands";
                                        $query3 = $dbh->prepare($sql3);
                                        $query3->execute();
                                        $brands = $query3->rowCount();
                                        ?>												
                                        <div class="stat-panel-number h1"><?php echo htmlentities($brands); ?></div>
                                        <div class="stat-panel-title text-uppercase">Listed Brands</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="page-title">Listed Vehicles</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Car Name</th>
                                            <th>Price</th>
                                            <th>Price per Day</th>
                                            <th>Availability</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetching vehicles
                                        $sql4 = "SELECT * FROM tblvehicles";
                                        $query4 = $dbh->prepare($sql4);
                                        $query4->execute();
                                        $vehicles = $query4->fetchAll(PDO::FETCH_ASSOC);
                                        if ($query4->rowCount() > 0) {
                                            foreach ($vehicles as $index => $vehicle) {
                                                echo '<tr>';
                                                echo '<td>' . ($index + 1) . '</td>';
                                                echo '<td>' . htmlentities($vehicle['car_name']) . '</td>';
                                                echo '<td>$' . htmlentities($vehicle['price']) . '</td>';
                                                echo '<td>$' . htmlentities($vehicle['price_per_day']) . '</td>';
                                                echo '<td>' . htmlentities($vehicle['availability']) . '</td>';
                                                echo '<td><img src="' . htmlentities($vehicle['image_path']) . '" alt="Image" style="width: 100px; height: auto;"></td>';
                                                echo '</tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="6">No vehicles found</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Loading Scripts -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>