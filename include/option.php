<?php
if(!isset($_SESSION)){
    session_start();
}
if ($_SESSION['auth'] != '1'){
  exit();
}



  require_once '../config.php';
  require_once 'Connection.php';
  $conn = getConnection();
if ($_POST['type'] == 'up'){
  $type = True;
    $sql = "SELECT * FROM `user` WHERE `id` = ".$_POST['id'] ;
    $query = mysqli_query($conn, $sql);
    $info = mysqli_fetch_assoc($query);
//  $type = json_decode(($info['func']), true);
}
if ($_POST['type'] == 'add'){
    $type = False;
    $num_id = mysqli_query($conn,"SELECT MAX(id) AS `max-id` FROM `user`");
    $num_id_2 = mysqli_fetch_array($num_id);
}

?>


<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
<!--      <p>Type: --><?php //echo $num_id_2['max-id'];?><!--</p>-->
    <input type="text" id="id" value="<?php echo $_POST['id']?>" style="display: none">
    Mã Người Dùng:
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-addon">
          <span class="glyphicon glyphicon-barcode"></span>
        </div>
        <input class="form-control" id="id_user" type="text" placeholder="Mã Người Dùng ..." value="<?php if($type){ echo $info["id"];}else{echo $num_id_2['max-id']+1;}?>" style="color:#000" disabled>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
      Tên Người Dùng:
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">
            <span class="glyphicon glyphicon-user"></span>
          </div>
          <input class="form-control" id="name" type="text" placeholder="Tên Người Dùng..." value="<?php if($type){echo $info["name"];}?>" autofocus="autofocus" >
        </div>
      </div>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
      Tài khoản:
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">
            <span class="glyphicon glyphicon-th-large"></span>
          </div>
          <input class="form-control" id="user" type="text" placeholder="Tên tài khoản..." value="<?php if($type){ echo $info["user"];}?>">
        </div>
      </div>
    </div>

      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
      Mật khẩu:
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">
            <span class="glyphicon glyphicon-th-list"></span>
          </div>
          <input class="form-control" id="pass" type="text" placeholder="Mật khẩu tài khoản..." value="<?php if($type){  echo $info["pass"];}?>" autofocus="autofocus" >
        </div>
      </div>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        Quyền (0: admin | 1: User)
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th-list"></span>
                </div>
                <input class="form-control" id="pass" type="text" placeholder="Phân quyền..." value="<?php if($type){  echo $info["auth"];}?>" autofocus="autofocus" >
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
      Địa chỉ IP:
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">
            <span class="glyphicon glyphicon-th-list"></span>
          </div>
          <input class="form-control" id="ip_address" type="text" placeholder="Địa chỉ ip..." value="<?php if($type){  echo $info["ip_address"];}?>" autofocus="autofocus" >
        </div>
      </div>
    </div>

