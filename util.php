<?php 
// 实现类似JS中的alert的PHP函数
function alert($tip = "", $type = "", $url = "") {
    $js = "<script>";
    if ($tip)
        $js .= "alert('" . $tip . "');";
    switch ($type) {
        case "close" : //关闭页面
            $js .= "window.close();";
            break;
        case "back" : //返回
            $js .= "history.back(-1);";
            break;
        case "refresh" : //刷新
            $js .= "parent.location.reload();";
            break;
        case "top" : //框架退出
            if ($url)
                $js .= "top.location.href='" . $url . "';";
            break;
        case "jump" : //跳转
            if ($url)
                $js .= "window.location.href='" . $url . "';";
            break;
        default :
            break;
    }
    $js .= "</script>";
    echo $js;
    if ($type) {
        exit();
    }
}

// function trimall($str)//删除所有的空格
// {
//     $qian=array(" ","　","\t","\n","\r");
//     $hou=array("","","","","");
//     return str_replace($qian,$hou,$str); 
// }




// split 函数 并对关键词进行sort
function ft_split($input)
{
		$split = explode(' ', $input);
		$split = array_filter($split);
		$split = array_splice($split, 0);
		sort($split);
		return $split;
}



// setcookie("admin", "", time()-3600);

// $str="         The code will use PHP's ZIP utilities and PDO n";
// echo $str;
// $word_list = ft_split($str); 
// foreach ( $word_list as $word)
// {
//     echo $word;
//     echo "<br />";
// }

?>
