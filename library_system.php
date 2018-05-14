<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Library System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap.css">
    
    
    
    <!-- <h2> Library System </h2> -->
</head>
<body>


<div class="container">
<div class="row">
    <div class="col">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">借书</div>
                        </div>
                        <!-- <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in"> -->
                            <form class="form-horizontal">
                                <div class="row">
                                    <div class="col-lg-5 form-group">
                                    
                                        <label class="col-lg-4 control-label" for="borrow_sno"><label class="text-danger">*&nbsp;</label>学生编号</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" id="borrow_sno" type="text" value="">
                                            <label class="control-label" for="borrow_sno" style="display: none"></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 form-group">
                                        <label class="col-lg-4 control-label" for="borrow_bno"><label class="text-danger">*&nbsp;</label>图书编号</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" id="borrow_bno" type="text" value="">
                                            <label class="control-label" for="borrow_bno" style="display: none"></label>
                                        </div>
                                    <div class="col-lg-2 form-group">
                                        <button type="button" class="btn btn-primary" id="btn_borrow" onclick="borrowBook()">借书</button>
                                    </div>
                                </div>
                            </form>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
    </div>
  
  
  
  
  <div class="row">
                <div class="col-lg-12">
                    <table id="data_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>图书编号</th>
                            <th>图书名称</th>
                            <th>作者</th>
                            <th>价格</th>
                            <th>学号</th>
                            <th>学生姓名</th>
                            <th>借阅日期</th>
                            <th>截止还书日期</th>
                            <th>超期天数</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 

