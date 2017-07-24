<?php
include 'common.php';
/**
 * @TODO:一周内不用登入  */
/*如果cookie有效，跳转到首页，无需登入*/
/* if($_COOKIE['username']){
    //把cookie保存到session中
    $_SESSION['admin']=$_COOKIE['username'];
    header("location:getall.php");
} */

/*点击登入*/

if($_POST['send']){
    /*验证码的验证*/
    if(strtolower($_POST['code'])!=strtolower($_SESSION['captcha'])){
        echo "<script>alert('验证码错误');location.href='login.php';</script>";
        return false;
    }
    
    //把用户名和密码在数据库中查询
    $sql="select * from admin 
        where username='".$_POST['username']."'
        and pwd='".md5($_POST['pwd'])."'";
    $result=$pdo->query($sql);
    $oneUser=$result->fetchAll(PDO::FETCH_OBJ);//返回的oneUser是数组，数组里面的内容是存的是对象形式
    //判断数据的用户名和密码是否存在
    if($oneUser[0]){
        /*判断用户是否点击了。一周内不用登录*/
        if($_POST["oneweek"]==1){//如果点击了，一周内不登录
            setcookie("username",$_POST["username"],time()+3600*24*7);
            //跳转到首页
            header("location:getall.php?oneweek=1");
        }else{
            setcookie("username",$_POST["username"]);
            //跳转到首页
            header("location:getall.php?oneweek=0");
        }
        
        
        
       /*  var_dump($oneUser[0]->username) ; */
       /*  echo "<pre>";
        var_dump($oneUser[0]);
        echo "</pre>"; */
        header("location:getall.php");//存在就跳转到首页
        //把用户对象保存到session中
        $_SESSION['admin']=$oneUser[0];
        
    }else{
        echo "<script>alert('用户名或密码错误！');location.href='login.php';</script>";
    }
    
   /*  echo "<pre>";打印有没有植
    var_dump($_POST);
    echo "</pre>"; */
}


?>
<dl class="login">
<form action="" method="post">
	<dt>欢迎登入</dt>
	<dd><input type="text" name="username" placeholder="用户名"></dd>
	<dd><input type="text" name="pwd" placeholder="密码"></dd>
	<dd>
		<input type="text" name="code" class="code" placeholder="验证码">
		<img src="captcha.php">
	</dd>
	<dd><input type="checkbox" name="oneweek" class="oneweek" value="1">一周内不用登入</dd>
	<dd><input type="submit" name="send" value="登入" class="loginBtn"></dd>
</form>
</dl>
<style>
dl,dt,dd{
	margin:0;
	padding:0;
}
    .login{
    	border:1px solid #ddd;
    	width:220px;
    	height:190px;
    	padding:5px;
    	position:absolute;
    }
   
    .login dt{
    	text-algin:center;
    }
    .login dd{
    	margin:5px auto;
    }
    .login dd input{
    	width:100%;
    }
    /*优先级，*/
 .login .code{
    	width:50px;
    }
  .login .oneweek{
  	 width:20px;
  }
</style>
<script src="Tools.js"></script>
<script>
	center(document.querySelector(".login"));
</script>