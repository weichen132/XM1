<?php
//开启session
session_start();
//错误处理
error_reporting(E_ALL^E_NOTICE);
//设置默认时区
date_default_timezone_set("PRC");

/* 连接mysql服务器，数据库 */
//执行指定的代码，如果出错，就捕获到，
try{
    $pdo=new PDO("mysql:host=localhost;dbname=web13","root","");
}catch(PDOException $e){//$e = new PDOException()
    echo $e->getMessage();//$e-> $e下面的方法
    /*  echo "<pre>";
     var_dump($e);
     echo "</pre>"; */
}
/* 设置数据库操作字符集 */
$pdo->query("set names utf8");




?>