<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include '../conn.php'; ?>
    <?php include 'nav.php'; ?>

    <?php
    // ตรวจสอบ session ว่ามีผู้ใช้ล็อกอินหรือไม่
    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit();
    }

    $username = $_SESSION['username'];
    $sql = "SELECT * FROM user_tb WHERE uname = '$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
    ?>
    <br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 style="text-align: center;">ข้อมูลผู้ใช้</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>ชื่อ:</strong> <?php echo $row['fname']; ?></p>
                        <p><strong>นามสกุล:</strong> <?php echo $row['lname']; ?></p>
                        <p><strong>อีเมล:</strong> <?php echo $row['mail']; ?></p>
                        <p><strong>เบอร์โทรศัพท์:</strong> <?php echo $row['tel']; ?></p>
                        <p><strong>ชื่อผู้ใช้:</strong> <?php echo $row['uname']; ?></p>
                        <a href="profile_edit.php" class="btn btn-primary">แก้ไขข้อมูล</a>
                        <a href="main.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
