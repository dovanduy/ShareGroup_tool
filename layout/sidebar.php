<!-- Sidebar -->
<div class="sidebar-fixed position-fixed show">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSidebar"    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <a class="logo-wrapper waves-effect" href="http://fb.com/QuangThienOfficial.VietNam" target="_blank">
        <img style="max-height: 100%;" src="<?php echo PATH; ?>/public/images/logoFB-removebg.png" class="img-fluid" alt="">
    </a>
    <center><h4>Xin chào <b><h3><?php if (isset($_SESSION['name'])){echo $_SESSION['name'];} ?></h3></b></h4></center>
    <div class="list-group list-group-flush" id="navbarSidebar">
        <a href="<?php echo PATH; ?>" class="list-group-item waves-effect">
            <i class="fas fa-chart-pie mr-3"></i>Trang chủ
        </a>
        <a href="<?php echo PATH; ?>/get-token.php" class="list-group-item list-group-item-action waves-effect ">
            <i class="fas fa-key mr-3"></i>Get Token</a>
        <a href="<?php echo PATH; ?>/share-to-group.php" class="list-group-item list-group-item-action waves-effect">
            <i class="fas fa-share mr-3"></i>Share Group</a>
        <a href="<?php echo PATH; ?>/change_info_acc.php" class="list-group-item list-group-item-action waves-effect">
            <i class="fas fa-user-alt mr-3"></i>Thông tin tài khoản</a>
        <button type="button" class="list-group-item list-group-item-action waves-effect" id="logout">
             <i class="fas fa-sign-out-alt mr-3"></i>Đăng xuất</button>
    </div>

</div>
<!-- ./Sidebar -->



<?php
function a(string $php_file){
    $SEFT = $_SERVER['PHP_SELF'];
    if ($SEFT === "/".FOLDER."/".$php_file){
        echo "active";
    }
}

