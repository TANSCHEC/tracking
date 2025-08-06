<?php
$conn = new mysqli("localhost", "root", "", "tansche_tracking");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
