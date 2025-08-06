<?php
include 'config.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center">📊 Document Logs Dashboard</h2>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Documents</h5>
                        <p class="card-text fs-3">
                            <?php
                            $res = $conn->query("SELECT COUNT(*) as total FROM document_logs");
                            echo $res->fetch_assoc()['total'];
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Unique Petitioners</h5>
                        <p class="card-text fs-3">
                            <?php
                            $res = $conn->query("SELECT COUNT(DISTINCT petitioner) as total FROM document_logs");
                            echo $res->fetch_assoc()['total'];
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Documents This Month</h5>
                        <p class="card-text fs-3">
                            <?php
                            $res = $conn->query("SELECT COUNT(*) as total FROM document_logs WHERE MONTH(scanned_at) = MONTH(CURDATE()) AND YEAR(scanned_at) = YEAR(CURDATE())");
                            echo $res->fetch_assoc()['total'];
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="mt-5">📈 Charts Overview</h4>
        <div class="row">
            <div class="col-md-6">
                <canvas id="sectionChart"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="actionChart"></canvas>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <canvas id="statusChart"></canvas>
            </div>
        </div>

        <?php
        // Chart data preparation
        $sections = [];
        $section_counts = [];
        $res = $conn->query("SELECT section, COUNT(*) as count FROM document_logs GROUP BY section");
        while ($row = $res->fetch_assoc()) {
            $sections[] = $row['section'];
            $section_counts[] = $row['count'];
        }

        $actions = [];
        $action_counts = [];
        $res = $conn->query("SELECT action_taken, COUNT(*) as count FROM document_logs GROUP BY action_taken");
        while ($row = $res->fetch_assoc()) {
            $actions[] = $row['action_taken'];
            $action_counts[] = $row['count'];
        }

        $statuses = [];
        $status_counts = [];
        $res = $conn->query("SELECT status, COUNT(*) as count FROM document_logs GROUP BY status");
        while ($row = $res->fetch_assoc()) {
            $statuses[] = $row['status'];
            $status_counts[] = $row['count'];
        }
        ?>
    </div>

    <script>
        const sectionCtx = document.getElementById('sectionChart');
        new Chart(sectionCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($sections) ?>,
                datasets: [{
                    label: 'Documents per Section',
                    data: <?= json_encode($section_counts) ?>,
                    backgroundColor: '#36a2eb'
                }]
            }
        });

        const actionCtx = document.getElementById('actionChart');
        new Chart(actionCtx, {
            type: 'pie',
            data: {
                labels: <?= json_encode($actions) ?>,
                datasets: [{
                    label: 'Action Taken Count',
                    data: <?= json_encode($action_counts) ?>,
                    backgroundColor: [
                        '#4caf50', '#f44336', '#2196f3', '#ffc107', '#9c27b0', '#00bcd4'
                    ]
                }]
            }
        });

        const statusCtx = document.getElementById('statusChart');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($statuses) ?>,
                datasets: [{
                    label: 'Status Summary',
                    data: <?= json_encode($status_counts) ?>,
                    backgroundColor: [
                        '#8e44ad', '#3498db', '#2ecc71', '#f39c12', '#e74c3c'
                    ]
                }]
            }
        });
    </script>

</body>

</html>