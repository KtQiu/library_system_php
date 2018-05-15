<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Library System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap.css">


    <div class="alert alert-info">
                <h2> 注册界面 </h2>
    </div>
</head>
<body>


<div class="container">
<div class="row">
    <div class="col-md-15">
                <!-- <align=center> -->
                <form name = "form_borrow" method = "post" action = "">
                    <div class="form-group ">
                        <!-- <label class="control-label" for="reader_id"><label class="text-danger">*&nbsp; -->
                        
                        <div class="row">
                            <div class="form-inline">
                                <label class="control-label" for="reader_id"><label class="text-danger">*&nbsp;
                                </label>账号</label>&nbsp;&nbsp;&nbsp;  
                                <input name="reader_id" type="text" class="form-control" placeholder="账号"/>
                            </div>  
                        </div>  

                        <div class="row">  
                            <div class="form-inline">
                                <label class="control-label" for="book_id"><label class="text-danger">*&nbsp;
                                </label>密码</label>&nbsp;&nbsp;&nbsp;  
                                <input name="passward" type="text" class="form-control" placeholder="密码"/>
                            </div>  
                        </div> 

                        <div class="row">  
                            <div class="form-inline">
                                <label class="control-label" for="job"><label class="text-danger">&nbsp;&nbsp;
                                </label>职位</label>&nbsp;&nbsp;&nbsp;  
                                <!-- <div class="col-lg-3">  -->
                                    <select class="form-control" id="job" name="job">
                                    <option value="0">请选择</option>
                                    <option value="1">学生</option>
                                    <option value="2">教职工</option>
                                    </select>
                                <label class="control-label" for="job"></label>
                                <!-- </div> -->
                                <!-- <input name="book_img" type="text" class="form-control" placeholder=""/> -->
                            </div>  
                        </div>  
                        <div class="row">  
                            <div class="form-inline">
                                <label class="control-label" for="book_id"><label class="text-danger">&nbsp;&nbsp;
                                </label>名字</label>&nbsp;&nbsp;&nbsp;  
                                <input name="reader_name" type="text" class="form-control" placeholder="名字"/>
                            </div>  
                        </div>  
                        <div class="row">  
                            <div class="form-inline">
                                <label class="control-label" for="book_id"><label class="text-danger">&nbsp;&nbsp;
                                </label>邮箱</label>&nbsp;&nbsp;&nbsp; 
                                <input name="email" type="text" class="form-control" placeholder="邮箱"/>
                            </div>  
                        </div>  

                        <br />
                        <button name="submit" type="submit" class="btn btn-primary" value="add-single-book">提交</button>
                        <button name="submit" type="submit" class="btn btn-primary" value="return">返回</button>
                        <br /><br /><br />
                    </div>
                </form>
            </div>

            
        </div>
    </div>
</body>


<?php
    include_once ('./link.php');
    include_once ('./util.php');
    
    $conn = new link;
    // 注册操作
    if(isset($_POST['submit']) and $_POST['submit']=="add-single-book")
    {
        $select_value=$_POST["job"];
        // echo $select_value."<br />";
        // 判断是老师还是学生，选择不同的最大借阅的书的数量
        if($select_value==2)
        {
            $job = "T";
            $max_number = 100;
        }else 
        {
            $job = "S";
            $max_number = 20;
        }
        // echo $job;
        // echo $max_number;
        $sql_add_card = "INSERT INTO reader VALUES (\"".$_POST["reader_id"]."\",\"".$_POST["passward"]."\",\"".
                        $job."\",".$max_number.",0,\"".$_POST["reader_name"]."\",\"".$_POST["email"]."\");";
        // echo $sql_add_card;
        $res = $conn->exec_sql($sql_add_card);
        if($res)
            alert("注册成功,请返回登录！");
        else
            alert("当前id已经存在，请重新命名"); 
    }
    
    // 返回操作
    if(isset($_POST['submit']) and $_POST['submit']=="return")
    {   
        $url="http://localhost/library_system_KtQiu/index.php";
        echo "<meta http-equiv='Refresh' content='0;URL=$url'>";
    }

?>



</html> 



