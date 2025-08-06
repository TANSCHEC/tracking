<?php
// Make sure the path is correct
include __DIR__ . "/phpqrcode-master/qrlib.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Form with QR Code</title>
</head>

<body>
    <h2>Enter Your Details</h2>
    <form method="POST">
        Name: <input type="text" name="name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Phone: <input type="text" name="phone" required><br><br>
        <button type="submit" name="generate">Generate QR Code</button>
    </form>

    <?php
    if (isset($_POST['generate'])) {
        $name  = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $qrData = "Name: $name\nEmail: $email\nPhone: $phone";
        $fileName = "qrcode_" . time() . ".png";

        QRcode::png($qrData, $fileName, QR_ECLEVEL_L, 4);

        echo "<h3>Entered Data:</h3>";
        echo "Name: $name<br>Email: $email<br>Phone: $phone<br><br>";
        echo "<h3>Your QR Code:</h3>";
        echo "<img src='$fileName'>";
    }
    ?>
</body>

</html>

<!-- 
<?php
// Include QR Code library
include "phpqrcode-master\qrlib.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>Form with QR Code</title>
</head>

<body>
    <h2>Enter Your Details</h2>
    <form method="POST">
        Name: <input type="text" name="name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Phone: <input type="text" name="phone" required><br><br>
        <button type="submit" name="generate">Generate QR Code</button>
    </form>

    <?php
    if (isset($_POST['generate'])) {
        // Get form data
        $name  = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // Prepare data for QR code
        $qrData = "Name: $name\nEmail: $email\nPhone: $phone";

        // QR Code file name
        $fileName = "qrcode_" . time() . ".png";

        // Generate QR code
        QRcode::png($qrData, $fileName, QR_ECLEVEL_L, 4);

        // Show entered data
        echo "<h3>Entered Data:</h3>";
        echo "Name: $name<br>Email: $email<br>Phone: $phone<br><br>";

        // Display QR code
        echo "<h3>Your QR Code:</h3>";
        echo "<img src='$fileName'>";
    }
    ?>
</body>

</html> 