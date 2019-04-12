<?php
if(!isset($_SESSION)){
    session_start();
}
include './include/config.php';

if (isset($_SESSION['user'])){

  if($_SESSION['auth'] == 0){
    echo "<script>window.location='index.php';</script>";
  }
  include './include/head.php';
  include './include/func.php';
  $user = new run();
   $user->login($_SESSION['user'], $_SESSION['pass']);

}else{

  echo "<script>window.location='login.php';</script>";
}
?>





</ul>

</div>
<!-- Sidebar -->
<div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->



<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container-fluid">

      <div class="row" >
        <div class="col-12">
          <div class="page-title-box">
            <h4 class="page-title float-left">Xin chào <?php echo $_SESSION['name']; ?></h4>
            <div class="clearfix"></div>
          </div>
        </div>

        <div class="col-lg-12" id="change">
          <table class="table table-bordered table-hover">
            <thead class="thead-dark">
              <tr align="center">

                <th width="5%">ID</th>
                <th>Tài khoản</th>
                <th>Mật khẩu</th>
                <th>Tên</th>
                <th>Tác Vụ</th>
              </tr>
            </thead>
            <tbody id="showlist">

              <?php
              $List = $user->getListUser();

              foreach ($List as $key => $value) {
                echo "<tr>";
                echo '<td align="center"><font color="red">'.$value['id'].'</font></td>';
                echo '<td align="center"><font color="blue">'.$value['user'].'</font></td>';
                echo '<td align="center">'.$value['pass'].'</td>';
                echo '<td align="center">'.$value['name'].'</td>';
                echo '<td align="center">
		<button type="button" class="btn btn-icon waves-effect waves-light btn-warning" id_user="'.$value['id'].'" id="btn_change" title="Sửa"> <i class="fa fa-wrench"></i>
		</button>
		<button type="button" class="btn btn-icon waves-effect waves-light btn-danger" id_user="'.$value['id'].'" id="btn_del" title="Xoá"> <i class="fa fa-remove"></i>
		</button></td>';
                echo "</tr>";
              }

               ?>
            </tbody>
          </table>
          <center>
        		<button type="button" class="btn btn-outline-dark waves-light waves-effect w-md" id="btn_add" title="Thêm Người Dùng"> <i class="fa fa-edit"></i>
        		</button>
        	</center>
          <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        		<div class="modal-dialog modal-lg">
        			<div class="modal-content">
        				<div class="modal-header">
        					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        					<h4 class="modal-title" id="myModalLabel" up_add="up">SỬA THÔNG TIN NGƯỜI DÙNG</h4>
        				</div>
        				<div class="modal-body">
        					<div id="noidungsua"></div>
        				</div>
        				<div class="modal-footer" style="text-align: center;">
        					<div id="thongbaothem"></div>
        					<button type="button" id="update" class="btn btn-primary">CẬP NHẬT</button>
        				</div><br>
        			</div>
        		</div>
        	</div>

        </div><!-- end col -->

      </div>
    </div> <!-- container -->
  </div> <!-- content -->
</div>


<?php
include 'include/foot.php';
?>
