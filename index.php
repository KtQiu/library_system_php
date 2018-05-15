<?php
// 设置缓存，可以在文件中传递参数
setcookie("user", "", time()+3600);
// setcookie("admin", "", time()-3600);
?>



 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge chrome=1">
    <title>The Book Management System of Kobayashi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 使用bootstrap的css文件 -->
    <link rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap.css">

    <style type="text/css">
        .alert
        {
            margin: 25% auto 20%;
            text-align: center;
        }
    </style>
</head>

<div class="container">
    <div class="row">
        <div class ="col-md-12" >
            <div class="alert">
            <h2>图书管理系统-登录界面</h2>
            <br />
            <div class="col-md-15">
                <!-- <align=center> -->
            
                <form name = "form_login" method = "post" action = "">
                    <div class="form-group ">
                        <!-- <label class="control-label" for="username"><label class="text-danger">*&nbsp; -->
                        
                        <div class="row">  
                            <div class="form-inline">
                                <label class="control-label" for="username"><label class="text-danger">*&nbsp;
                                </label>账号</label>&nbsp;&nbsp;&nbsp;  
                                <input name="username" type="text" class="form-control" placeholder="账号"/>
                                
                                <!-- <input type="text" class="form-control" placeholder="关键字" />   -->
                            </div>  
                        </div>  

                        <div class="row">  
                            <div class="form-inline">
                                <label class="control-label" for="passward"><label class="text-danger">*&nbsp;
                                </label>密码</label>&nbsp;&nbsp;&nbsp;  
                                <input name="passward" type="text" class="form-control" placeholder="密码"/>
                                
                                <!-- <input type="text" class="form-control" placeholder="密码" />   -->
                            </div>  
                        </div>  

                        <br />
                        <!-- <input name="submit" type="submit" class="btn"  value="登录"/> -->
                        <button name="submit" tye="submit" class="btn btn-primary" value="登录">登录</button>
                        <button name="submit" type="submit" class="btn btn-primary" value="register">注册</button>
                    </div>
                </form>
                <!-- </align> -->
                <?php
                    include_once ('./link.php');
                    include_once ('./util.php');
                    if(isset($_POST['submit']) and $_POST['submit']=="登录")
                    {
                        $pwd = $_POST['passward'];
                        $user = $_POST['username'];
                    

                        $conn = new link;
                        // $sql = "select book_name from book;";
                        $sql_admin = "select * from manager where manager_id=".$user;
                        $res_admin = $conn->exec_sql($sql_admin);
                        $sql_reader = "select * from reader where reader_id=".$user;
                        $res_reader = $conn->exec_sql($sql_reader);
                        if($res_admin)
                        {
                            foreach ( $res_admin as $row ) 
                            {
                                // echo "reader_id :".$row["manager_id"]."<br>";
                                // echo "passward :".$row["passward"]."<br>";
                                $admin_name = $row["manager_name"];
                                $admin_id = $row["manager_id"];

                                if($row["passward"]==$pwd)
                                {
                                    alert("login successfully Admin ".$admin_name." !");
                                    // 保存cookie
                                    setcookie("user", $admin_name, time()+3600);
                                    setcookie("manager_id",$admin_id,time()+3600);
                                    // alert($admin_id);
                                    // alert($_COOKIE["manager_id"]);
                                    $url="http://localhost/library_system_KtQiu/manager.php";
                                    echo "<meta http-equiv='Refresh' content='0;URL=$url'>";  
                                    goto quit;
                                }
                            }
                        }
                        if($res_reader)
                        {
                            $flag = 1;
                            foreach ( $res_reader as $row ) 
                            {
                                $reader_name = $row["reader_name"];
                                $job = $row["job"];
                                if($job=="S")
                                {
                                    $job="Student ";
                                }else
                                {
                                    $job="Teacher ";
                                }
                                if($row["passward"]==$pwd)
                                {
                                    alert("login successfully ".$job.$reader_name." !");
                                    setcookie("user", $reader_name, time()+3600);
                                    $url="http://localhost/library_system_KtQiu/reader.php";
                                    echo "<meta http-equiv='Refresh' content='0;URL=$url'>"; 
                                }else
                                {
                                    alert("Account and password do not match! Try again~");
                                }
                                $flag = 0;
                            }
                            if($flag==1)
                            {
                                alert("The account does not exist! Please check carefully!");                                
                            }
                        }
                        else 
                        {
                            alert("execute sql failed!");
                        }

                        quit:
                        pass;
                    }
                    if(isset($_POST['submit']) and $_POST['submit']=="register")
                    {
                        $url="http://localhost/library_system_KtQiu/add_card.php";
                        echo "<meta http-equiv='Refresh' content='0;URL=$url'>";
                        $add_card = $_POST["reader_id"];
                    }
                    
                ?>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->

<body>



</body>



</html>



<!--
    // 查询的操作 测试代码
 $sql = "select book_name from book where remain_num = 0;";
$res = $conn->exec_sql($sql);

if($res)
{
    foreach ( $res as $row ) 
    {
        echo $row["book_name"];
        echo "<br>";
    }
}else 
{
    echo "execute sql false!";
}
 -->
