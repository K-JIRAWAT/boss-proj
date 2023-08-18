<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <?php
    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $mail = $_POST["mail"];
        $tel = $_POST["tel"];
        $username = $_SESSION['username'];

        $sql = "UPDATE user_tb SET fname = '$fname', lname = '$lname', mail = '$mail', tel = '$tel' WHERE uname = '$username'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>window.location.replace('profile.php');</script>";
        } else {
            $error_message = "เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . $conn->error;
        }
    }
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 style="text-align: center;">อัปเดตข้อมูลผู้ใช้</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($error_message)) {
                            echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
                        }
                        ?>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="fname" class="form-label">ชื่อ</label>
                                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $row['fname']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="lname" class="form-label">นามสกุล</label>
                                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $row['lname']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="mail" class="form-label">อีเมล</label>
                                <input type="email" class="form-control" id="mail" name="mail" value="<?php echo $row['mail']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="tel" class="form-label">เบอร์โทรศัพท์</label>
                                <input type="tel" class="form-control" id="tel" name="tel" value="<?php echo $row['tel']; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                            <a href="profile.php" class="btn btn-secondary">ยกเลิก</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
