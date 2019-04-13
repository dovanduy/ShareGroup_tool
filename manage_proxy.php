<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 11/04/2019
 * Time: 8:01 CH
 */

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username']) || $_SESSION['auth'] != 1){
    header("location: login.php");
}
include "config.php";
include "include/Connection.php";
$conn = getConnection();
$query = mysqli_query($conn, "SELECT * FROM `list_proxy`");

$_SESSION['title'] = "Quản lý Proxy";



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
    <main id="root" class="pt-5 mx-lg-5">
        <div class="main-content">
            <div class="py-5">
                <button type="button" class="btn btn-icon waves-effect waves-light btn-danger" id="btn_del_all_proxy" title="Xoá" style="float: right"> Xoá Toàn Bộ</button>
                <table class="table table-hover">
                    <thead class="black white-text">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Danh sách Proxy</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row=mysqli_fetch_array($query)){ ?>
                        <tr>
                            <th scope="row"><?php echo $row['id'] ?></th>
                            <td><?php echo $row['proxy']; ?></td>
                            <td>
                                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning" id_proxy="<?php echo $row['id']?>" id="btn_change_proxy" title="Sửa"> <i class="fa fa-wrench"></i>
                                    <button type="button" class="btn btn-icon waves-effect waves-light btn-danger" id_proxy="<?php echo $row['id']?>" id="btn_del_proxy" title="Xoá"> <i class="far fa-trash-alt"></i>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <center>
                    <button type="button" class="btn btn-outline-dark waves-light waves-effect w-md" id="btn_add_proxy" title="Thêm Proxy"> <i class="fa fa-edit"></i>
                    </button>
                </center>

                <!--Modal Edit-->
                <div class="modal fade" id="ModalEditProxy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel" up_add="up">Sửa thông tin Proxy</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="noidungsua"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="update_proxy" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Add Proxy-->
                <div class="modal fade" id="ModalAddProxy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel" >Thêm Proxy</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Danh sách Proxy</label>
                                    <textarea class="form-control rounded-0" id="proxy" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="add_proxy" class="btn btn-primary">Thêm</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
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