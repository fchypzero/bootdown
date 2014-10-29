<?php
//引入配置文件
include_once '../lib/config.php';
include_once 'func/global.func.php';
include_once '../lib/func/comm.func.php'; //获取全局公共函数
include_once 'func/systems.func.php';

session_start();
$sessionId = session_id();

//检测是否登录，若没登录则转向登录界面

if(!isset($_COOKIE['admin_name'])){
    header("Location:login.php");
    exit();

}
else
{
    $admin_name = $_COOKIE['admin_name'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>管理后台</title>
    <?php include_once 'lib/header.inc.php'; ?>
</head>
<body class="skin-blue">
<?php include_once 'lib/nav.inc.php';
include_once 'lib/slidebar_left.inc.php';  ?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            管理中心
            <small>Admin Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> 后台</a></li>
            <li class="active">下载管理</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="page">
            <div class="content">
                <div align="center"   ><?php
                    $action  = $_GET['action'];
                    $title   = $_POST['item_title'];
                    $size    = $_POST['item_size'];
                    $link    = $_POST['item_link'];
                    $info    = $_POST['item_info'];
                    $cate_id = $_POST['cate'];
                    if($action == "add"){
                        //添加
                        item_add($title,$size,$link,$cate_id,$info);
                        $msg = "添加成功";
                    }else{
                        //修改
                        $id = $_POST['id'];
                        $rs = item_update($id,$title,$cate_id,$link,$size,$info);
                        if($rs){$msg = "修改成功";}
                    }
                    ?>
                    <div >
                        <i class="fa fa-check"></i>

                        <b>Ok!</b> <?php echo $msg; ?> <a href="item_manage.php">返回列表</a>
                    </div>
                    </br>
                </div>
            </div><!-- /.error-content -->
        </div><!-- /.error-page -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
<?php include_once 'lib/footer.inc.php'; ?>
</body>
</html>