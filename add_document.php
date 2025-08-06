<?php include 'config.php'; ?>
<form method="post">
    Title: <input type="text" name="title" required>
    <button type="submit" name="submit">Add & Generate QR</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $dr_no = 'DR' . time(); // unique ID
    $stmt = $conn->prepare("INSERT INTO documents (dr_no, title, origin_section) VALUES (?, ?, 'Despatch')");
    $stmt->bind_param("ss", $dr_no, $title);
    $stmt->execute();

    // Generate QR using Google Chart API
    echo "<h3>QR Code for DR.NO: $dr_no</h3>";
    echo "<img src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=$dr_no&choe=UTF-8'>";
}
?>