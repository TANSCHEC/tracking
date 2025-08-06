<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Document Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        label {
            font-weight: 500;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-4">

        <h2 class="mb-3">📝 Document Logs with Petition Details</h2>

        <!-- Search Form -->
        <form method="get" class="row g-2 mb-4 bg-white p-3 rounded shadow-sm">
            <div class="col-md-3">
                <label class="form-label">Search by DR.NO</label>
                <input type="text" name="search_drno" class="form-control" value="<?= $_GET['search_drno'] ?? '' ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label">Search by Petitioner</label>
                <input type="text" name="search_petitioner" class="form-control" value="<?= $_GET['search_petitioner'] ?? '' ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label">Search by Board</label>
                <input type="text" name="search_board" class="form-control" value="<?= $_GET['search_board'] ?? '' ?>">
            </div>
            <div class="col-md-3 align-self-end">
                <button class="btn btn-primary" name="search">🔍 Search</button>
                <a href="logs_crud.php" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <!-- Log Entry Form (unchanged) -->
        <!-- You may keep the previous log entry form here from the last version -->

        <?php
        if (isset($_GET['delete'])) {
            $id = intval($_GET['delete']);
            $conn->query("DELETE FROM document_logs WHERE id = $id");
            echo "<div class='alert alert-danger'>🗑️ Entry deleted.</div>";
        }

        // Build WHERE clause for search
        $where = [];
        if (!empty($_GET['search_drno'])) {
            $dr_no = $conn->real_escape_string($_GET['search_drno']);
            $where[] = "dr_no LIKE '%$dr_no%'";
        }
        if (!empty($_GET['search_petitioner'])) {
            $pet = $conn->real_escape_string($_GET['search_petitioner']);
            $where[] = "petitioner LIKE '%$pet%'";
        }
        if (!empty($_GET['search_board'])) {
            $board = $conn->real_escape_string($_GET['search_board']);
            $where[] = "board LIKE '%$board%'";
        }

        $condition = count($where) ? 'WHERE ' . implode(' AND ', $where) : '';
        $query = "SELECT * FROM document_logs $condition ORDER BY scanned_at DESC LIMIT 100";
        $res = $conn->query($query);
        ?>

        <!-- Display Filtered Logs -->
        <h4 class="mt-4 mb-3">📋 Filtered Log Records</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-sm table-hover bg-white">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>DR.NO</th>
                        <th>Section</th>
                        <th>Action</th>
                        <th>Period</th>
                        <th>Petitioner</th>
                        <th>Degree</th>
                        <th>University</th>
                        <th>Board</th>
                        <th>Status</th>
                        <th>GO No</th>
                        <th>GO Date</th>
                        <th>Date</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($res->num_rows > 0) {
                        while ($row = $res->fetch_assoc()) {
                            echo "<tr>
                  <td>{$row['id']}</td>
                  <td>{$row['dr_no']}</td>
                  <td>{$row['section']}</td>
                  <td>{$row['action_taken']}</td>
                  <td>{$row['action_period']}</td>
                  <td>{$row['petitioner']}</td>
                  <td>{$row['degree']}</td>
                  <td>{$row['university_equivalent']}</td>
                  <td>{$row['board']}</td>
                  <td>{$row['status']}</td>
                  <td>{$row['go_no']}</td>
                  <td>{$row['go_date']}</td>
                  <td>{$row['scanned_at']}</td>
                  <td><a href='?delete={$row['id']}' class='btn btn-sm btn-danger'>Delete</a></td>
              </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='14' class='text-center text-muted'>No records found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>