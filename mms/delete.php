<?php

//把common.php文件导入进来
include 'common.php';
//验证用户名和密码，在session中有没有
include 'checkLogin.php';



if($_GET['id']){
    $sql="delete from member where id=".$_GET['id'];
   // echo $sql;
   $result=$pdo->exec($sql);
   //如果删除成功，直接跳转到首页
   if($result){
       echo header("location:getall.php");
   }else{
       echo "<script>alert('删除失败');location.href='getall.php';</script>";
   }
}else{
    //点击删除的时候没有id，就跳转到此页面
    //跳转：防止用户直接访问delete。php
    header("location:getall.php");
}


?>