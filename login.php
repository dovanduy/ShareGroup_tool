<?php
include "config.php";

if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['title'] = "Đăng nhập";

if (isset($_POST['login'])) {
    include "include/Connection.php";
    $conn = getConnection();

    $user = $_POST['user'];
    $user = str_replace("'", "", $user);
    $user = str_replace('"', "", $user);
    $pass = ($_POST['pass']);
    $query = mysqli_query($conn,"SELECT * FROM `user` WHERE `user`='$user' AND `pass`='$pass'");

    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $current_ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $current_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $current_ip = $_SERVER['REMOTE_ADDR'];
    }

    $result = mysqli_num_rows($query);

    if ($result == 0) {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Đăng nhập thất bại","Mật khẩu hoặc tài khoản không đúng", "warning");';
        echo '}, 100);</script>';
    } else{
        $row = mysqli_fetch_assoc($query);
        if ($row['ip_address'] == null || $row['ip_address'] == $current_ip){
            $_SESSION['username'] = $user;
            $_SESSION['password'] = $pass;
            if ($user == 'admin' || $_SESSION['auth'] == 1) {
                $_SESSION['auth'] = 1;
            }else{
                mysqli_query($conn,"UPDATE `user` SET `ip_address` = '".$current_ip."' WHERE `id` = '". $row['id']."'");
            }
            header('location: index.php');
        }
    }
}
?>

<?php include "layout/header.php"; ?>

<!--Main Navigation-->
<body style="background: url('public/lib/images/background-blur-clean-531880.jpg')">
<div class="container-fluid" style="height: 639px;">
    <div style="border: 2px solid #00dfff;border-radius: 10px;width: 50%;margin: 0 auto; color: white;margin-top: 10%;">
        <br><br>
        <h2 align="center" style="font-size:40px;text-shadow: 2px 2px #000101;font-weight: bold">Đăng nhập</h2>
        <br>
        <form class="form-horizontal" method="post" style="width:80%;margin: 0 auto">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Tài khoản:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="user" id="email" placeholder="Nhập tài khoản">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Mật khẩu:</label>
                <div class="col-sm-12">
                    <input type="password" name="pass" class="form-control" id="pwd" placeholder="Nhập mật khẩu">
                </div>
            </div>
            <!--            <div class="form-group">-->
            <!--                <div class="col-sm-offset-2 col-sm-10">-->
            <!--                    <div class="checkbox">-->
            <!--                        <label><input type="checkbox"> Remember me</label>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <center>
                <!--               <input type="hidden" name="login" value="login" >-->
                <button type="submit" name="login" class="btn btn-default">Đăng nhập</button>
            </center>
        </form>
        <br><br>
    </div>
    <br><br>
</div>
</body>
<footer class="page-footer font-medium blue fixed-bottom" style="padding: 0">
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3" style="color: white">
        © 2018 Copyright: Quang Thien - Design and Developed by PN Team.
    </div>
    <!-- Copyright -->
</footer>
<!--/.Footer-->
<script type="text/javascript" src="<?php echo PATH; ?>/public/lib/reactjs/react.production.min.js"></script>
<script type="text/javascript" src="<?php echo PATH; ?>/public/lib/reactjs/react-dom.production.min.js"></script>
<script type="text/javascript" src="<?php echo PATH; ?>/public/lib/reactjs/babel.min.js"></script>

<script type="text/javascript" src="<?php echo PATH; ?>/public/lib/mdb/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo PATH; ?>/public/lib/mdb/js/popper.min.js"></script>
<script src="<?php echo PATH; ?>/public/lib/mdb/js/bootstrap.min.js"></script>
<script src="<?php echo PATH; ?>/public/mdb/js/mdb.min.js"></script
<script type="text/babel" src="<?php echo PATH; ?>/public/js/main.js"></script>
<script type="text/javascript" src="<?php echo PATH; ?>/public/lib/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo PATH; ?>/public/js/javascript.js"></script>

</body>
</html>


