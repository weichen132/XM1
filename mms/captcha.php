<?php
/*  */
session_start();
/*生成验证码的php代码  */
$image=imagecreatetruecolor(120,50);//创建真彩色的图片
$bgColor=imagecolorallocate($image, rand(200,255), rand(200,255), rand(200,255));//背景色浅色
imagefill($image, 0, 0, $bgColor);//填充真彩色的图片
/*随机生成4个字符*/
$str="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
$temp=null;
/*把每次循环的字符连接起来*/
for($i=0;$i<4;$i++){
    $temp.=$str[rand(0,strlen($str)-1)];
}
//把验证码保存到session中
$_SESSION["captcha"]=$temp;
/* 把每个$temp字符循环放到图片中，就会产生角度不一样的效果 */
for($j=0;$j<4;$j++){
    $textColor=imagecolorallocate($image, rand(0,150), rand(0,150), rand(0,150));//字体颜色深色
    $size=rand(10,25);
    $angle=rand(-10,10);
    $x=floor(120/4)*$j+8;//分配每个字的x的坐标
    $y=rand(30,45);
    $fintsize="GEORGIAB.TTF";
    imagettftext($image, $size, $angle, $x,$y, $textColor, $fintsize, $temp[$j]);//向真彩色图片填充文字
}
imagepng($image);
?>
