<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage File Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <h2 class="mb-4">📝 Manage Document Logs</h2>

        <!-- Log Entry Form -->
        <form method="post" class="row g-3 mb-4 bg-white p-4 rounded shadow-sm">
            <div class="col-md-4">
                <label class="form-label">DR.NO</label>
                <input type="text" name="dr_no" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Section</label>
                <select name="section" class="form-select" required>
                    <option value="">Select Section</option>
                    <option>MS</option>
                    <option>A-Section</option>
                    <option>B-Section</option>
                    <option>VC</option>
                    <option>Accounts</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Action Period</label>
                <input type="text" name="action_period" class="form-control" placeholder="e.g. 2 days" required>
            </div>
            <div class="col-md-12">
                <label class="form-label">Action Taken</label>
                <input type="text" name="action_taken" class="form-control" required>
            </div>
            <div class="col-md-12 text-end">
                <button name="log" class="btn btn-primary">➕ Add Log Entry</button>
            </div>
        </form>

        <?php
        // INSERT LOG
        if (isset($_POST['log'])) {
            $dr_no = $conn->real_escape_string($_POST['dr_no']);
            $section = $_POST['section'];
            $action = $conn->real_escape_string($_POST['action_taken']);
            $period = $_POST['action_period'];

            $conn->query("INSERT INTO document_logs (dr_no, section, action_taken, action_period) 
                    VALUES ('$dr_no', '$section', '$action', '$period')");
            echo "<div class='alert alert-success'>✅ Log Entry Added</div>";
        }

        // DELETE LOG
        if (isset($_GET['delete'])) {
            $id = intval($_GET['delete']);
            $conn->query("DELETE FROM document_logs WHERE id=$id");
            echo "<div class='alert alert-danger'>🗑️ Log Entry Deleted</div>";
        }
        ?>

        <!-- Display Logs Table -->
        <h4 class="mt-5 mb-3">📋 Recent Logs</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>DR.NO</th>
                        <th>Section</th>
                        <th>Action Taken</th>
                        <th>Period</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = $conn->query("SELECT * FROM document_logs ORDER BY scanned_at DESC LIMIT 100");
                    while ($row = $res->fetch_assoc()) {
                        echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['dr_no']}</td>
              <td>{$row['section']}</td>
              <td>{$row['action_taken']}</td>
              <td>{$row['action_period']}</td>
              <td>{$row['scanned_at']}</td>
              <td><a href='?delete={$row['id']}' class='btn btn-sm btn-danger'>Delete</a></td>
          </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>