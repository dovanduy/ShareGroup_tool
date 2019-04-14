<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 12/04/2019
 * Time: 7:08 CH
 */

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])){
    header("location: login.php");
}

include "config.php";
$_SESSION['title'] = "Thông Tin Tài Khoản";

require_once "include/Connection.php";
$conn = getConnection();
if (isset($_SESSION['username'])){
    $query = mysqli_query($conn,"SELECT * FROM `user` WHERE `user` = '".$_SESSION['username']."'");
    if (!$query){
        include "logout.php";
    }
    $row = mysqli_fetch_array($query);
}
include "layout/header.php";
?>

<!--Main Navigation-->
<header>
    <?php
    if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1){
        include "layout/navbar.php";
        $disable = "";
    }else{
        $disable = "disabled";
    }
    include "layout/sidebar.php";
    ?>
</header>
<!--Main Navigation-->

<main id="root" class="pt-5 mx-lg-5">
    <div class="main-content  py-5">
        <!-- Material form register -->
        <div class="card">

            <h5 class="card-header info-color white-text text-center py-4">
                <strong>Thông tin tài khoản</strong>
            </h5>
            <br>
            <!--Card content-->
            <input type="text" value="<?php echo $row['id']?>" id="id" hidden>
            <div class="card-body px-lg-5 pt-0">
                <label for="exampleForm2">Tài khoản</label>
                <input type="text" id="user" name="user" class="form-control" value="<?php echo $row['user']?>" required <?php echo $disable?>>
            </div>
            <div class="card-body px-lg-5 pt-0">
                <label for="exampleForm2">Mật khẩu</label>
                <input type="password" id="password1" name="password1" class="form-control" value="<?php echo $row['pass']?>" required>
            </div>
            <div class="card-body px-lg-5 pt-0">
                <label for="exampleForm2">Nhập lại mật khẩu</label>
                <input type="password" id="password2" name="password2" class="form-control" value="<?php echo $row['pass']?>" required>
            </div>
            <div class="card-body px-lg-5 pt-0">
                <label for="exampleForm2">Tên hiển thị</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $row['name']?>">
            </div>
            <div class="card-body px-lg-5 pt-0">
                <center>
                    <button type="button" class="btn btn-primary" name="change_info_acc" id="change_info_acc">Lưu</button>
                    <a href="<?php echo PATH; ?>/index.php"><button type="button" class="btn btn-light">Đóng</button></a>
                </center>
            </div>
        </div>
        <!-- Material form register -->
    </div>
</main>

<?php
include "layout/footer.php";
?>