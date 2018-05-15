<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Library System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap.css">


    <div class="alert alert-info">
                <h2> 图书管理系统-管理员界面 </h2>
                <?php
                    if (isset($_COOKIE["user"]))
                    {
                        echo "<h4>Welcome admin " . $_COOKIE["user"] . "!</h4>";
                        // echo $_COOKIE["manager_id"];
                    }
                    else
                    echo "<h4>Welcome admin!</h4>";
                ?>
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
                                </label>借书证编号</label>&nbsp;&nbsp;&nbsp;  
                                <input name="reader_id" type="text" class="form-control" placeholder="借书证编号"/>
                            </div>  
                        </div>  

                        <div class="row">  
                            <div class="form-inline">
                                <label class="control-label" for="book_id"><label class="text-danger">*&nbsp;
                                </label>图书的编号</label>&nbsp;&nbsp;&nbsp;  
                                <input name="book_id" type="text" class="form-control" placeholder="图书的编号"/>
                            </div>  
                        </div>  

                        <br />
                        <button name="submit" type="submit" class="btn btn-primary" value="borrow">借出</button>
                        <button name="submit" type="submit" class="btn btn-primary" value="return">还书</button>
                        <button name="submit" type="submit" class="btn btn-primary" value="add-book">图书入库</button>
                        <button name="submit" type="submit" class="btn btn-primary" value="add-card">添加用户</button>
                        <button name="submit" type="submit" class="btn btn-primary" value="delete-card">删除用户</button>
                        <br /><br /><br />
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-lg-15">
                    <table id="data_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>图书编号</th>
                            <th>图书名称</th>
                            <th>图书概况 </th>
                            <th>图书剩余数量</th>
                            <th>作者</th>
                            <th>借书证编号</th>
                            <th>职位</th>
                            <th>借阅者剩余可借数量</th>
                            <th>借阅日期</th>
                            <th>剩余/超期天数</th>
                            <th>操作</th>
                        </tr>


                        <?php
                            include_once ('./link.php');
                            include_once ('./util.php');
                            
                            // 借书操作
                            if(isset($_POST['submit']) and $_POST['submit']=="borrow")
                            {
                                $reader_id = $_POST['reader_id'];
                                $book_id = $_POST['book_id'];
                                $conn = new link;
                                // $sql = "select book_name from book;";
                                $sql_reader = "select * from reader where reader_id=".$reader_id;
                                $res_reader = $conn->exec_sql($sql_reader);
                                
                                $sql_book = "select * from book where book_id=".$book_id;
                                $res_book = $conn->exec_sql($sql_book);

                                // insert 到 borrow_info的表里面
                                $today = date('y/m/d');
                                
                                // 计算归还日期
                                foreach($res_reader as $row)
                                {
                                        if($row["job"]=="S")
                                        {
                                            $due_date=Date('y/m/d', strtotime("+30 days"));
                                            $remain_day = 30;
                                        }else
                                        {
                                            $due_date=Date('y/m/d', strtotime("+90 days"));
                                            $remain_day = 90;
                                        }
                                }
                                // echo "due day:".$due_date." <br/>";
                                $sql_borrow = "insert into borrow_info values(null,".$book_id.",\"".$reader_id."\",\"".$_COOKIE["manager_id"]."\",\"".$today."\",\"".$due_date."\");";
                                $sql_reader_borrow = "UPDATE reader SET borrow_number=borrow_number+1 where reader_id =".$reader_id.";";
                                $sql_book_borrow = "update book set remain_num=remain_num-1 where book_id=".$book_id.";";
                                // echo "<br />".$sql_borrow."<br />";

                                if($res_reader && $res_book)
                                {
                                    foreach($res_reader as $row)
                                    {
                                        // 判断当前用户的职业和剩余能接的书的数量
                                        $remain_num = $row["max_number"] - $row["borrow_number"];
                                        if($remain_num <= 0)
                                        {
                                            alert("当前用户已经达到最大借书数量，不能再借了！");
                                            goto quit;
                                        }
                                        if($row["job"]=="S")
                                        {
                                            $job = "学生";
                                        }else
                                        {
                                            $job = "教职工";
                                        }
                                    }

                                    // 做 borrow 相关的操作
                                    $conn->exec_sql($sql_borrow);
                                    $conn->exec_sql($sql_reader_borrow);
                                    $conn->exec_sql($sql_book_borrow);
                                
                                    
                                    foreach($res_book as $row)
                                    {
                                        $book_id = $row["book_id"];
                                        $book_name = $row["book_name"];
                                        $img = $row["img"];
                                        $author = $row["author"];
                                        $book_remain = $row["remain_num"];
                                    }

                                    echo "<tr><td>".$book_id."</td>";
                                    echo "<td>".$book_name."</td>";
                                    echo "<td> <img src=\"".$img." \" height=\"150\" width=\"120\" border=0 /> </td>";// 图片地址
                                    echo "<td>".$book_remain."</td>";
                                    echo "<td>".$author."</td>";
                                    echo "<td>".$reader_id."</td>";
                                    echo "<td>".$job."</td>";
                                    echo "<td>".$remain_num."</td>";
                                    echo "<td>".date("Y/m/d")."</td>";
                                    echo "<td>".$remain_day."</td>";
                                    echo "<td>"."借出"."</td>";
                                    echo"</tr>";

                                    alert("成功借出");
                                }else
                                {
                                    alert("编号输入错误！请重试！");
                                }
                            }
                            quit:

                            // 归还操作
                            if(isset($_POST['submit']) and $_POST['submit']=="return")
                            {
                                $reader_id = $_POST['reader_id'];
                                $book_id = $_POST['book_id'];
                                $conn = new link;
                                $sql_reader = "select * from reader where reader_id=".$reader_id;
                                $res_reader = $conn->exec_sql($sql_reader);
                                $sql_book = "select * from book where book_id=".$book_id;
                                $res_book = $conn->exec_sql($sql_book);

                                // insert 到 rerturn_info的表里面
                                $today = date("Y-m-d");
                                
                                
                                $sql_borrow = "select * from borrow_info where reader_id=".$reader_id." and book_id=".$book_id.";";
                                $res_borrow = $conn->exec_sql($sql_borrow);
                                // echo"<br />".$sql_borrow."<br />";
                                // 查询应该归还的日期

                                foreach ($res_borrow as $row)
                                {
                                    $should_back_time = $row["should_back_time"];
                                    $borrow_id = $row["borrow_id"];
                                }
                                if($should_back_time < $today) 
                                    $is_late = 1;
                                else $is_late = 0;
                                // 计算剩余天数

                                
                                // $remain_day = $should_back_time - $today;
                                $sql_diff_date = "SELECT DATEDIFF(\"".$should_back_time."\",\"".$today."\") AS DiffDate;";
                                // echo $sql_diff_date;
                                $res_remain_date = $conn->exec_sql($sql_diff_date);
                                foreach ($res_remain_date as $row)
                                {
                                    $remain_day = $row["DiffDate"];
                                }
                                // echo "<br />".$today."<br />";
                                // echo "<br />".$should_back_time."<br />";
                                // echo "<br />".$remain_day."<br />";
                                // echo "h1";                                

                                $sql_delete_borrow = "DELETE FROM borrow_info where borrow_id=".$borrow_id.";";
                                // echo"<br />".$sql_delete_borrow."<br />";
                                
                                $sql_return = "insert into return_info values(null,".$borrow_id.",".$book_id.",\"".$reader_id."\",\"".$_COOKIE["manager_id"]."\",\"".$today."\",\"".$is_late."\");";
                                // 读者已经借的书的数量+1， 当前库内书的数量+1
                                $sql_reader = "UPDATE reader SET borrow_number=borrow_number-1 where reader_id =".$reader_id.";";
                                $sql_book = "update book set remain_num=remain_num+1 where book_id=".$book_id.";";

                                if($res_borrow)
                                {

                                    $conn->exec_sql($sql_delete_borrow);
                                    $conn->exec_sql($sql_return);
                                    $conn->exec_sql($sql_reader);
                                    $conn->exec_sql($sql_book);
                                    foreach($res_reader as $row)
                                    {
                                        $remain_num = $row["max_number"] - $row["borrow_number"];
                                        
                                        if($row["job"]=="S")
                                        {
                                            $job = "学生";
                                        }else
                                        {
                                            $job = "教职工";
                                        }
                                    }
                                    

                                    foreach($res_book as $row)
                                    {
                                        $book_id = $row["book_id"];
                                        $book_name = $row["book_name"];
                                        $img = $row["img"];
                                        $author = $row["author"];
                                        $book_remain = $row["remain_num"];
                                    }

                                    echo "<tr><td>".$book_id."</td>";
                                    echo "<td>".$book_name."</td>";
                                    echo "<td> <img src=\"".$img." \" height=\"150\" width=\"120\" border=0 /> </td>";// 图片地址
                                    echo "<td>".$book_remain."</td>";
                                    echo "<td>".$author."</td>";
                                    echo "<td>".$reader_id."</td>";
                                    echo "<td>".$job."</td>";
                                    echo "<td>".$remain_num."</td>";
                                    echo "<td>".date("Y/m/d")."</td>";
                                    echo "<td>".$remain_day."</td>";
                                    echo "<td>"."归还"."</td>";
                                    echo"</tr>";

                                    // $res_return = $conn->exec_sql($sql_return);
                                    

                                    alert("成功还书");
                                }else
                                {
                                    alert("编号输入错误！请重试！");
                                }
                            
                            }
                            if(isset($_POST['submit']) and $_POST['submit']=="add-book")
                            {
                                $url="http://localhost/library_system_KtQiu/add_book.php";
                                echo "<meta http-equiv='Refresh' content='0;URL=$url'>";    
                            }
                            if(isset($_POST['submit']) and $_POST['submit']=="add-card")
                            {
                                $url="http://localhost/library_system_KtQiu/add_card.php";
                                echo "<meta http-equiv='Refresh' content='0;URL=$url'>";
                                $add_card = $_POST["reader_id"]; 
                            }
                            if(isset($_POST['submit']) and $_POST['submit']=="delete-card")
                            {
                                
                                $sql_delete_card = "DELETE FROM reader where reader_id =".$_POST["reader_id"].";";
                                // echo $sql_delete_card;
                                $conn = new link;
                                $res = $conn->exec_sql($sql_delete_card);
                                if($res)
                                    alert("已经删除当前用户");
                                else
                                    alert("借阅卡的id输入错误");
                            }
                            

                        ?>

                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>



</html> 



