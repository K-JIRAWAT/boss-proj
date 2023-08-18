<!DOCTYPE html>
<html lang="en">
<?php
session_start(); // เริ่มใช้งาน Session
include 'conn.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="style.css">

</head>


<body>

    <!-- <div id="customAlert" class="custom-alert">
        <div class="alert-content">
            <p id="alertText">login สำเร็จ!</p>
            <button onclick="closeCustomAlert()">ปิด</button>
        </div>
    </div> -->

    <div id="customAlert" class="custom-alert alert alert-success">
        <div class="alert-content">
            <p id="alertText">Login สำเร็จ!</p>
            <button onclick="closeCustomAlert()" class="btn btn-success">ปิด</button>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card pic">
                    <div class="card-header">
                        <h4 style="text-align: center;">กรุณา login เข้าสู้ระบบ</h4>
                    </div>
                    <div class="card-body">
                        <form onclick="login()" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input autocomplete="off" type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input autocomplete="off" type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button style="float: center;" type="submit" class="btn btn-success">Login</button>
                        </form>
                        <div class="mt-3">
                            <p>ยังไม่มีบัญชีผู้ใช้? <a href="register.php">ลงทะเบียน</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function showAlert(text) {
        alert(text);
    }

    function showCustomAlert() {
        var customAlert = document.getElementById("customAlert");
        customAlert.style.display = "flex";
    }

    function closeCustomAlert() {
        var customAlert = document.getElementById("customAlert");
        customAlert.style.display = "none";
    }
</script>
<?php
function login($username, $password, $conn)
{
    // ค้นหาชื่อผู้ใช้และรหัสผ่านในฐานข้อมูล
    $sql = "SELECT * FROM user_tb WHERE uname = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc(); // เรียกใช้ fetch_assoc() เพื่อดึงข้อมูลแถวจากผลลัพธ์

        if ($row['status'] == 3) {
            $_SESSION['username'] = $username;
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['lname'] = $row['lname'];
            header("Location: admin/main.php");
        } else {
            header("Location: user/main.php");
        }
    } else {
        echo '<script>
              Swal.fire({
                  icon: "error",
                  title: "ไม่พบข้อมูลผู้ใช้",
                  text: "กรุณาตรวจสอบชื่อผู้ใช้และรหัสผ่านอีกครั้ง",
                  confirmButtonText: "ตกลง"
              }).then((result) => {
                
              });
          </script>';
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    login($username, $password, $conn);
}
?>


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