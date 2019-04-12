<?php
include_once "config.php";

if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['title'] = "Get Access Token";

if (!isset($_SESSION['username'])) {
    header("location: login.php");
}
?>

<!--Main Navigation-->
<header>
    <?php
    include "layout/header.php";
    include "layout/navbar.php";
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
                    <label for="in_cookie">Cookie</label>
                    <textarea id="in_cookie" class="form-control mb-1" rows="5"></textarea>
                </div>
                <button id="btnGetToken" class="btn btn-primary d-block mt-4">Lấy Token</button>
            </div>

            <h2>List Result</h2>
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