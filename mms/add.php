<?php

//把common.php文件导入进来
include 'common.php';
//验证用户名和密码，在session中有没有
include 'checkLogin.php';

//var_dump($_POST);//打印post看表单的数据能不能获取


if($_POST['send']){
	/* 判断是否为空*/
	/* if($_POST['username']==""||$_POST['pwd']==""||$_POST['email']==""){
		echo "<script>alert('用户名，密码，邮箱为空');location.href='add.php';</script>";
		return;
	} */
	
    /*添加之前，看用户名是否重复*/
    $searchSql="select * from member where username='".$_POST['username']."'";//根据用户名查询数据库
    $searchResult=$pdo->query($searchSql);
    $oneUser=$searchResult->fetchAll(PDO::FETCH_OBJ);
    //var_dump($oneUser[0]);//有就打印出来，没有就是NULL;
   // exit();//终止代码执行
   /* 判断重复 */
    if($oneUser[0]){
        echo "<script>alert('用户名已经存在，请重试');history.go(-1);</script>";
        return false;
    }
    /*  添加数据*/
    $sql="insert into member (username,pwd,email,regTime)values('".$_POST['username']."','".md5($_POST['pwd'])."','".$_POST['email']."','".date('Y-m-d H:i:s')."')";
    //echo $sql;//查看sql语句正不正确
    $result=$pdo->exec($sql);//将表单的数据，添加到数据库中,,exec()返回值是int类型
    if($result){
        //echo "ok";
        echo "<script>alert('数据添加成功');location.href='getall.php';</script>";
    }else{
        echo "false";
    }
}




?>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style>
    .reg{
    
    	border:1px solid #ddd;
    	position:absolute;
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
    	height:50px;
   
    }
    label{
   
    	font-size:18px;
    }
   
 
</style>
<form action="" method="post" class='reg ' role="form" > <!--onsubmit="return result()" 自己写的onsubmit事件 -->
<h1 style="margin-top: 0px" class="text-center">添加用户</h1>
	<hr>
<div class="form-group">
<label for="">用户名</label>
	<input type="text" name="username" class="form-control" placeholder="请输入用户名">
</div>
<div class="form-group">
	<label for="">密码</label>
	<input type="password" name="pwd" class="form-control" placeholder="请输入密码">
</div>
<div class="form-group">
	<label for="">邮箱</label>
	<input  type="text" name="email" class="form-control email" placeholder="请输入邮箱">
</div>
	<input  style="width:70%" class="btn btn-primary center-block addBtn" type="submit" name="send" value="submit"><br>
</form>

<script src="bootstrap/js/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="Tools.js"></script>
<!--课堂讲的，通过 evt.preventDefault();阻止后续动作 -->
<script>
//根据选择器名选择元素
	var addBtn=document.querySelector(".addBtn");
	var email=document.querySelector(".email");
	console.log(addBtn);
	addBtn.addEventListener("click",function(evt){//点击提交按钮，进行验证！
		if(!validate_email(email.value)){//通过工具类，验证密码，不正确就阻止动作
		alert("邮箱格式不正确！");
		//阻止默认动作
		evt.preventDefault();
		}else{
			alert("恭喜你,邮箱格式正确！");
		}
		
	})
</script>

<!--自己写的非空验证，onsubmit事件-->
<script>
/* 	var inp=document.querySelector("input[type=submit]");
	var inparr=document.getElementsByTagName("input");
	function result(){
			if(inparr[0].value==""||inparr[1].value==""||inparr[2].value==""){
				alert('请填写有效的用户名、密码、邮箱'); 
				for(var j=0;j<3;j++){
					inparr[j].style.border="1px solid red";
					inparr[j].setAttribute("placeholder","必填！"); 
					inparr[j].onfocus=function(){
						this.style.border="1px solid #ddd";
						}
					}
				return false;
			}else{
				return true;
			}
		}  */
</script>
