<?php
include_once "config.php";

if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['title'] = "Share Group";

if (!isset($_SESSION['username'])) {
    header("location: login.php");
}

?>

    <!--Main Navigation-->
    <header>
        <?php
        include "layout/header.php";
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
                        <label for="inMessage">Message</label>
                        <input id="inMessage" type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inLink">Link</label>
                        <input id="inLink" type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inLink">Giới hạn</label>
                        <input id="inLimit" type="number" class="form-control">
                    </div>

                    <button id="btnShareGroup" class="btn btn-primary d-block mt-4">Chia sẻ</button>
                </div>

                <h2>Đã thực hiện</h2>
                <table id="tblResult" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Group ID</th>
                        <th>Group Name</th>
                        <th>Viewer Post Status</th>
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