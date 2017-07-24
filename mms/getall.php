<?php
//把common.php文件导入进来
include 'common.php';
//验证用户名和密码，在session中有没有
include 'checkLogin.php';
/* echo "<pre>";
var_dump($_SESSION);
var_dump($_COOKIE);
echo "</pre>"; */
/*查询数据库里面，多少条数据，总记录数，分页查询*/
$total=$pdo->query("select * from member")->rowCount();
//echo $total;
//每页显示数据的条数
$pageSize=3;
//总共要分的页数=数据库条数/每页显示的条数
$pageTotal=ceil($total/$pageSize);//ceil取大值--3页
//动态的改变，第几页，第1页就显示第一个的数据
//当前页等于查询字符串中的page值，
if($_GET['page']){
    $page=$_GET['page'];
    if($page>=$pageTotal){//当前页，大于 总页数
        $page=$pageTotal;
    }
}else{
    $page=1;
}

//查询的sql语句
$sql="select * from member order by id desc limit ".($page-1)*$pageSize.",".$pageSize;
//执行sql语句，返回一个结果集$result;
$result=$pdo->query($sql);
//将结果集，里面的数据转换为对象
$data=$result->fetchAll(PDO::FETCH_OBJ);
echo "<table border='1' align='center' width='95%' cellpadding=0 cellspacing=0 class='table table-hover table-striped text-center'> ";
echo "<caption class='text-center ' style='font-size:30px;font-weight:900;background:#8A8A8A;color:white'>用户管理</caption>";
echo "<tr class='bg-success' ><th class='text-center '>用户名</th><th class='text-center'>邮箱</th><th class='text-center'>注册时间</th><th class='text-center'>操作</th></tr>";
//$value:对象，每一条数据
foreach ($data as $key=>$value){
    //var_dump($value->username);
    echo "<tr>";
    echo "<td>".$value->username."</td>";
    echo "<td>".$value->email."</td>";
    echo "<td>".$value->regTime."</td>";
    echo "<td>";
    echo "<a href='update.php?id=".$value->id."'>修改</a>&nbsp;&nbsp;&nbsp;";
    echo "<a href='delete.php?id=".$value->id."'>删除</a>";
    echo "</td>";
    echo "</tr>";
}
echo "<tr><td colspan='4'><a href='add.php'>添加数据</a></td></tr>";
echo "</table>";
echo "<div class='page'>";
echo "<ul>";
echo "<li ><a href='?page=".($page-1)."'>上一页</a></li>";
echo "<li ><a href='?page=".($page+1)."'>下一页</a></li>";
echo "<li><input type='text' value='".$page."' class='changePage'></li>";
echo "<li><span class='present'>".$page."</span>/".$pageTotal."</li>";
echo "</ul>";
echo "</div>";
/* echo "<pre>";
var_dump($result->fetchAll(PDO::FETCH_OBJ));
 echo "</pre>";   */
?>

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style>
.table-hover>tbody>tr:hover {
    background-color: #ffea0a;
}
.changePage{
	width:50%;
}
.page{
	/* border:1px solid black; */
}
.page ul{
	text-align:center;
}
.page ul li{
	display:inline-block;
	margin:5px
	
}
.present{
	color:red;
}
</style>
<script src="bootstrap/js/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script>
	var changePage=document.querySelector(".changePage");
	//松开键盘，页面就跳到对应的页面
	changePage.addEventListener("keyup",function(){
		location.href="getall.php?page="+this.value;
		//console.log(location.href);
	})
</script>