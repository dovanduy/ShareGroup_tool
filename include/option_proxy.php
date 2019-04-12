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
    $sql = "SELECT * FROM `list_proxy` WHERE `id` = ".$_POST['id'] ;
    $query = mysqli_query($conn, $sql);
    $info = mysqli_fetch_assoc($query);
//  $type = json_decode(($info['func']), true);
}
if ($_POST['type'] == 'add'){
    $type = False;
    $num_id = mysqli_query($conn,"SELECT MAX(id) AS `max-id` FROM `list_proxy`");
    $num_id_2 = mysqli_fetch_array($num_id);
}

?>


<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
<!--      <p>Type: --><?php //echo $num_id_2['max-id'];?><!--</p>-->
    <input type="text" id="id" value="<?php echo $_POST['id']?>" style="display: none">
    ID:
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-addon">
          <span class="glyphicon glyphicon-barcode"></span>
        </div>
        <input class="form-control" id="id" type="text" placeholder="ID..." value="<?php if($type){ echo $info["id"];}else{echo $num_id_2['max-id']+1;}?>" style="color:#000" disabled>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
      Proxy:
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">
            <span class="glyphicon glyphicon-user"></span>
          </div>
          <input class="form-control" id="proxy" type="text" placeholder="Tên Người Dùng..." value="<?php if($type){echo $info["proxy"];}?>" autofocus="autofocus" >
        </div>
      </div>
    </div>
  </div>

