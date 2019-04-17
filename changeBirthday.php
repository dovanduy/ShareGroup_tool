<?php
include_once "config.php";

if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['title'] = "Change Birthday";

if (!isset($_SESSION['username'])) {
    header("location: login.php");
}
include_once "include/Connection.php";
$conn = getConnection();
$query = mysqli_query($conn,"SELECT * FROM `user` WHERE `user` = '".$_SESSION['username']."'");
if (!$query){
    include "logout.php";
}

?>

    <!--Main Navigation-->
<?php
include "layout/header.php";?>
    <header>
        <?php
        if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1){
            include "layout/navbar.php";}
        include "layout/sidebar.php";
        ?>
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main id="root" class="pt-5 mx-lg-5">
        <div class="main-content">
            <div class="py-5">
                <div class="mb-5">
                    <div class="form-group">
                        <label for="inCookie">Danh sách cookie</label>
                        <textarea id="inCookie" class="form-control mb-1" rows="5" placeholder="Dán danh sách cookie vào đây"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inMessage">Ngày cần đổi</label>
                        <input id="inBirthday" type="text" class="form-control" value="12/07/1992" placeholder="ngày/tháng/năm">
                    </div>

                    <button id="btnChangeBirthday" class="btn btn-primary d-block mt-4">Đổi</button>
                </div>
                <h2>Đã thực hiện</h2>
                <table id="tblResult" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>User ID</th>
                        <th>Visibility</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!--Main layout-->

<?php
include "layout/footer.php";
?>