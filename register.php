<?php
include 'conn.php';

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mail = $_POST["mail"];
    $tel = $_POST["tel"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // ตรวจสอบว่ารหัสผ่านตรงกัน
    if ($password !== $confirm_password) {
        $error_message = "รหัสผ่านไม่ตรงกัน";
    } else {
        // ตรวจสอบว่าชื่อผู้ใช้ซ้ำหรือไม่
        $check_query = "SELECT * FROM user_tb WHERE uname = '$username'";
        $check_result = $conn->query($check_query);
        if ($check_result->num_rows > 0) {
            $error_message = "ชื่อผู้ใช้ซ้ำ";
        } else {
            // ทำการเพิ่มข้อมูลผู้ใช้ใหม่ลงในฐานข้อมูล
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user_tb (fname, lname, mail, tel, uname, password) VALUES ('$fname', '$lname', '$mail', '$tel', '$username', '$hashed_password')";
            if ($conn->query($sql) === TRUE) {
                echo '<script>window.location.href = "index.php";</script>';
            } else {
                $error_message = "เกิดข้อผิดพลาดในการลงทะเบียน: " . $conn->error;
            }
        }
    }
} 


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card pic">
                    <div class="card-header">
                        <h4 style="text-align: center;">ลงทะเบียนบัญชีผู้ใช้</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($error_message !== '') : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>
                        <form action="" method="POST">
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="fname" class="form-label">ชื่อ</label>
                                    <input type="text" class="form-control" id="fname" name="fname" required>
                                </div>
                                <div class="col">
                                    <label for="lname" class="form-label">นามสกุล</label>
                                    <input type="text" class="form-control" id="lname" name="lname" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="mail" class="form-label">อีเมลล์</label>
                                    <input type="email" class="form-control" id="mail" name="mail" required>
                                </div>
                                <div class="col">
                                    <label for="tel" class="form-label">เบอร์โทร</label>
                                    <input type="tel" class="form-control" id="tel" name="tel" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">ยืนยัน Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                            <a href="index.php" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
        function success() {
            Swal.fire({
                icon: "sucess",
                title: "คุณต้องการลบข้อมูลนี้ใช่หรือไม่?",
            }).then((result) => {
                    window.location.href = 'index.php';
            });
        }
    </script>
</html>




<style>
    body {
        background: rgb(238, 174, 202);
        background: radial-gradient(circle, rgba(238, 174, 202, 1) 0%, rgba(148, 187, 233, 1) 100%);
        /* คุณสามารถปรับแต่งขนาดและตำแหน่งของวงกลมและสีได้ตามต้องการ */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 70vh;
        /* ให้เต็มสูงของ viewport */
        margin: 0;
    }

    .pic {
        -webkit-transition: all 300ms ease;
        transition: all 300ms ease;
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.10), 0 1px 1px 0 rgba(0, 0, 0, 0.09);
    }

    .pic:hover {
        transform: translateY(5px);
        box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
        opacity: 1;
    }

    .custom-alert {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .alert-content {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
    }
</style>