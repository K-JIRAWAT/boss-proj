<?php
session_start(); // เริ่มใช้งาน Session
include 'nav.php';
include '../conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <br><br>
    <div class="container mt-5">
        <h2>Add New Data</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Data</button>
        </form>
    </div>
</body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $stock = $_POST["stock"];

    $currentDateTime = date("Y-m-d H:i:s"); // แสดงวันที่และเวลาปัจจุบันในรูปแบบ Y-m-d H:i:s

    $username= $_SESSION['username'];

    $sql = "INSERT INTO equipment_tb (name, stock, create_by, create_at) VALUES ('$name', '$stock', '$username', '$currentDateTime')";
    

    if ($conn->query($sql) === TRUE) {
        // echo "New record created successfully";
        echo "<script> window.location.href = 'main.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

</html>