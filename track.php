<?php include 'config.php'; ?>
<form method="get">
    Enter DR.NO to Track: <input type="text" name="dr_no" required>
    <button type="submit">Track</button>
</form>

<?php
if (isset($_GET['dr_no'])) {
    $dr_no = $_GET['dr_no'];
    $result = $conn->query("SELECT * FROM document_logs WHERE dr_no='$dr_no' ORDER BY scanned_at ASC");

    echo "<h3>Tracking for DR.NO: $dr_no</h3>";
    echo "<table border='1'><tr><th>Section</th><th>Action Taken</th><th>Period</th><th>Date</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "
           <tr>
            <td>{$row['section']}</td>
            <td>{$row['action_taken']}</td>
            <td>{$row['action_period']}</td>
            <td>{$row['scanned_at']}</td>
          </tr>";
    }
    echo "</table>";
}
?>