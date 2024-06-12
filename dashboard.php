<?php
session_start();
if (!isset($_SESSION['Admin-name'])) {
    header("location: login.php");
}

include 'connectDB.php'; // Ensure this path is correct

// Fetch data for the monthly chart
$sql = "SELECT 
            SUM(CASE WHEN card_out = 0 THEN 1 ELSE 0 END) AS present, 
            SUM(CASE WHEN card_out = 1 THEN 1 ELSE 0 END) AS absent 
        FROM users_logs 
        WHERE MONTH(checkindate) = MONTH(CURRENT_DATE) 
        AND YEAR(checkindate) = YEAR(CURRENT_DATE)";
$result = $conn->query($sql);
$monthlyData = $result->fetch_assoc();

// Fetch data for the daily chart
$sql = "SELECT 
            SUM(CASE WHEN card_out = 0 THEN 1 ELSE 0 END) AS present, 
            SUM(CASE WHEN card_out = 1 THEN 1 ELSE 0 END) AS absent 
        FROM users_logs 
        WHERE DATE(checkindate) = CURDATE()";
$result = $conn->query($sql);
$dailyData = $result->fetch_assoc();

// Fetch data for the yearly chart
$sql = "SELECT 
            MONTH(checkindate) AS month,
            SUM(CASE WHEN card_out = 0 THEN 1 ELSE 0 END) AS present, 
            SUM(CASE WHEN card_out = 1 THEN 1 ELSE 0 END) AS absent 
        FROM users_logs 
        WHERE YEAR(checkindate) = YEAR(CURRENT_DATE)
        GROUP BY MONTH(checkindate)";
$result = $conn->query($sql);
$yearlyData = array();
while ($row = $result->fetch_assoc()) {
    $yearlyData[] = $row;
}

// Fetch student logs total
$sqlLogsTotal = "SELECT COUNT(*) as logs_total FROM users_logs";
$result = $conn->query($sqlLogsTotal);
$logsTotal = ($result->num_rows > 0) ? $result->fetch_assoc()['logs_total'] : "No Data";

// Fetch enrolled students total
$sqlEnrolledTotal = "SELECT COUNT(*) as enrolled_total FROM users";
$result = $conn->query($sqlEnrolledTotal);
$enrolledTotal = ($result->num_rows > 0) ? $result->fetch_assoc()['enrolled_total'] : "No Data";

// Fetch present today total
$todayDate = date("Y-m-d");
$sqlPresentToday = "SELECT COUNT(*) as present_today FROM users_logs WHERE checkindate = '$todayDate' AND timeout IS NOT NULL";
$result = $conn->query($sqlPresentToday);
$presentToday = ($result->num_rows > 0) ? $result->fetch_assoc()['present_today'] : "No Data";

// Fetch absent today total
$sqlAbsentToday = "SELECT COUNT(*) as absent_today FROM users WHERE id NOT IN (SELECT id FROM users_logs WHERE checkindate = '$todayDate')";
$result = $conn->query($sqlAbsentToday);
$absentToday = ($result->num_rows > 0) ? $result->fetch_assoc()['absent_today'] : "No Data";

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


</head>
<body>
 
<?php include('header.php'); ?>
<h2 class="slideInDown animated align ="center">Student Dashboard</h2>
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <i class="fas fa-user-clock"></i> 
                <h5 class="card-title">Student Logs Total</h5>
                <p class="card-text" id="student-logs-total"><?php echo $logsTotal; ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <i class="fas fa-users"></i> 
                <h5 class="card-title">Student Enrolled Total</h5>
                <p class="card-text" id="student-enrolled-total"><?php echo $enrolledTotal; ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <i class="fas fa-user-check"></i> 
                <h5 class="card-title">Present Today Total</h5>
                <p class="card-text" id="present-today-total"><?php echo $presentToday; ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <i class="fas fa-user-times"></i>
                <h5 class="card-title">Absent Today Total</h5>
                <p class="card-text" id="absent-today-total"><?php echo $absentToday; ?></p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="barmonth">
        <h1>Attendance for the Month</h1>
        <canvas id="monthlyAttendanceChart" width="400" height="200"></canvas>
    </div>

    <div class="piechart" id = "piechart">
        <h1>Attendance Today</h1>
        <canvas id="dailyAttendanceChart" width="400" height="200"></canvas>
    </div>

    <div class="baryear" id="yearlyAttendanceChartContainer">
        <h1>Attendance for the Year</h1>
        <canvas id="yearlyAttendanceChart" width="800" height="400"></canvas>
    </div>
</div>
<script>
 // Data from PHP
 var monthlyData = <?php echo json_encode($monthlyData); ?>;
    var dailyData = <?php echo json_encode($dailyData); ?>;
    var yearlyData = <?php echo json_encode($yearlyData); ?>;

    // Monthly Attendance Chart
    var ctx = document.getElementById('monthlyAttendanceChart').getContext('2d');
    var monthlyAttendanceChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Present', 'Absent'],
            datasets: [{
                label: 'Attendance for the Month',
                data: [monthlyData.present, monthlyData.absent],
                backgroundColor: ['#42A5F5', '#FF6384']
            }]
        },
        options: {
            scales: {
                y: {
                    min: 1,
                    max: 50,
                    ticks: {
                        stepSize: 5
                    }
                }
            },
            plugins: {
                legend: {
                    display: true
                }
            }
        }
    });

    // Daily Attendance Chart
    var ctx2 = document.getElementById('dailyAttendanceChart').getContext('2d');
    var dailyAttendanceChart = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ['Present', 'Absent'],
            datasets: [{
                label: 'Attendance Today',
                data: [dailyData.present, dailyData.absent],
                backgroundColor: ['#42A5F5', '#FF6384']
            }]
        },
        options: {
            responsive: true
        }
    });

    // Yearly Attendance Chart
    var ctx3 = document.getElementById('yearlyAttendanceChart').getContext('2d');
    var yearlyAttendanceChart = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [
                {
                    label: 'Present',
                    data: yearlyData.map(function(row) { return row.present; }),
                    backgroundColor: '#42A5F5'
                },
                {
                    label: 'Absent',
                    data: yearlyData.map(function(row) { return row.absent; }),
                    backgroundColor: '#FF6384'
                }
            ]
        },
        options: {
            scales: {
                y: {
                    min: 1,
                    max: 50
                }
            }
        }
    });
</script>
</body>
</html>
