<?php
include "config.php";

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])){
    header("location: login.php");
}

$_SESSION['title'] = "Share Group";

//$auth = new Authenticate();
//$auth->login("", "");
//$auth->checkAuth();

if (true) {
    include "layout/header.php";
    ?>

    <!--Main Navigation-->
    <header>
        <?php
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
                        <label for="in_cookie">Cookie</label>
                        <textarea id="in_cookie" class="form-control mb-1" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="in_message">Message</label>
                        <input id="in_message" type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="in_message">Link</label>
                        <input id="in_link" type="text" class="form-control">
                    </div>

                    <button class="btn btn-primary d-block mt-4" onclick="runShareGroup()">Get Token</button>
                </div>

                <h2>List Result</h2>
                <table id="tb_result" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Token</th>
                        <th>IP</th>
                        <th>Proxy</th>
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
}
?>