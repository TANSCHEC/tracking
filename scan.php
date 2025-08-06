<?php include 'config.php'; ?>
<form method="post">
    Enter/Scan DR.NO: <input type="text" name="dr_no" required><br><br><br>
    Section:
    <select name="section">
        <option>MS</option>
        <option>A-Section</option>
        <option>B-Section</option>
        <option>VC</option>
        <option>Accounts</option>
    </select> <br><br><br>
    Action Taken: <input type="text" name="action_taken" required> <br><br><br>
    Period (e.g., 2 days): <input type="text" name="action_period" required> <br><br><br>
    <button type="submit" name="log">Log Entry</button> <br><br><br>
</form>

<?php
if (isset($_POST['log'])) {
    $dr_no = $_POST['dr_no'];
    $section = $_POST['section'];
    $action = $_POST['action_taken'];
    $period = $_POST['action_period'];

    $stmt = $conn->prepare("INSERT INTO document_logs (dr_no, section, action_taken, action_period) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $dr_no, $section, $action, $period);
    $stmt->execute();
    echo "<br><br><br>✔️ Entry Logged Successfully!";
}
?>