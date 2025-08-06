<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TANSCHE File Movement Tracking System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            height: 100vh;
            background-color: #343a40;
        }

        .sidebar a {
            color: white;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            padding: 20px;
        }

        .sidebar h4 {
            color: #f8f9fa;
            padding: 15px 20px;
            margin-bottom: 0;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <h4>📁 Tracking System</h4>
                <a href="ad1.php">➕ Add Document & QR</a>
                <a href="scan1.php">📷 Scan QR / Add Action</a>
                <a href="track1.php">🔍 Track Document</a>
                <a href="documents_crud1.php">📂 Manage Documents (CRUD)</a>
                <a href="logs_crud2.php">📝 Manage Logs (CRUD)</a>
                <a href="ls1.php">📝 Search Petitioner/DR.NO </a>
                <a href="dashboard11.php">📊 Dashboard</a>
                <a href="#">📊 Dashboard Charts</a>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 content">
                <!-- <h2>Welcome to TANSCHE File Tracking System</h2>
                <p>This system helps monitor official file movement across TANSCHE sections: Despatch, MS, A-Section, B-Section, VC, and Accounts.</p>

                <ul>
                    <li><strong>Generate QR:</strong> Use <em>Add Document</em> to register files and generate QR codes.</li>
                    <li><strong>Track Actions:</strong> Scan the QR and log actions per section.</li>
                    <li><strong>Dashboard:</strong> View movement analytics and recent actions.</li>
                </ul> -->
                <?php include "dashboard1.php" ?>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>