<!--    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">-->
<!--      Tag Ẩn:-->
<!--      <div class="form-group">-->
<!--        <div class="input-group">-->
<!--          <div class="input-group-addon">-->
<!--            <span class="glyphicon glyphicon-th-list"></span>-->
<!--          </div>-->
<!--          <select id="tag" class="form-control">-->
<!--            --><?php
//            if ($type){
//
//              if($type['tag'] == 'on'){
//                echo '<option value="on">Bật</option><option value="off">Tắt</option>';
//              }else{
//                echo '<option value="off">Tắt</option><option value="on">Bật</option>';
//              }
//            }else{
//              echo '<option value="on">Bật</option><option value="off">Tắt</option>';
//            }
//             ?>
<!--          </select>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!---->
<!---->
<!--    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">-->
<!--      Tag Không bạn bè:-->
<!--      <div class="form-group">-->
<!--        <div class="input-group">-->
<!--          <div class="input-group-addon">-->
<!--            <span class="glyphicon glyphicon-th-list"></span>-->
<!--          </div>-->
<!--          <select id="tagNoFr" class="form-control">-->
<!--            --><?php
//            if ($type){
//
//              if($type['tagNoFr'] == 'on'){
//                echo '<option value="on">Bật</option><option value="off">Tắt</option>';
//              }else{
//                echo '<option value="off">Tắt</option><option value="on">Bật</option>';
//              }
//            }else{
//              echo '<option value="on">Bật</option><option value="off">Tắt</option>';
//            }
//             ?>
<!--          </select>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!---->
<!--    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">-->
<!--      Get Token:-->
<!--      <div class="form-group">-->
<!--        <div class="input-group">-->
<!--          <div class="input-group-addon">-->
<!--            <span class="glyphicon glyphicon-th-list"></span>-->
<!--          </div>-->
<!--          <select id="getToken" class="form-control">-->
<!--            --><?php
//            if ($type){
//
//              if($type['getToken'] == 'on'){
//                echo '<option value="on">Bật</option><option value="off">Tắt</option>';
//              }else{
//                echo '<option value="off">Tắt</option><option value="on">Bật</option>';
//              }
//            }else{
//              echo '<option value="on">Bật</option><option value="off">Tắt</option>';
//            }
//             ?>
<!--          </select>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!---->
<!---->
<!--    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">-->
<!--      Post Profile Pic & Cmt:-->
<!--      <div class="form-group">-->
<!--        <div class="input-group">-->
<!--          <div class="input-group-addon">-->
<!--            <span class="glyphicon glyphicon-th-list"></span>-->
<!--          </div>-->
<!--          <select id="postP" class="form-control">-->
<!--            --><?php
//            if ($type){
//
//              if($type['postP'] == 'on'){
//                echo '<option value="on">Bật</option><option value="off">Tắt</option>';
//              }else{
//                echo '<option value="off">Tắt</option><option value="on">Bật</option>';
//              }
//            }else{
//              echo '<option value="on">Bật</option><option value="off">Tắt</option>';
//            }
//             ?>
<!---->
<!--          </select>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">-->
<!--      Create Group & Post:-->
<!--      <div class="form-group">-->
<!--        <div class="input-group">-->
<!--          <div class="input-group-addon">-->
<!--            <span class="glyphicon glyphicon-th-list"></span>-->
<!--          </div>-->
<!--          <select id="postG" class="form-control">-->
<!--            --><?php
//            if ($type){
//
//              if($type['postG'] == 'on'){
//                echo '<option value="on">Bật</option><option value="off">Tắt</option>';
//              }else{
//                echo '<option value="off">Tắt</option><option value="on">Bật</option>';
//              }
//            }else{
//              echo '<option value="on">Bật</option><option value="off">Tắt</option>';
//            }
//             ?>
<!---->
<!--          </select>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!---->
<!--    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">-->
<!--      Post Profile:-->
<!--      <div class="form-group">-->
<!--        <div class="input-group">-->
<!--          <div class="input-group-addon">-->
<!--            <span class="glyphicon glyphicon-th-list"></span>-->
<!--          </div>-->
<!--          <select id="postPasG" class="form-control">-->
<!--            --><?php
//            if ($type){
//
//              if($type['postPasG'] == 'on'){
//                echo '<option value="on">Bật</option><option value="off">Tắt</option>';
//              }else{
//                echo '<option value="off">Tắt</option><option value="on">Bật</option>';
//              }
//            }else{
//              echo '<option value="on">Bật</option><option value="off">Tắt</option>';
//            }
//             ?>
<!---->
<!--          </select>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!---->
<!--    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">-->
<!--      Join Group:-->
<!--      <div class="form-group">-->
<!--        <div class="input-group">-->
<!--          <div class="input-group-addon">-->
<!--            <span class="glyphicon glyphicon-th-list"></span>-->
<!--          </div>-->
<!--          <select id="joinG" class="form-control">-->
<!--            --><?php
//            if ($type){
//
//              if($type['joinG'] == 'on'){
//                echo '<option value="on">Bật</option><option value="off">Tắt</option>';
//              }else{
//                echo '<option value="off">Tắt</option><option value="on">Bật</option>';
//              }
//            }else{
//              echo '<option value="on">Bật</option><option value="off">Tắt</option>';
//            }
//             ?>
<!---->
<!--          </select>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
  </div>



  </script>
