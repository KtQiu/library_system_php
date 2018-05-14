<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Library System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap.css">


    <div class="alert alert-info">
                <h2> 借书还书系统-管理员界面 </h2>
                <?php
                    if (isset($_COOKIE["user"]))
                    {
                        echo "<h4>Welcome admin " . $_COOKIE["user"] . "!</h4>";
                        echo $_COOKIE["manager_id"];
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
                                </label>学生编号</label>&nbsp;&nbsp;&nbsp;  
                                <input name="reader_id" type="text" class="form-control" placeholder="学生编号"/>
                            </div>  
                        </div>  

                        <div class="row">  
                            <div class="form-inline">
                                <label class="control-label" for="book_id"><label class="text-danger">*&nbsp;
                                </label>图书编号</label>&nbsp;&nbsp;&nbsp;  
                                <input name="book_id" type="text" class="form-control" placeholder="图书编号"/>
                            </div>  
                        </div>  

                        <br />
                        <button name="submit" type="submit" class="btn btn-primary" value="borrow">借出</button>
                        <button name="submit" type="submit" class="btn btn-primary" value="return">还书</button>
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
                            <th>借阅者编号</th>
                            <th>职位</th>
                            <th>借阅者剩余可借数量</th>
                            <th>借阅日期</th>
                            <th>剩余/超期天数</th>
                            <th>操作</th>
                        </tr>


                        <?php
                            include_once ('./link.php');
                            include_once ('./util.php');
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
                                        }else
                                        {
                                            $due_date=Date('y/m/d', strtotime("+90 days"));
                                        }
                                }
                                $sql_borrow = "insert into borrow_info values(null,".$book_id.",\"".$reader_id."\",\"".$_COOKIE["manager_id"]."\",\"".$today."\",\"".$due_date."\");";
                                echo $sql_borrow;
                                $res_borrow = $conn->exec_sql($sql_borrow);
                                    

                                if($res_reader && $res_book)
                                {
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
                                    echo "<td>"."0"."</td>";
                                    echo "<td>"."借出"."</td>";
                                    echo"</tr>";
                                    // TODO sql 语句

                                    alert("成功借出");
                                }else
                                {
                                    alert("编号输入错误！请重试！");
                                }
                            }
                            if(isset($_POST['submit']) and $_POST['submit']=="return")
                            {
                                $sql = "";
                                alert("好了啦");
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



