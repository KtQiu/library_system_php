 <?php

class  link{
    // private    $servername = "localhost";
    // private    $username = "root";
    // private    $password = "";
    // private    $dbname = "lib_db";
	public     $conn;
	public 	   $sql;
    // 创建连接，初始化
    function __construct()
    {

	   //根据自己的情况修改密码和名称
        $conn = new mysqli("localhost", "root", "你的密码", "你的database的名字");
 		$this->conn = $conn;
		// 检测连接
        if ($conn->connect_error)
        {
            die("连接失败: " . $conn->connect_error);
        }
    }
	
	// 运行mysql语句,return的是语句的结果
    function exec_sql($sql)
    {
		$this->sql = $sql;
		$res = $this->conn->query($this->sql);
		// $ret = mysqli_query($this->conn,$this->sql);
		return $res;
	}
	
	// // 得到 select 的结果
	// function select_res() 
	// {
	// 	$result = $this->conn->query($this->sql);
	// 	// while ($row = $result->fetch_assoc()) 
	// 	// {
	// 	// 	$res_array[] = $row;
	// 	// }
	// 	return $result;
	// }
	
	// fetch result
	// function fetch_res() 
	// {
	// 	$result = $this->conn->query($this->sql);
	// 	while ($row = $result->fetch_assoc()) 
	// 	{
	// 		$res_array[] = $row;
	// 	}
	// 	return $res_array;
	// }



	// 更改sql语句
	function set_sql($sql)
	{
		$this->sql = $sql;
	}
	
	// 析构函数
	function __destruct()
	{
		$this->conn->close();
	}
}

?>
