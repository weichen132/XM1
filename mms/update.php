<?php

//把common.php文件导入进来
include 'common.php';
//验证用户名和密码，在session中有没有
include 'checkLogin.php';


/*修改数据  */
if($_GET['id']){
    //把点击修改的数据查询出来
    $sql="select * from member where id=".$_GET['id'];
    //echo $sql;打印sql语句，看是否正确
    $result=$pdo->query($sql);
    //从结果集中获取所有数据
    $data=$result->fetchAll(PDO::FETCH_OBJ);
    //var_dump($data[0]);
    if($data[0]==null){
        echo "数据不存在";
    }
    
    /* 判断时候点击了下面表单的提交按钮,读取表单里面input数据 */
    if($_POST['send']){
        //判断密码时候修改，如果没有修改，$pwd的值就是原来的密码，传到sql语句中
        //如果修改了，$pwd的值就是加密后的值，传到sql语句中
        if($_POST['pwd2']==$_POST['pwd']){
            $pwd=$_POST['pwd'];
        }else{
            $pwd=md5($_POST['pwd']);
        }
        //var_dump($_POST);
        $sql="update member 
                set username='".$_POST['username']."',
                    pwd='".$pwd."',
                    email='".$_POST['email']."'
                where id=".$_GET['id'];
        //echo $sql;
        $result=$pdo->exec($sql);
        if($result){
            //echo "修改成功";
            echo "<script>alert('修改成功');location.href='getAll.php';</script>";
        }else if($result==0){
            echo "没有修改";
        }else{
            echo "修改失败";
        }
      
    }
    
}else{//如果没有id传递，跳转到首页
    header("location:getall.php");
}


?>
<!-- 引入bootstrap文件 -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<style>
    .reg{
    	border:1px solid #ddd; 
    	position:absolute;
    	margin-top:100px;
    	padding:15px; 
    	right:0px;
    	left:0px;
    	top:0px;
    	bottom:0px;
    	margin:auto;
    	width:500px; 
    	height:450px; 
    	box-shadow:0 0 3px #ddd;
    }
    .reg input{
   		margin-top:20px;
    	height:50px;
   
    }
    label{
    	margin-top:24px;
    	font-size:18px;
    }
   
</style>

<form action="" method="post" class='form-horizontal reg' role="form"> 
<!--保存原来的密码 ,原来判断此密码和pwd密码是不是一样 -->
	<input type="hidden" name="pwd2" value=<?php echo $data[0]->pwd;?>>
	<h1 style="margin-top: 0px" class="text-center">修改用户</h1>
	<hr>
	<div class="form-group">
		<label for="" class="col-sm-2 col-lg-2 col-xs-2 control-label">用户</label>
		 <div class="col-sm-10 col-lg-10 col-xs-10">
		<input class="form-control" type="text" name="username" value=<?php echo $data[0]->username;?>><!-- 直接显示数据库里面查询出来的值 -->
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-sm-2 col-lg-2 col-xs-2 control-label">密码</label>
		<div class="col-sm-10 col-lg-10 col-xs-10">
		<input class="form-control" type="password" name="pwd" value=<?php echo $data[0]->pwd;?>>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-sm-2 col-lg-2 col-xs-2 control-label">邮箱</label>
		<div class="col-sm-10 col-lg-10 col-xs-10">
		<input class="form-control" type="text" name="email" value=<?php echo $data[0]->email;?>>
		</div>
	</div><input class="btn btn-danger " type="submit" name="send" value="submit" style="width:70%;margin-left:100px">
	
	
</form>
<script src="bootstrap/js/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>