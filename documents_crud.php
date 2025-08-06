<?php include 'config.php'; ?>

<h2>📁 Documents Management</h2>
<form method="post">
    Title: <input type="text" name="title" required>
    <button name="add">Add Document</button>
</form>

<?php
if (isset($_POST['add'])) {
    $dr_no = 'DR' . time();
    $title = $_POST['title'];
    $conn->query("INSERT INTO documents (dr_no, title, origin_section) VALUES ('$dr_no', '$title', 'Despatch')");
    echo "<p>Document Added. DR.NO = $dr_no</p>";
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM documents WHERE id=$id");
    echo "<p>Document Deleted</p>";
}

// List
$res = $conn->query("SELECT * FROM documents ORDER BY id DESC");
echo "<table border='1'><tr><th>ID</th><th>DR.NO</th><th>Title</th><th>Origin</th><th>Action</th></tr>";
while ($row = $res->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['dr_no']}</td>
        <td>{$row['title']}</td>
        <td>{$row['origin_section']}</td>
        <td><a href='?delete={$row['id']}'>Delete</a></td>
    </tr>";
}
echo "</table>";
?>