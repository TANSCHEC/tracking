<?php include 'config.php'; ?>
<h2>📊 Document Dashboard</h2>
<!-- Count of documents per section -->
<h3>🗂️ Documents Handled by Each Section</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>Section</th>
        <th>Documents Handled</th>
    </tr>
    <?php
    $sections = ['Despatch', 'MS', 'A-Section', 'B-Section', 'VC', 'Accounts'];
    foreach ($sections as $section) {
        $res = $conn->query("SELECT COUNT(*) as count FROM document_logs WHERE section = '$section'");
        $count = $res->fetch_assoc()['count'];
        echo "<tr><td>$section</td><td>$count</td></tr>";
    }
    ?>
</table>
<!-- Recent actions taken -->
<h3>📌 Recent Actions Taken</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>DR.NO</th>
        <th>Section</th>
        <th>Action</th>
        <th>Period</th>
        <th>Date</th>
    </tr>
    <?php
    $res = $conn->query("SELECT * FROM document_logs ORDER BY scanned_at DESC LIMIT 10");
    while ($row = $res->fetch_assoc()) {
        echo "<tr>
        <td>{$row['dr_no']}</td>
        <td>{$row['section']}</td>
        <td>{$row['action_taken']}</td>
        <td>{$row['action_period']}</td>
        <td>{$row['scanned_at']}</td>
    </tr>";
    }
    ?>
</table>