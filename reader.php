<?php
// 保存之前的search 内容
// setcookie("search_placeholder", "", time()+1000000);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- <meta name="save" content="history"> -->
    
    <title>Library System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap.css">


    <div class="alert alert-info">
                <h2> 查询界面-普通用户</h2>
                <?php
                    if (isset($_COOKIE["user"]))
                    echo "<h4>Welcome " . $_COOKIE["user"] . "!</h4>";
                    else
                    echo "<h4>Welcome guest!</h4>";
                    // TODO cookie 和 session 的实现，保存当前的用户的信息
                ?>
                <!-- <h4>welcome! </h4> -->
    </div>
</head>
<body>


<div class="container">
<div class="row">
    <div class="col-md-15">
                <!-- <align=center> -->
                <form name = "form_borrow" method = "post" action = "">
                    <div class="form-group ">
                        

                        <div class="row">  
                            <div class="form-inline">
                                <label class="control-label" for="book_id"><label class="text-danger">*&nbsp;
                                </label>查询内容<br>(关键词之间用空格连接)</label>&nbsp;&nbsp;&nbsp;  
                                <?php
                                    // echo" <input name=\"search_context\" type=\"text\" class=\"form-control\" placeholder=".$_COOKIE["search_placeholder"]." />";
                                    // echo" <input name=\"search_context\" type=\"text\" class=\"form-control\" placeholder=".$_POST["seach_context"]." />";
                                ?>
                                    <input name="search_context" type="text" class="form-control" placeholder="search" />
                            </div>  
                        </div>  

                        <br />
                        <button name="submit" type="submit" class="btn btn-primary" value="search">查询</button>
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
                            <!-- <th>出版社</th> -->
                            <th>图书类型</th>
                            <!-- <th>价格</th> -->
                        </tr>
                        


                        <?php
                            include_once ('./link.php');
                            include_once ('./util.php');
                            // setcookie("search_placeholder",$search_content , time()+6000);
                            if(isset($_POST['submit']) and $_POST['submit']=="search")
                            { 
                                $conn = new link;                                
                                $search_content = $_POST["search_context"];
                                // setcookie("search_placeholder","" , time()-6000);
                                // setcookie("search_placeholder",$search_content , time()+6000);

                                // split 提取关键词
                                $word_list = ft_split($search_content);
                                // 先完整搜索，在按照关键词正则搜索
                                // 完整搜索所有的关键词
                                $sql_search = "select * from book where (book_name like \"%".$search_content
                                            ."%\") or (author like \"%".$search_content
                                            ."%\") or (book_type like \"%".$search_content
                                            ."%\") or (book_id like \"%".$search_content
                                            ."%\") or (author like \"%".$search_content
                                            ."%\") or (press like \"%".$search_content."%\");";
                                // echo $sql_search;
                                $res_all = $conn->exec_sql($sql_search);
                                if($res_all)
                                {
                                    foreach($res_all as $row)
                                    {
                                        $book_id = $row["book_id"];
                                        $book_name = $row["book_name"];
                                        $img = $row["img"];
                                        $author = $row["author"];
                                        $book_remain = $row["remain_num"];
                                        $press = $row["press"];
                                        $amount = $row["amount"];
                                        $book_type = $row["book_type"];

                                        echo "<tr><td>".$book_id."</td>";
                                        echo "<td>".$book_name."</td>";
                                        echo "<td> <img src=\"".$img." \" height=\"150\" width=\"120\" border=0 /> </td>";// 图片地址
                                        // echo "<td>".$remain_num."</td>";
                                        echo "<td>".$book_remain."</td>";
                                        echo "<td>".$author."</td>";
                                        // echo "<td>".$press."</td>";
                                        echo "<td>".$book_type."</td>";
                                        // echo "<td>".$amount."</td>";
                                        echo"</tr>";
                                    }
                                }
                                
                                
                                // 正则搜索所有包含当前内容和的关键词
                                foreach ($word_list as $word)
                                {
                                        $sql_search = "select * from book where (book_name like\" %".$word
                                                    ."%\") or (author like \"%".$word
                                                    ."%\") or (book_type like\"%".$word
                                                    ."%\") or (book_id like \"%".$word
                                                    ."%\") or (author like \"%".$word
                                                    ."%\") or (press like \"%".$word."%\");";

                                    $res_word = $conn->exec_sql($sql_search);
                                    foreach($res_word as $row)
                                    {
                                        $book_id = $row["book_id"];
                                        $book_name = $row["book_name"];
                                        $img = $row["img"];
                                        $author = $row["author"];
                                        $book_remain = $row["remain_num"];
                                        $press = $row["press"];
                                        $amount = $row["amount"];
                                        $book_type = $row["book_type"];

                                        echo "<tr><td>".$book_id."</td>";
                                        echo "<td>".$book_name."</td>";
                                        echo "<td> <img src=\"".$img." \" height=\"150\" width=\"120\" border=0 /> </td>";// 图片地址
                                        echo "<td>".$book_remain."</td>";
                                        echo "<td>".$author."</td>";
                                        // echo "<td>".$press."</td>";
                                        echo "<td>".$book_type."</td>";
                                        // echo "<td>".$amount."</td>";
                                        echo"</tr>";
                                    }
                                }
                                // alert("heihei");
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



