<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])){
    header("location: login.php");
}
include "header.php";
?>

<!--Main Navigation-->
<header>
    <?php
    if (isset($_SESSION['auth'])){
        if ($_SESSION['auth'] == 1){
            include "navbar.php";
        }
    }
    include "sidebar.php";
    ?>
</header>
<!--Main Navigation-->

<!--Main layout-->
<main id="root" class="pt-5 mx-lg-5">

</main>
<!--Main layout-->

<?php include "footer.php"; ?>

