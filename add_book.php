<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Library System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap.css">


    <div class="alert alert-info">
                <h2> 图书入库-管理员界面 </h2>
                <?php
                    if (isset($_COOKIE["user"]))
                    {
                        echo "<h4>Welcome admin " . $_COOKIE["user"] . "!</h4>";
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
                                </label>图书编号</label>&nbsp;&nbsp;&nbsp;  
                                <input name="book_id" type="text" class="form-control" placeholder="图书编号"/>
                            </div>  
                        </div>  

                        <div class="row">  
                            <div class="form-inline">
                                <label class="control-label" for="book_id"><label class="text-danger">*&nbsp;
                                </label>图书名称</label>&nbsp;&nbsp;&nbsp;  
                                <input name="book_name" type="text" class="form-control" placeholder="图书名称"/>
                            </div>  
                        </div>  
                        <div class="row">  
                            <div class="form-inline">
                                <label class="control-label" for="book_id"><label class="text-danger">&nbsp;&nbsp;
                                </label>图片地址</label>&nbsp;&nbsp;&nbsp;  
                                <input name="book_img" type="text" class="form-control" placeholder="图片地址"/>
                            </div>  
                        </div>  
                        <div class="row">  
                            <div class="form-inline">
                                <label class="control-label" for="book_id"><label class="text-danger">&nbsp;&nbsp;
                                </label>图书数量</label>&nbsp;&nbsp;&nbsp;  
                                <input name="book_num" type="text" class="form-control" placeholder="图书数量"/>
                            </div>  
                        </div>  
                        <div class="row">  
                            <div class="form-inline">
                                <label class="control-label" for="book_id"><label class="text-danger">&nbsp;&nbsp;
                                </label>作者   </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                                <input name="book_author" type="text" class="form-control" placeholder="作者"/>
                            </div>  
                        </div>  
                        <div class="row">  
                            <div class="form-inline">
                                <label class="control-label" for="book_id"><label class="text-danger">&nbsp;&nbsp;
                                </label>出版社</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input name="book_press" type="text" class="form-control" placeholder="出版社"/>
                            </div>  
                        </div>  
                        <div class="row">  
                            <div class="form-inline">
                                <label class="control-label" for="book_id"><label class="text-danger">&nbsp;&nbsp;
                                </label>图书类型</label>&nbsp;&nbsp;&nbsp;
                                <input name="book_type" type="text" class="form-control" placeholder="图书类型"/>
                            </div>  
                        </div>  
                        <div class="row">  
                            <div class="form-inline">
                                <label class="control-label" for="book_id"><label class="text-danger">&nbsp;&nbsp;
                                </label>价格</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input name="book_amount" type="text" class="form-control" placeholder="价格"/>
                            </div>  
                        </div>  

                        <br />
                        <button name="submit" type="submit" class="btn btn-primary" value="add-single-book">单本入库</button>
                        <button name="submit" type="submit" class="btn btn-primary" value="return">返回</button>                                                
                        <br /><br />
                        <tr><td>在默认目录下面选择一个csv文件:<input type="file" name="input_file"></td></tr><br />
                        <button name="submit" type="submit" class="btn btn-primary" value="add-books">批量入库</button>
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
                            <th>出版社</th>
                            <th>图书类型</th>
                            <th>价格</th>
                        </tr>


                        <?php
                            include_once ('./link.php');
                            include_once ('./util.php');
                            
                            $conn = new link;
                            // 借书操作
                            if(isset($_POST['submit']) and $_POST['submit']=="add-single-book")
                            {
                                $sql_add = "insert into book values ( \"".$_POST["book_id"]
                                ."\",\"".$_POST["book_img"]
                                ."\", \"".$_POST["book_name"]
                                ."\", \"".$_POST["book_author"]
                                ."\", ".$_POST["book_num"]
                                .", \"".$_POST["book_type"]
                                ."\", \"".$_POST["book_press"]
                                ."\", ".$_POST["book_amount"].");";
                                // echo $sql_add;
                                $res = $conn->exec_sql($sql_add);
                                // echo "hi";
                                if($res)
                                {
                                    alert("单本入库成功");
                                    echo "<tr><td>".$_POST["book_id"]."</td>";
                                    echo "<td>".$_POST["book_name"]."</td>";
                                    echo "<td> <img src=\"".$_POST[book_img]." \" height=\"150\" width=\"120\" border=0 /> </td>";// 图片地址
                                    echo "<td>".$_POST["book_remain"]."</td>";
                                    echo "<td>".$_POST["book_author"]."</td>";
                                    echo "<td>".$_POST["book_press"]."</td>";
                                    echo "<td>".$_POST["book_type"]."</td>";
                                    echo "<td>".$_POST["book_amount"]."</td>";
                                    echo"</tr>";
                                }

                            }
                            
                            if(isset($_POST['submit']) and $_POST['submit']=="add-books")
                            {   
                                $sql_add_books =
                                "LOAD DATA LOCAL INFILE '/var/www/html/library_system_KtQiu/".$_POST["input_file"]."'  
                                INTO TABLE book
                                FIELDS TERMINATED BY ','   
                                OPTIONALLY ENCLOSED BY '\"'   
                                LINES TERMINATED BY '\n'
                                ;";
                                $conn->exec_sql($sql_add_books);
                                alert( "已经加载了文件： ".$_POST["input_file"]);
                            }
                            if(isset($_POST['submit']) and $_POST['submit']=="return")
                            {   
                                $url="http://localhost/library_system_KtQiu/index.php";
                                echo "<meta http-equiv='Refresh' content='0;URL=$url'>";
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



