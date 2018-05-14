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
            margin: 15% auto 100px;
            text-align: center;
        }
    </style>
</head>

<div class="container">
        <div class="row">
            <div class ="col" >
                <div class="alert">
                <h2>The Book Management System of Kobayashi</h2>
                
        <div class="col-md-12">
        </div>
                <form name = "form_login" method = "post" action = "">

                    <!-- <div class="form-group">
                        <label class="control-label" for="username">账号</label>
                        <input name="username" type="text" placeholder="帐号"/>
                        <label class="control-label" for="username" style="display:none;"></label>
                    </div> -->  

                    <div class="form-group col-lg-4 center">

                <div align="center">
                                <!-- <label class="control-label" for="passward">密码</label> -->
                                <!-- <div class="col-lg-8">
                                            <input class="form-control" id="borrow_sno" type="text" value="">
                                            <label class="control-label" for="borrow_sno" style="display: none"></label>
                                </div> -->

                                <!-- <div class="col-lg-4"> -->
    <label class="control-label" for="username"><label class="text-danger">*&nbsp;</label>账号</label>
    <input name="username" type="text" class="form-control" placeholder="账号"/>
    </div>
                                        <!-- <label class="control-label" for="passward" style="display:none;"></label> -->
                                <!-- </div> -->
                    <!-- </div> -->








                    <!-- <div class="form-group"> -->
                                <!-- <label class="control-label" for="passward">密码</label> -->
                                <!-- <div class="col-lg-8">
                                            <input class="form-control" id="borrow_sno" type="text" value="">
                                            <label class="control-label" for="borrow_sno" style="display: none"></label>
                                </div> -->

                                <!-- <div class="col-lg-4"> -->
                                        <label class="control-label" for="passward"><label class="text-danger">*&nbsp;
                                        </label>密码</label>
                                        <input name="passward" type="text" class="form-control" placeholder="密码"/>
                                        <!-- <label class="control-label" for="passward" style="display:none;"></label> -->
                                <!-- </div> -->
                    </div>
<div class="col">
                    <input name="submit" type="submit" value="登录"/>
                </div>
                </form>

                <?php



                    include_once ('./link.php');
                    include_once ('./util.php');
                    if(isset($_POST['submit']) and $_POST['submit']=="登录")
                    {
                        $pwd = $_POST['passward'];
                        $user = $_POST['username'];
                        // echo $pwd;
                        // echo $user;


                        $conn = new link;
                        // $sql = "select book_name from book;";
                        $sql = "select * from reader where reader_id=".$user;
                        $res = $conn->exec_sql($sql);
                        // echo $sql."<br>";
                        if($res)
                        {
                            $flag = 1;
                            foreach ( $res as $row ) 
                            {
                                echo "reader_id :".$row["reader_id"]."<br>";
                                echo "passward :".$row["passward"]."<br>";
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
                                    $url="http://localhost/library_system_KtQiu/library_system.php";
                                    echo "<meta http-equiv='Refresh' content='0;URL=$url'>";  
                                }else
                                {
                                    alert("Account and password do not match! Try again~");
                                }
                                // if(empty($row))
                                // {
                                //     alert("Account and password do not match! Try again~");
                                // }
                                // echo $row["passward"]."<br>";
                                // echo $row["read_id"]."<br>";
                                // echo $row["read_name"]."<br>";
                                $flag = 0;
                            }
                            if($flag==1)
                            {
                                alert("The account does not exist! Please check carefully!");                                
                            }
                        }else 
                        {
                            alert("execute sql false!");
                        }





                        // $conn = new link;                    
                        // // $sql = "select passward from reader_id where reader_id =\"".$user."\";";
                        // $sql = "select * from book";
                        
                        // echo "I know<br>";
                        // echo $sql;
                        // $res = $conn->exec_sql($sql);
                        // echo "I know<br>";

                        // // echo $res["passward"];
                        // echo "I know<br>";                        
                        // echo $res;  


                        // echo "<br>";
                        // echo "I know<br>";

                        //     if($res[passward]==$pwd)
                        //     {
                        //         echo("Welcome to the library system!");
                        //     }else
                        //     {
                        //         echo("Account and password do not match! Try again~");
                        //     }
                        // // }else
                        // // {
                        // //     echo("execute sql false!");
                        // // }
                        
                        // echo($res[passward]);
                        // echo($res);                        
                        // echo("Nice");
                    }
                ?>
            </div>
        </div>
    </div>
</div>

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
