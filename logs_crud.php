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
        <h2 class="mb-4">📝 Document Log Entry with Petition Details</h2>

        <!-- Log Entry Form -->
        <form method="post" class="row g-3 mb-4 bg-white p-4 rounded shadow-sm">

            <div class="col-md-3">
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

            <div class="col-md-3">
                <label class="form-label">Action Taken</label>
                <input type="text" name="action_taken" class="form-control" required>
            </div>

            <!-- New Fields -->
            <div class="col-md-3">
                <label class="form-label">Degree</label>
                <input type="text" name="degree" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">University (Equivalent)</label>
                <input type="text" name="university_equivalent" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Petitioner</label>
                <input type="text" name="petitioner" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Letter Date</label>
                <input type="date" name="letter_date" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Board</label>
                <input type="text" name="board" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Letter Received Date</label>
                <input type="date" name="letter_received" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Status</label>
                <input type="text" name="status" class="form-control" placeholder="Pending / Completed">
            </div>

            <div class="col-md-3">
                <label class="form-label">Petition Type</label>
                <input type="text" name="petition_type" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">Mobile</label>
                <input type="text" name="mobile" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">Letter Ref No</label>
                <input type="text" name="letter_ref" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">GO Number</label>
                <input type="text" name="go_no" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">GO Date</label>
                <input type="date" name="go_date" class="form-control">
            </div>

            <div class="col-12 text-end">
                <button name="log" class="btn btn-primary">➕ Add Log Entry</button>
            </div>
        </form>

        <?php
        if (isset($_POST['log'])) {
            $fields = [
                'dr_no',
                'section',
                'action_taken',
                'action_period',
                'degree',
                'university_equivalent',
                'petitioner',
                'letter_date',
                'board',
                'letter_received',
                'status',
                'petition_type',
                'email',
                'mobile',
                'letter_ref',
                'go_no',
                'go_date'
            ];

            $values = [];
            foreach ($fields as $field) {
                $values[$field] = $conn->real_escape_string($_POST[$field] ?? '');
            }

            $sql = "INSERT INTO document_logs 
              (dr_no, section, action_taken, action_period, degree, university_equivalent, petitioner, letter_date, board, letter_received, status, petition_type, email, mobile, letter_ref, go_no, go_date)
              VALUES (
                  '{$values['dr_no']}', '{$values['section']}', '{$values['action_taken']}', '{$values['action_period']}',
                  '{$values['degree']}', '{$values['university_equivalent']}', '{$values['petitioner']}', '{$values['letter_date']}',
                  '{$values['board']}', '{$values['letter_received']}', '{$values['status']}', '{$values['petition_type']}',
                  '{$values['email']}', '{$values['mobile']}', '{$values['letter_ref']}', '{$values['go_no']}', '{$values['go_date']}'
              )";
            $conn->query($sql);
            echo "<div class='alert alert-success'>✅ Log entry added with petition details.</div>";
        }

        if (isset($_GET['delete'])) {
            $id = intval($_GET['delete']);
            $conn->query("DELETE FROM document_logs WHERE id = $id");
            echo "<div class='alert alert-danger'>🗑️ Entry deleted.</div>";
        }
        ?>

        <!-- Logs Table -->
        <h4 class="mt-5 mb-3">📋 Log History</h4>
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
                        <th>Letter Date</th>
                        <th>Status</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>GO No</th>
                        <th>GO Date</th>
                        <th>Date</th>
                        <th>Delete</th>
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
              <td>{$row['petitioner']}</td>
              <td>{$row['degree']}</td>
              <td>{$row['university_equivalent']}</td>
              <td>{$row['letter_date']}</td>
              <td>{$row['status']}</td>
              <td>{$row['email']}</td>
              <td>{$row['mobile']}</td>
              <td>{$row['go_no']}</td>
              <td>{$row['go_date']}</td>
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