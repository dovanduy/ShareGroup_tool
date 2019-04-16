<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 12/04/2019
 * Time: 10:43 SA
 */
function alert($msg) {?>
   <script type='text/javascript'>alert('<?php echo $msg;?>');</script>;
<?php exit();};
if(!isset($_SESSION)){
    session_start();
}
if (!isset($_SESSION['username']) || $_SESSION['auth'] != '1'){
  exit();
}

    require_once '../config.php';
    require_once 'Connection.php';
    $conn = getConnection();
if ($_POST['option'] == 'up'){

    mysqli_query($conn,"UPDATE `user` SET `user` = '".$_POST['user']."',`pass`='".$_POST['pass']."',`name` = '".$_POST['name']."',`auth`= '".$_POST['auth']."',`ip_address`='".$_POST['ip_address']."' WHERE id = '".$_POST['id']."' ");

}else if($_POST['option'] == 'add'){
    $query = mysqli_query($conn,"SELECT * FROM `user` WHERE `user` = '".$_POST['user']."' ");
    $row=mysqli_num_rows($query);
    if ($row >= 1){
        alert('Thêm User thất bại - User đã tồn tại');

//        echo '<script type="text/javascript">';
//        echo 'setTimeout(function () { swal("Thêm User thất bại","Username đã tồn tại", "warning");';
//        echo '}, 100);</script>';
    }else{
        $sql = "INSERT INTO `user` (`user`, `pass`, `name`, `auth`) VALUE ('".$_POST['user']."','".$_POST['pass']."', '".$_POST['name']."','".$_POST['auth']."')";
        mysqli_query($conn,$sql);
    }


}else if($_POST['option'] == 'del'){
    mysqli_query($conn,"DELETE FROM `user` WHERE id = '".$_POST['id']."'");
}

 ?>
