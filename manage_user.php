<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 11/04/2019
 * Time: 5:48 CH
 */


if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['username']) || $_SESSION['auth'] != 1){
    header("location: login.php");
}

include_once "config.php";
include_once "include/Connection.php";
$conn = getConnection();
$query = mysqli_query($conn, "SELECT * FROM `user`");

$_SESSION['title'] = "Quản lý Người Dùng";



    include "layout/header.php";
    ?>

    <!--Main Navigation-->
    <header>
        <?php
        if ($_SESSION['auth'] == 1){
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
                <table class="table table-striped">
                    <thead class="black white-text">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">User</th>
                        <th scope="col">Pass</th>
                        <th scope="col">Name</th>
                        <th scope="col" title="0: admin; 1: user">Quyền</th>
                        <th scope="col">IP Address</th>
<!--                        <th scope="col">Func</th>-->
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row=mysqli_fetch_array($query)){ ?>
                        <tr>
                            <th scope="row"><?php echo $row['id'] ?></th>
                            <td><?php echo $row['user']; ?></td>
                            <td><?php echo $row['pass'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['auth'] ?></td>
                            <td><?php if($row['ip_address'] == null){echo "NULL";}else{echo $row['ip_address'];} ?></td>
<!--                            <td>--><?php //echo $row['func'] ?><!--</td>-->
                            <td>
                                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning" id_user="<?php echo $row['id']?>" id="btn_change" title="Sửa"> <i class="fa fa-wrench"></i>
                                    <button type="button" class="btn btn-icon waves-effect waves-light btn-danger" id_user="<?php echo $row['id']?>" id="btn_del" title="Xoá"> <i class="far fa-trash-alt"></i>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
               <div class="text-center">
                   <button type="button" class="btn btn-outline-dark waves-light waves-effect w-md" id="btn_add" title="Thêm Người Dùng"> <i class="fa fa-edit"></i>
                   </button>
               </div>

                <!--Modal Edit-->
                <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel" up_add="up">Sửa thông tin người dùng</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="noidungsua"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="update" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--Main layout-->

    <?php
    include "layout/footer.php";

?>