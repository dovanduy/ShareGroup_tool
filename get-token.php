<?php
include_once "config.php";

if (!isset($_SESSION)) {
    session_start();
}
include_once "include/Connection.php";
$conn = getConnection();
$_SESSION['title'] = "Get Access Token";

if (!isset($_SESSION['username'])) {
    header("location: login.php");
}
$query = mysqli_query($conn,"SELECT * FROM `user` WHERE `user` = '".$_SESSION['username']."'");
$result = mysqli_num_rows($query);
if ($result==0){
    include "logout.php";
}
?>

<!--Main Navigation-->
<header>
    <?php
    include "layout/header.php";
    if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1){
        include "layout/navbar.php";
    }
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
                    <label for="in_cookie">Danh sách cookie</label>
                    <textarea id="in_cookie" class="form-control mb-1" rows="5" placeholder="Dán danh sách cookie vào đây"></textarea>
                </div>
                <button id="btnGetToken" class="btn btn-primary d-block mt-4">Lấy Token</button>
            </div>

            <h2>Đã thực hiện</h2>
            <table id="tblResult" class="table table-bordered">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>UID</th>
                    <th>Token</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</main>
<!--Main layout-->

<?php include "layout/footer.php"; ?>